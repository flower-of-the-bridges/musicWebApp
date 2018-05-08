<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';


class EUser extends EObject
{
    protected $name;
    protected $mail;
    protected $pwd;
    protected $type;
    
    function __construct(int $id = null, string $user = null, string $mail = null, string $pwd = null, string $type = "guest")
    {
        parent::__construct($id);
        $this->name = $user;
        $this->mail = $mail;
        $this->pwd = $pwd;
        $this->type = $type;
    }
    
    function getName () : string
    {
        return $this->name;
    }
    function setName ()
    {
        $this->name;
    }
    
    function getMail () : string
    {
        return $this->mail;
    }
    function setMail ()
    {
        $this->mail;
    }
    
    function getPwd () : string
    {
        return $this->pwd;
    }
    function setPwd ()
    {
        $this->pwd;
    }
    
    function getType () : string
    {
        return $this->type;
    }
    function setType ()
    {
        $this->type;
    }
    
    
}