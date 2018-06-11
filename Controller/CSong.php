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
     * La funzione load permette la visualizzazione della canzone da parte di un utente. Se l'utente 
     * può effettivamente visualizzarla, sarà possibile riprodurla, altrimenti verrà mostrato un 
     * messaggio d'errore. In caso la canzone sia visualizzata dall'artista stesso o da un moderatore,
     * sarà possibile visualizzare funzionalità come la modifica o la rimozione
     * @param int $id l'identificativo della canzone da visualizzare.
     */
    static function show($id)
    {
        if(is_numeric($id)) // se nell'url è effettivamente presente un id.
        {
            $vSong = new VSong(); // crea la view
            $user = CSession::getUserFromSession(); // ottiene l'utente dalla sessione
            $song = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la canzone dell'id
            if($song) // se la canzone esiste, esegue il controllo di visibilità
            {
                $canSee = false; // variabile booleana che denota se l'utente può vedere la canzone o no
                
                if($user->getId() == $song->getArtist()->getId() || is_a($user, EModerator::class)) // se l'utente è l'autore della canzone
                    $canSee = true;
                else if($song->isForAll()) // se è per tutti...
                    $canSee = true;
                else if ($song->isForRegisteredOnly() && get_class($user)!=EGuest::class) // se è per i registrati e l'utente non è guest...
                    $canSee = true;
                else if ($song->isForSupportersOnly() &&
                         FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $user->getId(), $song->getArtist()->getId()))
                    // se è per i supporter e l'utente supporta l'artista della canzone...
                    $canSee = true;
                            
               $vSong->showSong($user, $song, $canSee); // mostra la pagina della canzone
            }
            else
                $vSong->showErrorPage($user, 'The song\'s id doesn\'t match any song stored in the system.');
        }
        else
            header('Location: HTTP/1.1 405 Invalid URL detected');
    }
    
    /**
     * Mostra la form per il caricamento di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un musicista.
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

