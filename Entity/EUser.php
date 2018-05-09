<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';


class EUser extends EObject
{
    protected $nickname;
    //protected $mail;
    //protected $pwd;
    protected $type;
    
    function __construct(int $id = null, string $user = null, string $type = null)
    {
        parent::__construct($id);
        $this->nickame = $user;
        $this->type = $type;
    }
    
    function getName () : string
    {
        return $this->nickname;
    }
    function setName ()
    {
        $this->nickame;
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