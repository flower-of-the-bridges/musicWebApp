<?php
require_once 'inc.php';

/**
 * La classe CSession regola la sessione dell'utente nella navigazione dell'applicazione.
 * Le sue funzionalità permettono di iniziare, terminare e riprendere una sessione di un particolare
 * utente, costruendo/ricostruendo i suoi parametri principali (quali nome, tipologia...)
 * @author gruppo2
 * @package Controller
 */
class CSession
{
    /**
     * Funzione che da inizio alla sessione. I dati dell'utente come id, nome, e tipologia di
     * utente sono salvati all'interno dell'array session.
     * @param EUser $user l'utente di cui memorizzare i dati
     */
    static function startSession(EUser &$user)
    {
        session_start();
        // i suoi dati sono memorizzati all'interno della sessione
        $_SESSION['id'] =  $user->getId();
        $_SESSION['name'] = $user->getNickName();
        $_SESSION['type'] = lcfirst(substr(get_class($user), 1));
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
        
        if(isset($_SESSION['id']))
        {
            $uType= 'E'.ucfirst($_SESSION['type']); // determina la entity della tipologia di utente
            
            $user = new $uType();
            $user->setId($_SESSION['id']);
            $user->setNickName($_SESSION['name']);
        }
        else
        {
            $user = new EGuest();
        }
        return $user;
        
    }
    
    /**
     * Termina una sessione.
     */
    static function destroySession()
    {
        session_start(); // recupera i parametri di sessione
        
        session_unset(); // rimuove le variabili di sessione
        
        session_destroy(); // distrugge la sessione
    }
}

