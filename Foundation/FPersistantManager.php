<?php

/**
 * Description of FPersistantManager
 * Lo scopo di questa classe e' quello di fornire un accesso unico al DBMS, incapsulando
 * al proprio interno i metodi statici di tutte le altre classi Foundation, cosi che l'accesso
 * ai dati persistenti da parte degli strati superiore dell'applicazione sia piu' intuitivo.
 * @author gruppo 2
 */

require_once 'config.inc.php';
require_once 'inc.php';

class FPersistantManager {
    
    private static $instance = null; 	// l'unica istanza della classe
    private $db; 						// oggetto PDO che effettua la connessione al dbms
  
/***********************************    METODI DI INIZIALIZZAZIONE     *********************************/
    
    /**
     * Inizializza un oggetto FPersistantManager. Metodo privato per evitare
     * duplicazioni dell'oggetto.
     */
    private function __construct()
    {
        try{
            global $address,$admin,$pass,$database;
            $this->db = new PDO ("mysql:host=$address;dbname=$database", $admin, $pass);

        }catch (PDOException $e){
            echo "Errore : " . $e->getMessage();
            die;
        }
    }
    
    /**
     * Metodo che chiude la connessione al dbms.
     */
    function closeDBConnection()
    {
        $this->db = null;
    }
    
    /**
     * Metodo reso privato per evitare la clonazione dell'oggetto.
     */
    private function __clone(){}
    
    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return FPersistantManager l'istanza dell'oggetto.
     */
    static function getInstance() : FPersistantManager
    {
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }
    
/****************************************** LOAD *****************************************************/ 
    
    /**
     * Metodo che carica dal dbms informazioni nel corrispettivo
     * oggetto Entity.
     * @param string $target il nome dell'oggetto (Song, User, Musician, ...)
     * @return object un oggetto Entity.
     */
    function load(string $target, int $id)
    {
        switch($target){
            case($target=='User'): // load di un EUser
                $sql = FUser::loadUser();
                break;
            case($target=='Song'): // load di un ESong
                $sql = FSong::loadSong();
                break;
            case($target=='Mp3'): // load di un EMp3
                $sql = FMp3::loadMp3();
                break;
            case($target=='Img'): // load di un immagine
                $sql = FImg::loadImg();
                break;
            case($target=='musicianSongs'): // load di ESong di un musician
                $sql = FSong::loadMusicianSongs();
                break;
            case($target=='Followers'): // load di EUser che seguono un utente
                $sql = FFollower::loadFollowers();
                break;
            case($target=='Following'): // load di EUser seguiti da un utente
                $sql = FFollower::loadFollowing();
                break;
            case($target=='SupInfo'): //load delle info del supporto
                $sql = FSupInfo::loadSupportInfo();
                break;
            case($target=='Report'): //load di un report
                $sql = FReport::loadReport();
                break;
            case($target=='modReports'): //load dei report assegnati ad un moderatore
                $sql = FReport::loadReportByIdMod();
                break;
            case($target=='Supporters'): //load dei supporter di un utente
                $sql = FSupporter::loadSupporters();
                break;
            case($target=='Supporting'): //load dei supporti di un utente
                $sql = FSupporter::loadSupporting();
                break;
            default:
                $sql = NULL;
                break;
        }
        if($sql)
            return $this->execLoad($target, $id, $sql);
        else return NULL;
    }
    
    /**
     * Esegue una SELECT sul database
     * @param string $target il tipo di richiesta che si sta effettuando
     * @param string $sql la stringa contenente il comando SQL
     * @return boolean l'esito della transazione
     */
    private function execLoad(string $target, int $id, string $sql) {
        
        try 
        {    
            $stmt = $this->db->prepare($sql); // creo PDOStatement
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            $stmt->execute();   //viene eseguita la query
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table
 
            $obj=NULL;
            
            while($row = $stmt->fetch())
            { // per ogni tupla restituita dal db viene istanziato un oggetto
                if($target == 'musicianSongs' || $target == 'modReports') //inserire qui target che richiedono un array come ritorno
                   $obj[] = FPersistantManager::createObjectFromRow($target, $row);
               else $obj = FPersistantManager::createObjectFromRow($target, $row);            
            }
            
            return $obj;
        }
        catch (PDOException $e) 
        {
            die($e->errorInfo);
            return null; //ritorna null se ci sono errori
        }
    }
    
/****************************************** SEARCH **************************************************/
    
