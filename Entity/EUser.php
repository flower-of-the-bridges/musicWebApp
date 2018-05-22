<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';


class EUser extends EObject
{
    protected $nickname;
    protected $mail;
    protected $password;
    protected $type;
        
    function __construct()
    {
        parent::__construct();
    }
    
    function isStringOk(string $toCheck) : bool
    {          
        if( preg_match('/[.,/({][})"'."'".'&|!$;?\:]{8,32}/', $toCheck) )
            {return false;}
        return true;
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
    function setType (string $type)
    {
        $this->type = $type;
    }
    
    function getPassword () : string
    {
        return $this->password;
    }
    function setPassword (string $pwd)
    {
        $this->password = $pwd;
    }
    
    function getMail () : string
    {
        return $this->mail;
    }
    function setMail (string $mail)
    {
        $this->mail = $mail;
    }
    
    function __toString()
    {
        return "Nome: ".$this->nickname."\nTipo: ".$this->type."\nId: ".$this->id;
    }
    
}
