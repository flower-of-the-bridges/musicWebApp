<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

class EGuest extends EUser
{
    function __construct()
    {
        parent::__construct();
        $this->id = 0;
        $this->nickname = 'Visitor';
    }
}

