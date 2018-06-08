<?php
require_once 'inc.php';

/**
 * @author gruppo2
 * Il Controller CSong implementa le funzionalità del caso d'uso 'Gestione Brano'.
 *
 */
class CSong
{

    /**
     * La funzione load permette la visualizzazione della form per il caricamento di una canzone, 
     * a seguito di un metodo GET, o l'inserimento di una canzone da parte di un utente a seguito 
     * del metodo POST.
     */
    static function load()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            CSong::showLoadForm();
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CSong::addSong();
        else
            header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    /**
     * Mostra la form per il caricamento di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un musicista
     */
    private function showLoadForm()
    {
        $vSong = new VSong();
        
        $loggedUser = CSession::getUserFromSession();
        
        if(get_class($loggedUser)!=EMusician::class) // se l'utente non e' musicista...
            $vSong->showErrorPage($loggedUser, 'If you want to add a song, you must be a Musician!'); //...mostra errore
        else //...altrimenti mostra la form
            $vSong->showLoadForm($loggedUser);
            
    }
    
    /**
     * Metodo che consente l'associazione di una canzone all'utente che l'ha caricata. Se l'associazione va a buon
     * fine, la canzone viene salvata nel database.
     */
    private function addSong()
    {
        $vSong = new VSong(); // crea la view 
        $song = $vSong->createSong(); // la view restituisce una ESong costruita a partire dalla form
        $user = CSession::getUserFromSession(); // ottiene l'utente della sessione
        
        if($vSong->validateLoad($song) && get_class($user)==EMusician::class)
        {
            ini_set( "upload_max_filesize","120M"); // aumenta il limite di upload
       
            $song->setArtist($user);
            if(FPersistantManager::getInstance()->store($song))
            {
                $song->getMp3()->setId($song->getId()); // assegna all'mp3 l'id appena ottenuto
                if(FPersistantManager::getInstance()->store($song->getMp3())) // se il caricamento dell'mp3 ha successo
                    header('Location: /deepmusic/user/profile/'.$user->getId().'&song');
                else
                { // altrimenti cancella la canzone nella table song e ritorna false
                    FPersistantManager::getInstance()->remove(ESong::class, $song->getId(), $song->getArtist()->getId());
                    $vSong->showErrorPage($user, 'An error occurs!');
                }
            }
            else 
                $vSong->showErrorPage($user, 'An error occurs!');
        }
        else 
            $vSong->showLoadForm($user, true);
    }
}

