<?php

/**
 * Lo scopo di questa classe e' quello di fornire un accesso unico al DBMS, incapsulando
 * al proprio interno i metodi statici di tutte le altre classi Foundation, cosi che l'accesso
 * ai dati persistenti da parte degli strati superiore dell'applicazione sia piu' intuitivo.
 * @author gruppo 2
 * @package Foundation
 */

if(file_exists('config.inc.php'))
    require_once 'config.inc.php';

require_once 'inc.php';

class FPersistantManager {
    
    /** l'unica istanza della classe */
    private static $instance = null; 	
    /** oggetto PDO che effettua la connessione al dbms */
    private $db; 						
  
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
     * Metodo che carica dal dbms informazioni in un corrispettivo oggetto Entity.
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param string $target opzionale, sono accettabili solo valori di FTarget
     * $target puo essere specificato per le seguenti classi:
     *  - ESong ( FTarget::LOAD_MUSICIAN_SONG )
     *  - EFollower 
     *  - EUser ( FTarget::LOAD_FOLLOWING FTarget::LOAD_FOLLOWERS )
     *  - ESupporter ( FTarget::LOAD_SUPPORTERS FTarget::LOAD_SUPPORTING )
     *  - EReport (FTarget::LOAD_MOD_REPORT)
     * @return object un oggetto Entity.
     */
    function load(string $class, int $id, string $target=NULL)
    {
        $sql='';
        
        if ( class_exists( $class ) ) // si verifica che l'oggetto Entity esista
        {
            $resource = substr($class,1); // si ricava il nome della risorsa corrispondente all'oggetto Entity
            $foundClass = 'F'.$resource; // si ricava il nome della corrispettiva classe Foundation
            
            if($target) // se il target e' specificato
                $method = 'load'.$target; // i
            else 
                $method = 'load'.$resource;
            
            if(method_exists($foundClass, $method))
                $sql = $foundClass::$method();  
        }
        
        if($sql)
            return $this->execLoad($class, $id, $sql, $target);
        else return NULL;
    }
    
