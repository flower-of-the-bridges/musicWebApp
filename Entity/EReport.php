<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';


class EReport extends EObject
{
    private $idModeratore;
    private $title;
    private $description;
    private $idSegnalatore;
    private $idObject;
    private $objectTtype;
    
       
    function __construct()
    {
        parent::__construct();
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