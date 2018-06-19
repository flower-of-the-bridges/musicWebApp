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
    private $objectTtype;       //provenience class of the reported object
    
       
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
        //return FPersistantManager::getInstance()->load(E.ucfirst($this->objectTtype)::class, $this->idObject);
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
    
    function getIdModeratore () : int
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
        return $this->objectTtype;
    }
    function setObjectType (string $type)
    {
        $this->objectTtype = $type;
    }
    
}