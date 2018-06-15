<?php
require_once 'inc.php';

/**
 * La classe CSupInfo implementa la funzionalità 'Gestione Supporto', ovvero consente ad un
 * utente di tipo Musicista di gestire le modalità con cui gli altri utenti possono supportarlo.
 * @author gruppo2
 *
 */
class CSupInfo
{
    /**
     * Funzione che regola l'accesso all'URL /deepmusic/supInfo/edit
     */
    static function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            CSupInfo::showManageSupInfo();
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CSupInfo::editSupInfo();
        }
        else
            header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    
    /**
     * Mostra la pagina di controllo per le informazioni di supporto relative all'utente 
     * della sessione attiva. Se l'utente non è un musicista, mostra un messaggio di errore.
     */
    private function showManageSupInfo()
    {
        $vSupInfo = new VSupInfo();
        $user = CSession::getUserFromSession();
        
        if(get_class($user)!=EMusician::class)
            $vSupInfo->showErrorPage($user, 'You don\'t have the permession!'); //...mostra errore
        else
            $vSupInfo->showManageSupport($user);
                         
    }
    
    /**
     * Funzione che aggiorna le informazioni di supporto del musicista.
     */
    private function editSupInfo()
    {
        $vSupInfo = new VSupInfo(); // crea la view
        
        $user = CSession::getUserFromSession(); // ottiene l'utente della sessione
        if (get_class($user) == EMusician::class) // verifica che l'utente sia un musicista
        {
            $supInfo = $vSupInfo->createSupInfo(); // la view restituisce una ESupInfo costruita a partire dalla form
            if ($vSupInfo->validateLoad($supInfo)) // se l'oggetto e' valido
            {
                $user->setSupportInfo($supInfo);
                $vSupInfo->showManageSupport($user, true);
            } 
            else
                $vSupInfo->showManageSupport($user);
        } else
            $vSupInfo->showErrorPage($user, 'You must be a Musician!');
    }
    
    
    
}