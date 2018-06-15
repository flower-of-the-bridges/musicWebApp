<?php
require_once 'inc.php';
include_once 'View/VObject.php';

class VSupInfo extends VObject
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->check = array(
            'contribute' => true,
            'period' => true,
        );
    }
    
    
    function createSupInfo() : ESupInfo
    {
        $supInfo;
        if(isset($_POST['contribute']))
            $supInfo->setContribute($_POST['contribute']);
        if(isset($_POST['period']))
            $supInfo->setPeriod($_POST['period']);
        
        return $supInfo;
    }
    
    
    function showManageSupport(EMusician &$user)
    {
        
        $supInfo = $user->getSupportInfo();
        $this->smarty->assign('supInfo', $supInfo);
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        $this->smarty->display('manageSupport.tpl');
        
    }
    
    
    function validateLoad(ESupInfo &$supInfo) : bool
    {
        if($this->check['contribute']=$supInfo->validateContribute() && $this->check['period']=$supInfo->validatePeriod())
            return true;
            else
                return false;
    }
}