    /**
     * Esegue una SELECT sul database
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param string $target opzionale, sono accettabili solo valori di FTarget
     * @param string $sql la stringa contenente il comando SQL
     * @return boolean l'esito della transazione
     */
    private function execLoad(string $class, int $id, string $sql, string $target=null) {
        
        try 
        {    
            $stmt = $this->db->prepare($sql); // creo PDOStatement
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            $stmt->execute();   //viene eseguita la query
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table
 
            $obj=NULL;
            
            while($row = $stmt->fetch())
            { // per ogni tupla restituita dal db viene istanziato un oggetto
                if($target == FTarget::LOAD_FOLLOWERS || $target == FTarget::LOAD_FOLLOWING || 
                   $target == FTarget::LOAD_MUSICIAN_SONG || $target==FTarget::LOAD_MOD_REPORTS ||
                   $target == FTarget::LOAD_SUPPORTERS || $target == FTarget::LOAD_SUPPORTING) 
                //inserire qui target che richiedono un array come ritorno
                   $obj[] = FPersistantManager::createObjectFromRow($class, $row);
               else $obj = FPersistantManager::createObjectFromRow($class, $row);            
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
                    $sql = FUser::searchUserByName();
                if($value=='Genre')
                    $sql = FUser::searchUserByGenre();
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
     * @param object $obj l'oggetto da salvare
     * @return bool $result il risultato dell'elaborazione
     */
    function store(&$obj) : bool
    {
        $result = false;
        $sql = '';
        $class = '';
        if(is_a($obj, EListener::class) || is_a($obj, EMusician::class)) // se l'oggetto e' una tipologia di musicista
            $class = get_parent_class($obj); // si considera la classe padre, EUser
        else 
            $class = get_class($obj); // restituisce il nome della classe dall'oggetto
        
        $resource = substr($class,1); // nome della risorsa (User, Song, UserInfo, ...)
        $foundClass = 'F'.$resource; // nome della rispettiva classe Foundation
        $method = 'store'.$resource; // nome del metodo store+nome_risorsa
        
        if(class_exists($foundClass) && method_exists($foundClass, $method))  // se la classe esiste e il metodo pure...           
            $sql = $foundClass::$method(); //ottieni la stringa sql
        
        if($sql) //se la stringa sql esiste...
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
            var_dump($stmt);
            $stmt->execute();
            if ($stmt->rowCount()) // si esegue la query
            {
                if (method_exists($obj, 'getId') && $obj->getId() == 0) // ...se il valore e' non nullo, si assegna l'id
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
        $sql='';
        
        $class = '';
        if(is_a($obj, EListener::class) || is_a($obj, EMusician::class) || is_a($obj, EModerator::class))
            $class = get_parent_class($obj);
        else
            $class = get_class($obj); // restituisce il nome della classe dall'oggetto
            
        $resource = substr($class,1); // nome della risorsa (User, Song, UserInfo, ...)
        $foundClass = 'F'.$resource; // nome della rispettiva classe Foundation
        $method = 'update'.$resource; // nome del metodo update+nome_risorsa
        
        $sql = $foundClass::$method();
        
        $result = $this->execUpdate($obj, $sql); // ... esegui la query
        
        return $result;
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
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT); // associa l'id dell'oggetto alla query
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
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param int $id l'identifier della entry da eliminare.
     * @param int $id2 opzionale se l'entry nel database ha due primary key
     * @return bool se l'operazione ha avuto successo o meno.
     */
    function remove(string $class, int $id, int $id2=null) : bool
    {
        $sql = '';
        if (class_exists($class))
        {
            $resource = substr($class, 1);
            $foundClass = 'F' . $resource;
            $method = 'remove' . $resource;
            
            $sql = $foundClass::$method();
        }
        if ($sql)
        {
            if($id2 && ($class==ESupporter::class || $class==EFollower::class))
                return $this->execRemove($sql, $id, $id2);
            else
                return $this->execRemove($sql, $id);
        }
        else
            return NULL;
  
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
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param string $target opzionale, sono accettabili solo valori di FTarget. 
     * Associazioni class - target è la seguente:
     *  - EUser ( FTarget::EXISTS_USER FTarget::EXISTS_MAIL FTarget::EXISTS_NICKNAME )
     *  - EFollower (FTarget::EXISTS_FOLLOWER )
     *  - ESupporter (FTarget::EXISTS_SUPPORTER)
     * @param string | int $value il valore di cui controllare l'unicita'
     * @param string | int $value2 opzionale, se presente una doppia chiave nella table da interrogare
     * @return bool | int true se il dato esiste, false altrimenti. un int se si richiede l'esistenza di un User.
     */
    function exists(string $class, string $target, $value, $value2 = null) 
    {
        $sql = '';
        if (class_exists($class)) 
        {
            $resource = substr($class, 1);
            $foundClass = 'F' . $resource;
            $method = 'exists' . $target;
            
            $sql = $foundClass::$method();
        }
        if ($sql)
        {
            if($value2 && ($target==FTarget::EXISTS_SUPPORTER || $target==FTarget::EXISTS_FOLLOWER || $target==FTarget::EXISTS_USER))
                return $this->execExists($sql, $value, $value2);
            else
                return $this->execExists($sql, $value);
        }
        else
            return NULL;
    }

    /**
     * Esegue l'operazione di controllo di esistenza
     *
     * @param string $sql
     *            la query da inviare al dbms
     * @param
     *            string | int $value il valore di cui controllare l'unicita'
     * @param
     *            string | int $value2 opzionale se presente una doppia chiave nella table da interrogare
     * @return bool | id true se la entry esiste, false altrimenti
     */
    private function execExists(string $sql, $value, $value2 = NULL)
    {
        try 
        {
            $stmt = $this->db->prepare($sql); // a partire dalla stringa sql viene creato uno statement
            if (is_int($value))
                $stmt->bindValue(":value", $value, PDO::PARAM_INT); // si associa l'intero al campo della query
            if (is_string($value))
                $stmt->bindValue(":value", $value, PDO::PARAM_STR); // si associa la stringa al campo della query
            if ($value2) // se il secondo valore e' stato inserito
            {
                if (is_int($value2))
                    $stmt->bindValue(":value2", $value2, PDO::PARAM_INT); // si associa l'intero al campo della query
                if (is_string($value2))
                    $stmt->bindValue(":value2", $value2, PDO::PARAM_STR); // si associa la stringa al campo della query
            }
            
            $result = $stmt->execute(); // esegue lo statement e ritorna il risultato
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table
  
            if ($stmt->rowCount()) {
                $row = $stmt->fetch();
                return $row['id'];
            } 
            else
                return false;
           
                
        } catch (PDOException $e) {
            die($e->errorInfo);
            return FALSE; // ritorna false se ci sono errori
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
        $class = '';
        if(is_a($obj, EListener::class) || is_a($obj, EMusician::class) || is_a($obj, EModerator::class))
            $class = get_parent_class($obj);
        else
            $class = get_class($obj); // restituisce il nome della classe dall'oggetto
        
        $resource = substr($class,1); // nome della risorsa (User, Song, UserInfo, ...)
        $foundClass = 'F'.$resource; // nome della rispettiva classe Foundation
        
        $foundClass::bindValues($stmt, $obj); // associazione statement - EObject
    }
    
    /**
     * Da una tupla ricevuta da una query istanzia l'oggetto corrispondente
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param $row array la tupla restituita dal dbms
     * @return mixed l'oggetto risultato dell'elaborazione
     */
    private function createObjectFromRow(string $class, $row)
    {
        $obj = NULL; //oggetto che conterra' l'istanza dell'elaborazione
        
        if ( class_exists( $class ) ) 
        {
            $foundClass = 'F'.substr($class,1);
            
            $obj = $foundClass::createObjectFromRow($row);         
        }
        
        return $obj;
    }
        
}

