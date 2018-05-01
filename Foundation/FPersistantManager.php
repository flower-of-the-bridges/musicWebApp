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
    public function closeDBConnection(){
        $db = null;
    }
    
    /**
     * Metodo reso privato per evitare la clonazione dell'oggetto.
     */
    private function __clone(){ }
    
    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return FPersistantManager l'istanza dell'oggetto.
     */
    public static function getInstance(){
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }
    
    /**
     * Metodo che carica dal dbms informazioni nel corrispettivo
     * oggetto Entity.
     * @param string $className il nome dell'oggetto (Song, User, Musician, ...)
     * @return object un oggetto Entity.
     */
    public function load(string $className, int $id){
        switch($className){
            case('E'.$className=='EMusician'):
                return FMusician::loadMusician($this->db, $id);
                break;
            case('E'.$className=='EListener'):
                return FListener::loadListener($this->db, $id);
                break;
            case('E'.$className=='ESong'):
                return FSong::loadSong($this->db, $id);
                break;
            case('E'.$className=='EComment'):
                return FComment::loadComment($this->db, $id);
            default:
                return NULL;
                break;
        }
    }
    
    /**
     * Metodo che cancella dal database una entry di un particolare
     * oggetto Entity.
     * @param string $className il nome dell'oggetto (Song, User, Musician, ...)
     * @param int $id l'identifier dell'oggetto da eliminare.
     * @return bool se l'operazione ha avuto successo o meno.
     */
    public function remove(string $className, int $id){
        switch($className){
            case('E'.$className=='EMusician'):
                return FMusician::removeMusician($this->db, $id);
                break;
            case('E'.$className=='EListener'):
                return FListener::removeListener($this->db, $id);
                break;
            case('E'.$className=='ESong'):
                return FSong::removeSong($this->db, $id);
                break;
            case('E'.$className=='EComment'):
                return FComment::removeComment($this->db, $id);
            default:
                return false;
                break;
        }
    }
    /**
     * Metodo che permette di salvare informazioni contenute in un oggetto
     * Entity sul database.
     * @param object $obj il nome dell'oggetto.
     */
    public function store(&$obj) : bool
    {
        switch($obj){
            case(is_a($obj, EMusician::class)):
                return FMusician::storeMusician($this->db, $obj);
                break;
            case(is_a($obj, EListener::class)):
                return FListener::storeListener($this->db, $obj);
                break;
            case(is_a($obj, ESong::class)):
                return (FSong::storeSong($this->db, $obj));
                break;
            case(is_a($obj, EComment::class)):
                return FComment::storeComment($this->db, $obj);
            default:
                return false;
                break;
        }
    }
    
    /**
     * Metodo che permette di aggiornare informazioni sul database, relative
     * ad una singola ennupla.
     * @param $obj
     */
    public function update($obj) : bool{
        $result;
        switch($obj){
            case(is_a($obj, EMusician::class)):
                return FMusician::updateMusician($this->db, $obj);
                break;
            case(is_a($obj, EListener::class)):
                return FListener::updateListener($this->db, $obj);
                break;
            case(is_a($obj, ESong::class)):
                return FSong::updateSong($this->db, $obj);
                break;
            case(is_a($obj, EComment::class)):
                return FComment::updateComment($this->db, $obj);
                break;
            default:
                return false;
                break;
        }
    }
    
    
    /**
     * Cancella tutte le entry in un DBMS. A scopo di debug
     * @param string $className il nome della table da cancellare
     * @return bool il risultato dell'operazione.
     */
    public function truncate(string $className){
        $result;
        switch($className){
            case('F'.$className=='FMusician'):
                break;
            case('F'.$className=='FListener'):
                break;
            case('F'.$className=='FSong'):
                $result=FSong::emptyTable($this->db);
                break;
            default:
                break;
        }
        return $result;
    }
    
}

