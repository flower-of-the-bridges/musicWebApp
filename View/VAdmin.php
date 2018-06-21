<?php
require_once 'inc.php';
include_once 'View/VObject.php';

/**
 * La classe VAdmin effettua l'input-output per quanto riguarda il pannello di amministrazione
 * @author gruppo2
 * @package View
 *
 */
class VAdmin extends VObject
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->check = array(
            'name' => true,
            'mail' => true,
            'pwd' => true,
            'type' => true
        );
    }

    /**
     * Ritorna la coppia utente-password inserita dall'amministratore nel login
     * @return array
     */
    function getUserAndPassword(): array
    {
     
        if (isset($_POST['name']) && isset($_POST['pwd']))
            return array($_POST['name'],$_POST['pwd']);
    }
        
    
    /**
     * Verifica che un utente abbia inserito i
     *
     * @return true se non si sono commessi errori, false altrimenti
     */
    function validateSignUp(EUser $user): bool
    {
        if($this->check['name']=$user->validateNickName() && $this->check['pwd']=$user->validatePassword() && $this->check['mail']=$user->validateMail())
        {
            return true;
        }
        else
            return false;
    }
       
    /**
     * Mostra la pagina di login
     *
     * @param bool $error
     *            facoltativo se è stato rilevato un errore
     */
    function showLogin(bool $error = NULL)
    {
        if(!$error)
            $error = false;
            
            $user = new EGuest();
            
            $this->smarty->registerObject('user', $user);
            $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
            
            $this->smarty->assign('error', $error);
            $this->smarty->assign('check', $this->check);
            
            $this->smarty->display('loginAdmin.tpl');
    }
    
    /**
     * Funzione che permette la creazione di utente con i valori prelevati da una form
     * @return EUser l'utente ottenuto dai campi della form
     */
    function createUser(): EUser
    {
        $user;
        if (isset($_POST['type'])) {
            $type = 'E' . ucfirst($_POST['type']);
            $user = new $type();
        } else
            $user = new EUser();
        
        if (isset($_POST['name']))
            $user->setNickName($_POST['name']);
        if (isset($_POST['mail']))
            $user->setMail($_POST['mail']);
        if (isset($_POST['pwd']))
            $user->setPassword($_POST['pwd']);
        
        return $user;
    }
    
    /**
     * Mostra la pagina di signup
     *
     * @param bool $error
     *            facoltativo se è stato rilevato un errore
     */
    function showSignUp(bool $error = NULL)
    {
        if (! $error)
            $error = false;
            
            $user = new EGuest();
            
            $this->smarty->registerObject('user', $user);
            $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
            
            $this->smarty->assign('error', $error);
            $this->smarty->assign('check', $this->check);
            
            $this->smarty->display('registerAdmin.tpl');
    }
    
    /**
     * Mostra il pannello di amministrazione
     * @param EUser $user l'utente della sessione
     */
    function showPanel(EUser &$user)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));

        $this->smarty->assign('check', $this->check);
        
        $this->smarty->display('panel.tpl');
        
    }
}

