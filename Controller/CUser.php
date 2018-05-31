<?php

require_once 'inc.php';

class CUser
{
    /**
     * La funzione Authentication verifica che le credenziali di accesso inserite da un utente
     * siano corrette: in tal caso, l'applicazione lo riporterà verso la sua pagina, altrimenti
     * restituirà la schermata di login, con un messaggio di errore
     */
    static function Authentication()
    {
        $vUser = new VUser();
        if($vUser->validateLogin())
        {
            $authenticated = false; // bool per l'autenticazione
            
            $userId = FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $_POST['name']); // si verifica che l'utente inserito matchi una entry nel db
            
            if($userId) // se e' stato prelevato un id...
            {
                $loggedUser = FPersistantManager::getInstance()->load(EUser::class, $userId); // viene caricato l'utente
                
                if($loggedUser->validatePwd($_POST['pwd'])) // se la password e' corretta
                {
                    $authenticated = true; // l'utente e' autenticato
                    
                    session_start(); // si da inizio alla sessione
                    
                    // i suoi dati sono memorizzati all'interno della sessione
                    $_SESSION['id'] =  $loggedUser->getId();
                    $_SESSION['name'] = $loggedUser->getName();
                    $_SESSION['type'] = $loggedUser->getType();
                    
                    //if(isset($_POST['remember']))
                    
                    $vUser->showProfile($loggedUser, $loggedUser, 'None');
                }
            }
            
            if(!$authenticated)
                $vUser->showLogin(true);
          
        }
        else
            $vUser->showLogin();
       
    }
    
    /**
     * La funzione Authentication verifica che le credenziali di accesso inserite da un utente
     * siano corrette: in tal caso, l'applicazione lo riporterà verso la sua pagina, altrimenti
     * restituirà la schermata di login, con un messaggio di errore
     */
    static function Register()
    {
        $vUser = new VUser();
        if($vUser->validateSignUp())
        {
            $loggedUser = NULL;
            
            if(!FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $_POST['name']) 
                && !FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_MAIL, $_POST['mail']))    
            { 
                // se il nickname e la mail non sono stati ancora usati, si puo creare l'utente
                 $loggedUser = new EUser();
                 $loggedUser->setName($_POST['name']);
                 $loggedUser->setPassword($loggedUser->hashPwd($_POST['pwd']));
                 $loggedUser->setMail($_POST['mail']);
                 $loggedUser->setType($_POST['type']);
            }
            
            if($loggedUser) // se e' stato prelevato un id...
            {
                FPersistantManager::getInstance()->store($loggedUser); // si salva l'utente
                
                session_start(); // si da inizio alla sessione
               
                // i suoi dati sono memorizzati all'interno della sessione
                $_SESSION['id'] =  $loggedUser->getId();
                $_SESSION['name'] = $loggedUser->getName();
                $_SESSION['type'] = $loggedUser->getType();
                
                //if(isset($_POST['remember']))
                
                $vUser->showProfile($loggedUser, $loggedUser, 'None');
            }
            else
                $vUser->showSignUp(true);
        }
        else
            $vUser->showSignUp();
            
    }
    
    /**
     * Controlla l'accesso alla pagina di login. 
     */
    static function Login()
    {
        $vUser = new VUser();
        $user = CUser::getUserFromSession();
        if($user->getType()!='guest') // se l'utente non è guest, non puo accedere al login
            header('Location: /DeepMusic/index');
        else
            $vUser->showLogin();
    }

    static function Signup()
    {
        $vUser = new VUser();
        $user = CUser::getUserFromSession();
        if ($user->getType() != 'guest') // se l'utente non è guest, non puo accedere al login
            header('Location: /DeepMusic/index');
        else
            $vUser->showSignUp();
    }
    
    /**
     * Effettua il logout.
     */
    static function Logout()
    {
        session_start();
        
        session_unset(); // rimuove le variabili di sessione

        session_destroy(); // distrugge la sessione
        
        header('Location: /DeepMusic/home');
        
    }
    
    /**
     * Restituisce l'utente della sessione corrispondente alla connessione che ha richiamato 
     * il metodo. Se la sessione è effettivamente attiva, restituirà l'utente corrispondente,
     * altrimenti restituirà un semplice utente guest.
     * @return EUser
     */
    static function getUserFromSession() : EUser
    {
        session_start();
        
        $user = new EUser();
        if(isset($_SESSION['id']))
        {
            $user->setId($_SESSION['id']);
            $user->setName($_SESSION['name']);
            $user->setType($_SESSION['type']);
        }
        else
        {
            $user->setName('Visitor');
            $user->setType('guest');
        }
        return $user;
    }
}

