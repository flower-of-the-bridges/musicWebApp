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
        $supInfo = new ESupInfo();
        if(isset($_POST['contribute']))
            $supInfo->setContribute($_POST['contribute']);
        if(isset($_POST['period']))
            $supInfo->setPeriod($_POST['period']);
        
        return $supInfo;
    }
    
    /**
     * Mostra la pagina per la modifica delle informazioni sul supporto
     * @param EMusician $user l'utente della sessione, di tipo Musician
     * @param bool $success true se l'accesso alla pagina avviene dopo la modifica delle informazioni
     */
    function showManageSupport(EMusician &$user, bool $success = null)
    {
        if(!$success)
            $success = false;
        
        $supInfo = $user->getSupportInfo();
    
        $this->smarty->assign('supInfo', $supInfo); // assegno le informazioni di supporto al template
        
        $this->smarty->registerObject('user', $user); // assegno l'utente al template
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1))); // assegno il tipo dell'utente al
        $this->smarty->assign('success', $success);
        
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