<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

/**
 * The EReport Class make possible to manage reports made by the user base
 * @author gruppo2
 */
class EReport extends EObject
{
    private $idModeratore;      //Id of the moderatore who accepted this report (if exist)
    private $title;             //brief intro for the report
    private $description;       //description of the problem
    private $idSegnalatore;     //id of the user who send the report
    private $idObject;          //id of the reported object
    private $objectType;       //provenience class of the reported object
    
       
    function __construct()
    {
        parent::__construct();
    }
    
    function validateTitle() : bool
    {
        return $this->title != "";
    }
    
    function validateDescription() : bool
    {
        return $this->description != "";
    }
    
    function validateIdSegnalatore() : bool
    {
        if($this->idSegnalatore != "")
        {
            return FPersistantManager::getInstance()->load(EUser::class, $this->idSegnalatore);
        }else 
            return  false;
    }
    
    function validateObject() : bool
    {
        $className = E.ucfirst($this->objectType);
        if(class_exists($class_name))
        {
            $obj = FPersistantManager::getInstance()->load($className, $this->idObject);
            if($obj)
                return true;
            else
                return false;
        }
        else 
            return false;
    }
    
    
    function getTitle () : string
    {
        return $this->title;
    }
    function setTitle (string $title)
    {
        $this->title = $title;
    }
    
    function getDescription () : string
    {
        return $this->description;
    }
    function setDescription (string $desc)
    {
        $this->description = $desc;
    }
    
    function getIdModeratore() 
    {
        return $this->idModeratore;
    }
    function setIdModeratore (int $idM)
    {
        $this->idModeratore = $idM;
    }
    
    function getIdSegnalatore () : int
    {
        return $this->idSegnalatore;
    }
    function setIdSegnalatore (int $idS)
    {
        $this->idSegnalatore = $idS;
    }
    
    function getIdObject () : int
    {
        return $this->idObject;
    }
    function setIdObject (int $idO)
    {
        $this->idObject= $idO;
    }
    
    function getObjectType () : string
    {
        return $this->objectType;
    }
    function setObjectType (string $type)
    {
        $this->objectType = $type;
    }
    
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