    /**
     * Effettua una ricerca sul database secondo vari parametri. Tale metodo e' scaturito a seguito
     * di una ricerca da parte dell'utente, puo' essere relativa a canzoni o musicisti secondo diversi 
     * parametri, come nome o genere musicale.
     * @param string $key la table da cui prelevare i dati
     * @param string $value il valore per cui cercare i valori
     * @param string $str il dato richiesto dall'utente
     * @return array|NULL i risultati ottenuti dalla ricerca. Se la richiesta non ha match, ritorna NULL.
     */
    function search(string $key, string $value, string $str) 
    {
        switch($key){
            case($key=='Musician'): // search di EMusicians
                
                if($value=='Name')
                    $sql = FUser::searchMusicianByName();
                if($value=='Genre')
                    $sql = FUserInfo::searchMusicianByGenre();
                break;
                
            case($key=='Song'): // search di un ESongs
                
                if($value=='Name')
                    $sql = FSong::searchSongByName();
                if($value=='Genre')
                    $sql = FSong::searchSongByGenre();
                
                break;
                
            default:
                
                $sql = NULL;
                break;
        }
        
        if($sql)
            return $this->execSearch($key, $value, $str, $sql);
        else return NULL;
    }
    
    private function execSearch(string $key, string $value, string $str, string $sql)
    {
        try
        {
            $stmt = $this->db->prepare($sql); // creo PDOStatement
            $stmt->bindValue(":".$value, $str, PDO::PARAM_STR); //si associa l'id al campo della query
            $stmt->execute();   //viene eseguita la query
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table
            
            $obj = NULL; // l'oggetto di ritorno viene definito come NULL
            
            while($row = $stmt->fetch())
            { // per ogni tupla restituita dal db...
                $obj[] = FPersistantManager::createObjectFromRow($key, $row); //...istanzio l'oggetto
            }
            
            return $obj;
        }
        catch (PDOException $e)
        {
            die($e->errorInfo);
            return null; // ritorna null se ci sono errori
        }
    }
/****************************************** STORE ********************************************/    
   
    /**
     * Metodo che permette di salvare informazioni contenute in un oggetto
     * Entity sul database.
     * @param object $obj il nome dell'oggetto.
     * @return bool $result il risultato dell'elaborazione
     */
    function store(&$obj) : bool
    {
        $result = false;
        switch($obj){
            case(is_a($obj, EUser::class)):
                $sql = FUser::storeListener(); // salvataggio di un EUser nel db
                break;
            case(is_a($obj, EUserInfo::class)):
                $sql = FUserInfo::storeUserInfo(); // salvataggio di un EUserInfo nel db
                break;
            case(is_a($obj, ESong::class)): // salvataggio di un Esong nel db
                $sql = FSong::storeSong();
                break;
            case(is_a($obj, EMp3::class)): //salvataggio di un EMp3 nel db
                $sql = FMp3::storeMp3(); 
                break;
            case(is_a($obj, EImg::class)): //salvataggio di una EImg nel db
                $sql = FImg::storeImg(); //salva l'mp3
                break;
            case(is_a($obj, EComment::class)): //salvataggio di un EComment nel db
                $sql = FComment::storeComment();
                $result = $this->execStore($obj, $sql);
                break;
            case(is_a($obj, ESupInfo::class)): // salvataggio di un ESupInfo nel db
                $sql = FSupInfo::storeSupportInfo();
                break;
            case(is_a($obj, EReport::class)): // salvataggio di un EReport nel db
                $sql = FReport::storeReport();
                break;
            case(is_a($obj, EFollower::class)): // salvataggio di un EFollower nel db
                $sql = FFollower::storeFollower();
                break;
            case(is_a($obj, ESupporter::class)): // salvataggio di un ESupporter nel db
                $sql = FSupporter::storeSupporter();
                break;
            default:
                $sql = null;
                break;
        }
        if($sql) // se la stringa sql e' definita...
            $result = $this->execStore($obj, $sql); // ... esegui la query
        return $result;
    }

