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
            global $address,$user,$pass,$database;
            $this->db = new PDO ("mysql:host=$address;dbname=$database", $user, $pass);

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
            case($target=='Musician'): // load di un EMusician
                $sql = FMusician::loadMusician();
                break;
            case($target=='Listener'): // load di un EListener
                $sql = FListener::loadListener();
                break;
            case($target=='Song'): // load di un ESong
                $sql = FSong::loadSong();
                break;
            case($target=='Mp3'): // load di un EMp3
                $sql = FMp3::loadMp3();
                break;
            case($target=='musicianSongs'): //load di ESong di un musician
                $sql = FSong::loadMusicianSongs();
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
            
            while($row = $stmt->fetch()){ // per ogni tupla restituita dal db...
                if($stmt->rowCount()>1) // se il numero di righe recuperate e' piu di uno, creo un array
                    $obj[] = FPersistantManager::createObjectFromRow($target, $row); //...istanzio l'oggetto
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
                    $sql = FMusician::searchMusicianByName();
                if($value=='Genre')
                    $sql = FMusician::searchMusicianByGenre();
                
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
            case(is_a($obj, EMusician::class)):
                $sql = FMusician::storeMusician();
                $result = $this->execStore($obj, $sql);
                break;
            case(is_a($obj, EListener::class)):
                $sql = FListener::storeListener();
                $result = $this->execStore($obj, $sql);
                break;
            case(is_a($obj, ESong::class)):
                $sql = FSong::storeSong();
                $result = $this->execStore($obj, $sql);
                break;
            case(is_a($obj, EMp3::class)):
                $sql = FMp3::storeMp3(); //salva l'mp3
                $result = $this->execStore($obj, $sql);
                break;
            case(is_a($obj, EComment::class)):
                $sql = FComment::storeComment();
                $result = $this->execStore($obj, $sql);
                break;
            default:
                $sql = null;
                break;
        }
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
     * @param $obj
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
            case(is_a($obj, EComment::class)):
                $sql = FComment::updateComment();
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
     * @return boolean l'esito della transazione
     */
    private function execUpdate(&$obj, string $sql) : bool
    {
        $this->db->beginTransaction(); //inizio della transazione
        
        $stmt = $this->db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try 
        {       
            FPersistantManager::bindValues($stmt, $obj); //si associano i valori dell'oggetto alle entry della query
            $stmt->bindValue(":id", $obj->getId(), PDO::PARAM_INT); //si associa l'id al campo della query
            
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
     * @param int $id l'identifier dell'oggetto da eliminare.
     * @return bool se l'operazione ha avuto successo o meno.
     */
    function remove(string $target, int $id) : bool
    {
        switch($target)
        {
            case($target=='Musician'):
                $sql = FMusician::removeMusician();
                break;
            case($target=='Listener'):
                $sql = FListener::removeListener();
                break;
            case($target=='Song'):
                $sql = FSong::removeSong();
                break;
            case($target=='Comment'):
                $sql = FComment::removeComment();
                break;
            default:
                $sql = NULL;
                break;
        }
        if($sql)
            return FPersistantManager::execRemove($id, $sql);
        else return false;
    }
    
    /**
     * Rimuove una entry dal database.
     * @param int $id della entry da eliminare
     * @return bool l'esito dell'operazione
     */
    private function execRemove(int $id, string $sql) : bool {
        
        try 
        {    
            $stmt = $this->db->prepare($sql); //a partire dalla stringa sql viene creato uno statement
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
           
            return $stmt->execute(); //esegue lo statement e ritorna il risultato
            
        }
        catch (PDOException $e) 
        {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }
    }
    

/*************************************** TRUNCATE *********************************************/    

    
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
            case(is_a($obj, EMusician::class)):
                FMusician::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EListener::class)):
                FListener::storeListener($stmt, $obj);
                break;
            case(is_a($obj, ESong::class)):
                FSong::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EMp3::class)): 
                FMp3::bindValues($stmt, $obj);
            case(is_a($obj, EComment::class)):
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
            case($target=='Musician'):
                $obj = FMusician::createObjectFromRow($row);
                break;
            case($target=='Listener'):
                $obj = FListener::createOBjectFromRow($row); //creazione dell'oggetto EListener
                break;
            case($target=='Song' || $target=='musicianSongs'):
                $obj = FSong::createObjectFromRow($row);
                break;
            case($target=='Mp3'):
                $obj= FMp3::createObjectFromRow($row);
                break;
            default:
                $obj=NULL;
                break;
        }
        
        return $obj;
    }
    
    
}

