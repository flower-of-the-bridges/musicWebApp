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
	
	private function closeDBConnection(){
		$db = null;
	}

    private function __clone(){
        // evita la clonazione dell'oggetto
    }

    public static function getInstance(){
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }
    
    public function load($className){
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
    
    public function store($obj){
        $result;
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
}

