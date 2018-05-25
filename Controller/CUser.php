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
            $userId = FPersistantManager::getInstance()->exists('User', $_POST['name'], $_POST['pwd']); // si verifica che la coppia mail -pswd matchi una entry nel db
            
            if($userId) // se e' stato prelevato un id...
            {
                session_start(); // si da inizio alla sessione
                
                $loggedUser = FPersistantManager::getInstance()->load('User', $userId); // viene caricato l'utente
                // i suoi dati sono memorizzati all'interno della sessione
                $_SESSION['id'] =  $loggedUser->getId();
                $_SESSION['name'] = $loggedUser->getName();
                $_SESSION['type'] = $loggedUser->getType();
                
                $vUser->showProfile($loggedUser, $loggedUser, 'None');
            }
            else 
                $vUser->showLogin();
        }
        else
            $vUser->showLogin();
       
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

