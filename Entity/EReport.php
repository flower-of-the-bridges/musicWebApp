<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

/**
 * La classe EReport implementa le segnalazioni effettuate dall'utente. Come tale, avrà un
 * identificativo dell'utente che ha effettuato la segnalazione, l'id e il tipo dell'oggetto 
 * segnalato. Metodi specifici permetteranno, a partire da questi due ultimi attributi, di 
 * ricostruire l'oggetto Entity associato. Un ulteriore identificativo simboleggia il moderatore
 * che in caso si e' fatto carico della segnalazione.
 * @author gruppo2
 * @package Entity
 */
class EReport extends EObject
{
    /** identificativo del moderatore che ha preso in carico la segnalazione */
    private $idModeratore;      //Id of the moderatore who accepted this report (if exist)
    /** titolo del report */
    private $title;             //brief intro for the report
    /** descrizione del report */
    private $description;       //description of the problem
    /** identificativo dell'utente che ha effettuato la segnalazione */
    private $idSegnalatore;     //id of the user who send the report
    /** identificativo dell'oggetto segnalato */
    private $idObject;          //id of the reported object
    /** tipologia dell'oggetto segnalato */
    private $objectType;       //provenience class of the reported object
    
    /**
     * 
     */   
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Verifica che il titolo del report sia valido. Deve contenere solo caratteri alfanumerici
     * per un massimo di 29 caratteri
     * @return bool true se e' valido, false altrimenti
     */
    function validateTitle() : bool
    {   // solo lettere (accenti), numeri 
        if (preg_match("/^(\p{L})|([a-zA-Z0-9][a-zA-Z0-9 -])+$/ui", $this->title)) 
            return true;
        else
            return false;
    }
    
    /**
     * Verifica che la descrizione del report sia valida. Deve contenere solo lettere (anche con accenti)
     * numeri e spazi.
     * @return bool true se e' valido, false altrimenti
     */
    function validateDescription() : bool
    {
        // solo lettere (accenti), numeri
        if (preg_match("/^(\p{L})|([a-zA-Z0-9][a-zA-Z0-9 -])+$/ui", $this->description)) // solo lettere, numeri e spazi
            return true;
        else
            return false;
    }
    
    /**
     * 
     * @return string il titolo del report
     */
    function getTitle () : string
    {
        return $this->title;
    }
    
    /**
     * 
     * @param string $title il titolo del report
     */
    function setTitle (string $title)
    {
        $this->title = $title;
    }
    
    /**
     * 
     * @return string la descrizione del report
     */
    function getDescription () : string
    {
        return $this->description;
    }
    
    /**
     * 
     * @param string $desc la descrizione del report
     */
    function setDescription (string $desc)
    {
        $this->description = $desc;
    }
    
    /**
     * 
     * @return int l'identificativo del moderatore (NULL se non specificato)
     */
    function getIdModeratore() 
    {
        return $this->idModeratore;
    }
    
    /**
     * 
     * @param int $idM l'identificativo del moderatore
     */
    function setIdModeratore (int $idM)
    {
        $this->idModeratore = $idM;
    }
    
    /**
     * 
     * @return int l'identificativo dell'utente che ha inviato il report
     */
    function getIdSegnalatore () : int
    {
        return $this->idSegnalatore;
    }
    
    /**
     * 
     * @param int $idS l'identificativo dell'utente che ha inviato il report
     */
    function setIdSegnalatore (int $idS)
    {
        $this->idSegnalatore = $idS;
    }
    
    /**
     * 
     * @return int l'identificativo dell'oggetto
     */
    function getIdObject () : int
    {
        return $this->idObject;
    }
    
    /**
     * 
     * @param int $idO l'identificativo dell'oggetto
     */
    function setIdObject (int $idO)
    {
        $this->idObject= $idO;
    }
    
    /**
     * 
     * @return string la tipologia dell'oggetto segnalato
     */
    function getObjectType () : string
    {
        return $this->objectType;
    }
    
    /**
     * 
     * @param string $type la tipologia dell'oggetto segnalato
     */
    function setObjectType (string $type)
    {
        $this->objectType = $type;
    }
    
    /**
     * Ricava l'oggetto del Report a partire dall'identificativo e dalla topologia
     * @return object Entity rappresentante l'oggetto contenuto nel report, se valido | NULL altrimenti
     */
    function getReportedObject()
    {
        $className = E.ucfirst($this->objectType);
        $obj = NULL;
        
        if(class_exists($className))
        {
            if($this->idObject)
                $obj = FPersistantManager::getInstance()->load($className, $this->idObject);
        }
        
        return $obj;    
    }
    
    /**
     * Restituisce l'utente che ha effettuato il report
     * @return EUser se il report contiene l'identificativo segnalatore di un utente esistente | NULL altrimenti
     */
    function getSegnalatore()
    {
        if($this->idSegnalatore)
            return FPersistantManager::getInstance()->load(EUser::class, $this->idSegnalatore);
        else 
            return NULL;
    }
    /**
     * Imposta tipologia e identificativo dell'oggetto nel report a partire dall'oggetto stesso
     * @param ESong | EUser $obj l'oggetto da cui ricavare i valori
     */
    function setReportedObject($obj)
    {
        if (is_a($obj, EListener::class) || is_a($obj, EMusician::class) || 
            is_a($obj, EModerator::class) || is_a($obj, ESong::class) )
        {   
            $className = get_class($obj);
            
            if(is_a($obj, EListener::class) || is_a($obj, EMusician::class) ||
                is_a($obj, EModerator::class))
                $className = get_parent_class($obj);
                
            $this->objectType = substr($className,1);
            $this->idObject = $obj->getId();
        }
            
    }
    
    /**
     * Verifica che il report sia stato preso in carico da un moderatore.
     * @return bool true se e' stato preso in carico, false altrimenti 
     */
    function isAccepted() : bool
    {
        if($this->getIdModeratore())
            return true;
        else 
            return false;
    }
}