    /**
     * Esegue una INSERT sul database
     *
     * @param mixed $obj
     *            l'oggetto da salvare
     * @param string $sql
     *            la stringa contenente il comando SQL
     * @return boolean l'esito della transazione
     */
    private function execStore(&$obj, string $sql)
    {
        $this->db->beginTransaction(); // inizio della transazione
        
        $stmt = $this->db->prepare($sql);
        
        // si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            FPersistantManager::bindValues($stmt, $obj); // si associano i valori dell'oggetto alle entry della query
            
            $stmt->execute();

            if ($stmt->rowCount()) // si esegue la query
            {
                if ($obj->getId() == 0) // ...se il valore e' non nullo, si assegna l'id
                    $obj->setId($this->db->lastInsertId()); // assegna all'oggetto l'ultimo id dato dal dbms
                
                return $this->db->commit(); // si ritorna il risultato del commit
            } 
            else 
            {
                // ...altrimenti si effettua il rollback e si ritorna false
                $this->db->rollBack();
                
                return false;
            }
        } catch (PDOException $e) {
            // errore: rollback e return false
            echo ('Errore: ' . $e->getMessage());
            
            $this->db->rollBack();
            
            return false;
        }
    }
    
/******************************************* UPDATE *******************************************/
    /**
     * Metodo che permette di aggiornare informazioni sul database, relative
     * ad una singola ennupla.
     * @param $obj l'oggetto da aggiornare
     * @bool true se l'update ha avuto successo, false altrimenti
     */
    function update($obj) : bool
    {
        switch($obj)
        {
            case(is_a($obj, EMusician::class)):
                $sql = FMusician::updateMusician();
                break;
            case(is_a($obj, EListener::class)):
                $sql = FListener::updateListener();
                break;
            case(is_a($obj, ESong::class)):
                $sql = FSong::updateSong();
                break;
            case(is_a($obj, EImg::class)):
                $sql = FImg::updateImg();
                break;
            case(is_a($obj, EComment::class)):
                $sql = FComment::updateComment();
                break;
            case(is_a($obj, ESupInfo::class)):
                $sql = FSupInfo::updateSupInfo();
                break;
            case(is_a($obj, EReport::class)):
                $sql = FReport::updateReport();
                break;
            case(is_a($obj, ESupporter::class)):
                $sql = FSupporter::updateSupporter();
                break;
            default:
                $sql = null;
                break;
        }
        if($sql)
            return $this->execUpdate($obj, $sql);
        else return false;
    }
    
    /**
     * Esegue una UPDATE sul database
     * @param mixed $obj l'oggetto da salvare
     * @param string $sql la stringa contenente il comando SQL
     * @return bool l'esito della transazione
     */
    private function execUpdate(&$obj, string $sql) : bool
    {
        $this->db->beginTransaction(); //inizio della transazione
        
        $stmt = $this->db->prepare($sql);
   
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try 
        {       
            FPersistantManager::bindValues($stmt, $obj); //si associano i valori dell'oggetto alle entry della query

            if($stmt->execute()) //se la tupla e' alterata...
            {
                return $this->db->commit(); //...ritorna il risultato del commit
            }
            else //altrimenti l'update non ha avuto successo...
            {
                $this->db->rollBack();
                
                return false; //...annulla la transazione e ritorna false
            }
        } 
        catch (PDOException $e) 
        {    
            echo('Errore: '.$e->getMessage());
            
            $this->db->rollBack();
            
            return false;
        }
    }
    
