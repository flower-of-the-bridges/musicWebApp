<?php   
/**
 * Description of FPersistantManager
 * This foundation class provides a unique access to the Mysql DBMS, its aim is 
 * to use the static methods of all the other foundation classes in order to 
 * gather the information required by the upper layers.
 *
 * attivare se non già attivato il supporto alle PDO sul web server
 * localizzando la stringa ";extension=php_pdo.dll" e se presente rimuovere il ;
 * @author gruppo 2
 */
 
require_once 'config.inc.php';
require_once 'inc.php';

class FPersistantManager {
    
    private static $instance = null; 	// the unique instance of the class
    private $db; 						// PDO connection to database

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
	private function closeDBConnection(){
		$db = null;
	}

    private function __clone(){
        // evita la clonazione dell'oggetto
    }

    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return FPersistantManager 
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
    public function load(string $className, int $id=null, string $key=null){
        $result;
        switch($className){
            case('E'.$className=='EMusician'):
                break;
            case('E'.$className=='EListener'):
                break;
            case('E'.$className=='ESong'):
                break;
            default:
                break;
        }
        return $result;        
    }
    
    /**
     * Metodo che permette di salvare informazioni contenute in un oggetto 
     * Entity sul database.
     * @param object $obj il nome dell'oggetto.
     */
    public function store(&$obj) :void 
    {
        switch($obj){
            case(is_a($obj, EMusician::class)):
                break;
            case(is_a($obj, EListener::class)):
                break;
            case(is_a($obj, ESong::class)):
                if(FSong::storeSong($this->db, $obj))
                    echo("Caricamento effettuato.");
                else echo("Caricamento fallito.");
                break;
            default:
                break;
        }
    }
	
	/**
	 * Metodo che permette di aggiornare informazioni sul database, relative
	 * ad una singola ennupla.
	 * @param $obj
	 */
    public function update($obj){
        $result;
        switch($obj){
            case(is_a($obj, EMusician::class)):
                break;
            case(is_a($obj, EListener::class)):
                break;
            case(is_a($obj, ESong::class)):
                if(FSong::updateSong($this->db, $obj))
                    echo("Aggiornamento effettuato.");
                    else echo("Aggiornamento fallito.");
                    break;
            default:
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

