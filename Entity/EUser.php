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
    
    function isPwdOk() : bool
    {          
        $len = strlen($this->password);
        if (len<8 || len>32) {return false;}
        if(    strstr($this->password, '.')== true 
            || strstr($this->password, ',')== true 
            || strstr($this->password, '/')== true 
            || strstr($this->password, '(')== true 
            || strstr($this->password, '[')== true
            || strstr($this->password, '{')== true 
            || strstr($this->password, '}')== true 
            || strstr($this->password, ']')== true 
            || strstr($this->password, ')')== true 
            || strstr($this->password, "'")== true 
            || strstr($this->password, '&')== true 
            || strstr($this->password, ';')== true 
            || strstr($this->password, '?')== true 
            || strstr($this->password, trim(' \ ' , null)) == true 
            || strstr($this->password, ':')== true 
            || strstr($this->password, '"')== true ) 
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
