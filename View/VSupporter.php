<?php

require_once 'inc.php';
include_once 'View/VObject.php';

class VSupporter extends VObject
{
    
    function __construct()
    {
        parent::__construct();
        
    }
    
    function showSupportConf(EUser &$user, EMusician &$musician) 
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('musician', $musician);
        $this->smarty->assign('supInfo', $musician->getSupportInfo());
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        $this->smarty->display('confirmSupport.tpl');
    }
    
    function validateChoice() : bool
    {
        if(isset($_POST['action']))
        {
            if($_POST['action']=='yes')
                return true;
                else
                    return false;
        }
        else
            return false;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}