/************************************** REMOVE ************************************************/    
    
    /**
     * Metodo che cancella dal database una entry di un particolare
     * oggetto Entity.
     * @param string $className il nome dell'oggetto (Song, User, Musician, ...)
     * @param int $id l'identifier della entry da eliminare.
     * @param int $id2 opzionale se l'entry nel database ha due primary key
     * @return bool se l'operazione ha avuto successo o meno.
     */
    function remove(string $target, int $id, int $id2=null) : bool
    {
        switch($target)
        {
            case($target=='User'): // rimozione di un users dal db
                $sql = FUser::removeUser();
                return FPersistantManager::execRemove($sql, $id);
                break;
            case($target=='Song'): // rimozione di una song dal db
                $sql = FSong::removeSong();
                return FPersistantManager::execRemove($sql, $id);
                break;
            case($target=='Img'): // rimozione di una immagine dal db
                $sql = FImg::removeImg();
                return FPersistantManager::execRemove($sql, $id);
                break;
            case($target=='Comment'): // rimozione di un comment dal db
                $sql = FComment::removeComment();
                return FPersistantManager::execRemove($sql, $id);
                break;
            case($target=='Report'): // rimozione di un report dal db
                $sql = FReport::removeReport();
                return FPersistantManager::execRemove($sql, $id);
                break;
            case($target=='Follower'):
                $sql = FFollower::removeFollower();
                return FPersistantManager::execRemove($sql, $id, $id2);
                break;
            case($target=='Supporters'):
                $sql = FSupporter::removeSupporter();
                return FPersistantManager::execRemove($sql, $id, $id2);
                break;
            default:
                return false;
                break;
        }
  
    }
    
    /**
     * Rimuove una entry dal database.
     * @param int $id della entry da eliminare
     * @param int $id2 opzionale se l'entry ha due primary key
     * @return bool l'esito dell'operazione
     */
    private function execRemove(string $sql, int $id, int $id2 = NULL) : bool {
        
        try
        {
            $stmt = $this->db->prepare($sql); //a partire dalla stringa sql viene creato uno statement
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            
            if($id2) // se id2 e' stato inserito...
                $stmt->bindValue(":id2", $id2, PDO::PARAM_INT); //...si associa id2 al campo della query
                
                return $stmt->execute(); //esegue lo statement e ritorna il risultato
                
        }
        catch (PDOException $e)
        {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }
    }
    
    
/***************************************  EXISTS  ****************************************************/
    
    /**
     * Metodo che verifica l'esistenza di un valore in una entry di una table
     * @param string $target il tipo di dato di cui si vuole controllare l'esistenza
     * @param string | int $value il valore di cui controllare l'unicita'
     * @param string | int $value2 opzionale se presente una doppia chiave nella table da interrogare
     * @return bool | int true se il dato esiste, false altrimenti. un int se si richiede l'esistenza di un User.
     */
    function exists(string $target, $value, $value2 = null) 
    {
        switch($target)
        {
            case($target=='Mail'): // controlla se una mail sia gia stata inserita
                $sql = FUser::existUserMail();
                return FPersistantManager::execExists($sql, $value);
                break;
            case($target=='NickName'): // controlla se un nickname sia gia stato inserito
                $sql = FUser::existUserName();
                return FPersistantManager::execExists($sql, $value);
                break;
            case($target=='User' && $value2):
                $sql = FUser::existUser();
                return FPersistantManager::execExists($sql, $value, $value2);
            case($target=='Song'): // controlla se un utente abbia gia inserito una canzone con lo stesso nome
                return FPersistantManager::execExists($sql, $value);
                break; 
            case($target=='Follower' && $value2): // controlla se un utente sta seguendo un altr utente
                $sql = FFollower::existsFollower();
                return FPersistantManager::execExists($sql, $value, $value2);
                break;
            case($target=='Supporters' && $value2): // controlla se un artista supporta un altro utente
                $sql = FSupporter::existsSupporter();
                return FPersistantManager::execExists($sql, $value, $value2);
                break;
            default:
                return false;
                break;
        }
    }
    
    /**
     * Esegue l'operazione di controllo di esistenza
     * @param string $sql la query da inviare al dbms
     * @param string | int $value il valore di cui controllare l'unicita'
     * @param string | int $value2 opzionale se presente una doppia chiave nella table da interrogare
     * @return bool | id true se la entry esiste, false altrimenti
     */
    private function execExists(string $sql, $value, $value2 = NULL) : bool {
        
        try
        {
            $stmt = $this->db->prepare($sql); //a partire dalla stringa sql viene creato uno statement
            
            if(is_int($value))
                $stmt->bindValue(":value", $value, PDO::PARAM_INT); //si associa l'intero al campo della query
                if(is_string($value))
                    $stmt->bindValue(":value", $value2, PDO::PARAM_STR); // si associa la stringa al campo della query
                    
                    if ($value2) // se il secondo valore e' stato inserito
                    {
                        if (is_int($value2))
                            $stmt->bindValue(":value2", $value, PDO::PARAM_INT); // si associa l'intero al campo della query
                        if (is_string($value2))
                            $stmt->bindValue(":value2", $value2, PDO::PARAM_STR); // si associa la stringa al campo della query
                    }
                    
                    $result = $stmt->execute(); //esegue lo statement e ritorna il risultato
                    $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table
                    if($result)
                    {
                        $row = $stmt->fetch();
                        if($row['id'])
                            return $row['id'];
                        else return true;
                    }
                    else return  $false;
        }
        catch (PDOException $e)
        {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }
    }
    
    
