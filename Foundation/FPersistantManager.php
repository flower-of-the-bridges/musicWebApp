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
  
/**************************METODI DI INIZIALIZZAZIONE*****************************************/
    
    /**
     * Inizializza un oggetto FPersistantManager. Metodo privato per evitare
     * duplicazioni dell'oggetto.
     */
    private function __construct()
    {
        try{
            global $address,$user,$pass,$database;
            $this->db = new PDO ("mysql:host=$address;dbname=$database", $user, $pass);
            // connessione non persistente
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
        $db = null;
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
    
/********************************* METODI LOAD ****************************************/ 
    
    /**
     * Metodo che carica dal dbms informazioni nel corrispettivo
     * oggetto Entity.
     * @param string $target il nome dell'oggetto (Song, User, Musician, ...)
     * @return object un oggetto Entity.
     */
    function load(string $target, int $id)
    {
        switch($target){
            case($target=='Musician'):
                $sql = FMusician::loadMusician();
                break;
            case($target=='Listener'):
                $sql = FListener::loadListener();
                break;
            case($target=='Song'):
                $sql = FSong::loadSong();
                break;
            case($target=='Comment'):
                $sql = FComment::loadComment();
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
     * 
     * @param string $target
     * @param int $id
     * @param string $sql
     * @return NULL
     */
    private function execLoad(string $target, int $id, string $sql) {
        
        try {
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            $stmt->execute();   //viene eseguita la query
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  //salva in un array le colonne della tuple
            if($stmt->rowCount())
                return FPersistantManager::createObjectFromRow($target, $row); //ritorna l'oggetto
                else return null;
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return null; //ritorna null se ci sono errori
        }
    }
    
/****************************************** STORE ********************************************/    
   
    /**
     * Metodo che permette di salvare informazioni contenute in un oggetto
     * Entity sul database.
     * @param object $obj il nome dell'oggetto.
     */
    function store(&$obj) : bool
    {
        switch($obj){
            case(is_a($obj, EMusician::class)):
                $sql = FMusician::storeMusician();
                break;
            case(is_a($obj, EListener::class)):
                $sql = FListener::storeListener();
                break;
            case(is_a($obj, ESong::class)):
                $sql = FSong::storeSong();
                break;
            case(is_a($obj, EComment::class)):
                $sql = FComment::storeComment();
                break;
            default:
                $sql = null;
                break;
        }
        if($sql)
            return $this->execStore($obj, $sql);
            else return false;
    }
    
    /**
     * 
     * @param unknown $obj
     * @param string $sql
     * @return boolean
     */
    private function execStore(&$obj, string $sql){
        $this->db->beginTransaction(); //inizio della transazione
        
        $stmt = $this->db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            FPersistantManager::bindValues($stmt, $obj);    //si associano i valori dell'oggetto alle entry della query
            
            $stmt->execute();   //si esegue la query
            
            if($stmt->rowCount())
            {
                
                $obj->setId( $this->db->lastInsertId() );
                
                return $this->db->commit();
                
            } else {
                $this->db->rollBack();
                
                return false;
            }
        } catch (PDOException $e) {
            
            echo('Errore: '.$e->getMessage());
            
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
        switch($obj){
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
    
    private function execUpdate(&$obj, string $sql) : bool
    {
        $this->db->beginTransaction(); //inizio della transazione
        
        $stmt = $this->db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            FPersistantManager::bindValues($stmt, $obj); //si associano i valori dell'oggetto alle entry della query
            $stmt->execute();
            
            if($stmt->rowCount()) //se la tupla e' alterata...
            {
                return $this->db->commit(); //...ritorna il risultato del commit
            }
            else //altrimenti l'update non ha avuto successo...
            {
                $this->db->rollBack();
                
                return false; //...annulla la transazione e ritorna false
            }
        } catch (PDOException $e) {
            
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
        switch($className){
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
            return $this->execRemove($id, $sql);
        else return false;
    }
    
    /**
     * Rimuove una entry dal database.
     * @param int $id della entry da eliminare
     * @return bool l'esito dell'operazione
     */
    static function execRemove(int $id, $sql) : bool {
        
        try {
            
            $stmt = $this->db->prepare($sql); //a partire dalla stringa sql viene creato uno statement
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            $stmt->execute(); //esegue lo statement
            //ritorna true se il numero di tuple eliminate è 1, false altrimenti
            return (bool) $stmt->rowCount();
            
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }
    }
    

/*************************************** TRUNCATE *********************************************/    

    
    /**
     * Cancella tutte le entry in un DBMS. A scopo di debug
     * @param string $className il nome della table da cancellare
     * @return bool il risultato dell'operazione.
     */
    function truncate(string $className)
    {
        switch($className){
            case('F'.$className=='FMusician'):
                break;
            case('F'.$className=='FListener'):
                break;
            case('F'.$className=='FSong'):
                FSong::emptyTable($this->db);
                break;
            default:
                break;
        }
    }
    
/***************************** ASSOCIAZIONI ENTITY - DB ***************************************/    
    /**
     * Associa ai campi della query i corrispondenti valori dell'oggetto
     * @param PDOStatement $stmt lo statement contenente i campi da riempire
     * @param EListener $listener contenente i valori da associare alla query
     */
    private function bindValues(PDOStatement &$stmt, &$obj) {
        switch($obj){
            case(is_a($obj, EMusician::class)):
                break;
            case(is_a($obj, EListener::class)):
                
                break;
            case(is_a($obj, ESong::class)):
                FSong::bindValues($stmt, $obj);
                break;
            case(is_a($obj, EComment::class)):
                break;
            default:
                break;
        }
    }
    
    /**
     * Da una tupla ricevuta da una query istanzia l'oggetto corrispondente
     * @param string $target individua il tipo di oggetto da creare
     * @param unknown $row la tupla
     * @return NULL
     */
    private function createObjectFromRow(string $target, $row){
        switch($target){
            case($target=='Musician'):
                break;
            case($target=='Listener'):
                $obj = $listener = new EListener($row['id'], $row['name']); //creazione dell'oggetto EListener
                break;
            case($target=='Song'):
                $obj = new ESong($row ['id_song'], $row['name'], new EMusician($row['id_artist']), $row['genre']); //creazione dell'oggetto Esong
                
                //impostazione visibilita'.
                if ($rows['forall']) $obj->setForAll();
                elseif ($rows['registered']) $obj->setForRegisteredOnly();
                elseif ($rows['supporters']) $obj->setForSupportersOnly();
                else $obj->setHidden();
                break;
                
            case($target=='Comment'):
                break;
            default:
                $obj=NULL;
                break;
        }
        return $obj;
    }
    
}

