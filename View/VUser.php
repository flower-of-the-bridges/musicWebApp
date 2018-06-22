<?php
require_once 'inc.php';
include_once 'View/VObject.php';

/**
 * La classe VUser si occupa dell'input-output per quanto riguarda la gestione di un utente. In particolare:
 * - Costruisce da una form un oggetto EUser e ne verifica la validità
 * - Permette al client di visualizzare pagine relative all'utente (login-signup-profilo)
 * @author gruppo2
 * @package View
 */
class VUser extends VObject
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
     * Funzione che permette la creazione di utente con i valori prelevati da una form
     * @return EUser l'utente ottenuto dai campi della form
     */
    function createUser() : EUser
    {
        $user;
        if(isset($_POST['type']))
        {
            $type = 'E'.ucfirst($_POST['type']);
            $user = new $type(); 
        }
        else
            $user = new EUser();
        
        if(isset($_POST['name']))
            $user->setNickName($_POST['name']);
        if(isset($_POST['mail']))
            $user->setMail($_POST['mail']);
        if(isset($_POST['pwd']))
            $user->setPassword($_POST['pwd']);
        
        return $user;
    }
    /**
     * Verifica che un utente abbia rispettato i vincoli per l'inserimento dei parametri di login
     *
     * @return true se non si sono commessi errori, false altrimenti
     */
    function validateLogin(EUser $user): bool
    {
        if($this->check['name']=$user->validateNickName() && $this->check['pwd']=$user->validatePassword())
        {
            return true;
        }
        else
        {
            return false;
        }
        
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
     * Mostra il profilo di un utente
     *
     * @param EUser $profileUser
     *            il profilo di cui visualizzare il profilo
     * @param EUser $loggedUser
     *            l'utente che ha effettuato l'accesso alla sessione
     * @param bool $isFollowing
     *            true se l'utente della sessione segue l'utente del profilo, false altrimenti
     * @param bool $isSupporting
     *            true se l'utente della sessione supporta l'utente del profilo, false altrimenti  
     * @param string $content
     *            il contenuto da visualizzare nel profilo (Song, Follower, Following)
     * @param array $array
     *            l'array del contenuto da visualizzare
     */
    function showProfile(EUser &$profileUser, EUser &$loggedUser, bool $isFollowing, bool $isSupporting, string $content, array $array = NULL)
    {
        $this->smarty->assign('content', $content);
 
        $this->smarty->registerObject('user', $loggedUser);
        $this->smarty->assign('uType', lcfirst(substr(get_class($loggedUser), 1)));
        
        $this->smarty->registerObject('profile', $profileUser);
        $this->smarty->assign('pType', lcfirst(substr(get_class($profileUser), 1)));
      
        $this->smarty->assign('isFollowing', $isFollowing);
        $this->smarty->assign('isSupporting', $isSupporting);
        
        $this->smarty->assign('array', $array);
        
        $this->smarty->display('user/profile.tpl');
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
        
        $this->smarty->display('user/login.tpl');
    }

    /**
     * Mostra la pagina di signup
     *
     * @param bool $error
     *            facoltativo se e' stato rilevato un errore
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
        
        $this->smarty->display('user/register.tpl');
    }
    
    /**
     * Mostra la pagina che consente la rimozione di un utente 
     *
     * @param EUser $user
     *            l'utente della sessione
     * @param EUser $removed
     *            se l'utente che ha richiesto la rimozione e' un moderatore 
     */
    function showRemoveForm(EUser &$user, EUser &$removed = null)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        if($removed)
        {
            $setRemovedUser = true;
            $this->smarty->assign('rName', $removed->getNickName());
            $this->smarty->assign('rId', $removed->getId());
        }
        else 
        {
            $this->smarty->assign('rName', NULL);
            $this->smarty->assign('rId', NULL);
        }
                
        $this->smarty->display('user/removeUser.tpl');
    }
}