/*************************************** TRUNCATE ***************************************************/    

    
    /**
     * Cancella tutte le entry in un DBMS. A scopo di debug
     * @param string $target il nome della table da cancellare
     * @return bool il risultato dell'operazione.
     */
    function truncate(string $target)
    {
        switch($target)
        {
            case($target=='Musician'):
                break;
            case($target=='Listener'):
                break;
            case($target=='Song'):
                FSong::emptyTable($this->db);
                break;
            default:
                break;
        }
    }
    
/*****************************   ASSOCIAZIONI ENTITY - DB    *********************************/    
    
    /**
     * Associa ai campi della query i corrispondenti valori dell'oggetto
     * @param PDOStatement $stmt lo statement contenente i campi da riempire
     * @param EListener $listener contenente i valori da associare alla query
     */
    private function bindValues(PDOStatement &$stmt, &$obj) 
    {
        switch($obj)
        {
            case(is_a($obj, EUser::class)): // associazione statement - EUser
                FUser::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EUserInfo::class)): // associazione statement - EUserInfo
                FUserInfo::bindValues($stmt, $obj);
                break;
            case(is_a($obj, ESong::class)): // associazione statement - ESong
                FSong::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EMp3::class)): // associazione statement - EMp3
                FMp3::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EImg::class)): // associazione statement - EImg
                FImg::bindValues($stmt, $obj);
                break;
            case(is_a($obj, ESupInfo::class)): // associazione statement - ESupInfo
                FSupInfo::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EReport::class)): // associazione statement - EReport
                FReport::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EFollower::class)): // associazione statement - EFollower
                FFollower::bindValues($stmt, $obj);
                break;
            case(is_a($obj, ESupporter::class)): // associazione statement - EFollower
                FSupporter::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EComment::class)): // associazione statement - EComment
                break;
            default:
                break;
        }
    }
    
    /**
     * Da una tupla ricevuta da una query istanzia l'oggetto corrispondente
     * @param string $target individua il tipo di oggetto da creare
     * @param $row array la tupla restituita dal dbms
     * @return mixed l'oggetto risultato dell'elaborazione
     */
    private function createObjectFromRow(string $target, $row)
    {
        $obj; //oggetto che conterra' l'istanza dell'elaborazione
        
        switch($target)
        {
            case($target=='User' || $target=='Followers' || $target=='Following'): // creazione di un oggetto EUser
                $obj = FUser::createObjectFromRow($row);
                break;
            case($target=='UserInfo'):
                $obj = FUserInfo::createObjectFromRow($row); //creazione di un oggetto EUserInfo
                break;
            case($target=='Song' || $target=='musicianSongs'): // creazione di un oggetto ESong
                $obj = FSong::createObjectFromRow($row);
                break;
            case($target=='Mp3'): // creazione di un oggetto EMp3
                $obj= FMp3::createObjectFromRow($row);
                break;
            case($target=='Img'): // creazione di un oggetto EImg
                $obj= FImg::createObjectFromRow($row);
                break;
            case($target=='SupInfo'): // creazione di un oggetto ESupInfo
                $obj= FSupInfo::createObjectFromRow($row);
                break;
            case($target=='Report'): // creazione di un oggetto EReport
                $obj= FReport::createObjectFromRow($row);
                break;
            default:
                $obj=NULL;
                break;
        }
        
        return $obj;
    }
        
}

