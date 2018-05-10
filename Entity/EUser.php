<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';


class EUser extends EObject
{
    protected $nickname;
    //protected $mail;
    //protected $pwd;
    protected $type;
    
    function __construct()
    {
        
    }
    
    function getName () : string
    {
        return $this->nickname;
    }
    function setName (string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    
    function getType () : string
    {
        return $this->type;
    }
    
    protected function setType (string $type)
    {
        $this->type = $type;
    }
    
    function __toString()
    {
        return "Nome: ".$this->nickname." \nTipo: ".$this->type." \nId: ".$this->id;
    }
    
}