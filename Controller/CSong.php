<?php
require_once 'inc.php';

/**
 * @author gruppo2
 * Il Controller CSong implementa le funzionalità 'Gestione Brano'.
 * Un musicista può creare un brano, ed insieme ai moderatori può modificarlo o rimuoverlo.
 * @package Controller
 */
class CSong
{

    /**
     * La funzione load corrisponde al caso d'uso 'Carica Brano' e permette la visualizzazione della form 
     * per il caricamento di una canzone, a seguito di una richiesta GET, o l'inserimento di una canzone da parte di un utente a seguito 
     * di una richiesta POST.
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
     * La funzione edit implementa il caso d'uso 'Modifica Brano' e permette la visualizzazione 
     * della form per la modifica di una canzone, a seguito di una richiesta GET, 
     * o l'inserimento delle modifiche di una canzone da parte di un utente a seguito di una richiesta POST.
     *
     * @param int $id l'identificativo della canzone, specificato nell'URL.
     * 
     */
    static function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            CSong::showEditForm($id);
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(is_numeric($id))
                CSong::editSong($id);
            else
                header('Location: /deepmusic/home');
        }
        else
            header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    /**
     * La funzione remove implementa il caso d'uso 'Rimuovi Brano' e permette la visualizzazione 
     * della form per la rimozione di una canzone, a seguito di una richiesta GET, o la conferma 
     * dell'operazione da parte di un utente a seguito di una richiesta POST.
     * 
     * @param int $id l'identificativo della cazone, prelevato dall'URL.
     */
    static function remove($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            CSong::showRemoveForm($id);
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(is_numeric($id))
                CSong::removeSong($id);
            else
                header('Location: /deepmusic/home');
        }
        else
            header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    /**
     * La funzione show permette la visualizzazione della canzone da parte di un utente. Se l'utente 
     * può effettivamente visualizzarla, sarà possibile riprodurla, altrimenti verrà mostrato un 
     * messaggio d'errore. In caso la canzone sia visualizzata dall'artista stesso o da un moderatore,
     * sarà possibile visualizzare funzionalità come la modifica o la rimozione.
     * 
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
                $download = false; // variabile booleana che denota se l'utente può scaricare il brano
                
                if($user->getId() == $song->getArtist()->getId() || is_a($user, EModerator::class)) // se l'utente è l'autore della canzone
                {
                    $canSee = true;
                    $download = true;
                }
                else if($song->isForAll()) // se è per tutti...
                    $canSee = true;
                else if ($song->isForRegisteredOnly() && get_class($user)!=EGuest::class) // se è per i registrati e l'utente non è guest...
                    $canSee = true;
                else if ($song->isForSupportersOnly() &&
                    FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $song->getArtist()->getId(), $user->getId()))
                    // se è per i supporter e l'utente supporta l'artista della canzone...
                {
                    $download = true;
                    $canSee = true;
                }
                            
               $vSong->showSong($user, $song, $canSee, $download); // mostra la pagina della canzone
            }
            else
                $vSong->showErrorPage($user, 'The song\'s id doesn\'t match any song stored in the system.');
        }
        else
            header('Location: HTTP/1.1 405 Invalid URL detected');
    }
    
    /**
     * La funzione show permette la visualizzazione della canzone da parte di un utente. Se l'utente
     * può effettivamente visualizzarla, sarà possibile riprodurla, altrimenti verrà mostrato un
     * messaggio d'errore. In caso la canzone sia visualizzata dall'artista stesso o da un moderatore,
     * sarà possibile visualizzare funzionalità come la modifica o la rimozione.
     *
     * @param int $id l'identificativo della canzone da visualizzare.
     */
    static function download($id)
    {
        if(is_numeric($id)) // se nell'url è effettivamente presente un id.
        {
            $vSong = new VSong(); // crea la view
            $user = CSession::getUserFromSession(); // ottiene l'utente dalla sessione
            $song = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la canzone dell'id
            if($song) // se la canzone esiste, esegue il controllo di visibilità
            {
                if (is_a($user, EModerator::class) || ($song->isForSupportersOnly() &&
                     FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $song->getArtist()->getId(), $user->getId())))
                                // se è per i supporter e l'utente supporta l'artista della canzone...
                {
                    $mp3 = FPersistantManager::getInstance()->load(EMp3::class, $song->getId());
                    
                    header('Content-Description: File Transfer');
                    header('Content-Lenght: '.$mp3->getSize() );
                    header('Content-Type: '.$mp3->getType());
                    $fileName = $song->getArtist()->getNickName().'-'.$song->getName();
                    header('Content-Disposition: attachment; filename= '.$fileName.'.mp3');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    
                    ob_clean();
                    flush();
                    echo $mp3->getMp3();
                    exit;
                }
                else 
                    $vSong->showErrorPage($user, 'You can\'t download this song');
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
     * Mostra la form per il caricamento di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un musicista.
     * @param int $id l'identificativo della cazone.
     */
    private function showEditForm($id)
    {
        $vSong = new VSong();       
        $user = CSession::getUserFromSession();
        
        if(is_numeric($id)) // verifica che nell'url sia stato inserito un id
        {
            $song = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la canzone dal db
            if($song) // se la canzone esiste...
            { // verifica che l'utente puo' effettivamente modificarla
                if($song->getArtist()->getId()==$user->getId() || is_a($user, EModerator::class))
                    $vSong->showEditForm($user, $song);
                else 
                    $vSong->showErrorPage($user, 'You don\'t have the permission to edit this song!');
            }
            else // altrimenti mostra una pagina d'errore.
                $vSong->showErrorPage($user, 'The id doesn\'t match any song.');
        }
        else 
            $vSong->showErrorPage($user, 'The URL is invalid.');                
    }
    
    /**
     * Mostra la form per la rimozione di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un musicista.
     * @param int $id l'identificativo della cazone.
     */
    private function showRemoveForm($id)
    {
        $vSong = new VSong();
        $user = CSession::getUserFromSession();
        
        if(is_numeric($id)) // verifica che nell'url sia stato inserito un id
        {
            $song = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la canzone dal db
            if($song) // se la canzone esiste...
            { // verifica che l'utente puo' effettivamente rimuoverla
                if($song->getArtist()->getId()==$user->getId() || is_a($user, EModerator::class))
                    $vSong->showRemoveForm($user, $song); // mostra la pagina di rimozione
                else
                    $vSong->showErrorPage($user, 'You don\'t have the permission to remove this song!');
            }
            else 
                // altrimenti mostra una pagina d'errore.
                $vSong->showErrorPage($user, 'The id doesn\'t match any song.');
        }
        else
            $vSong->showErrorPage($user, 'The URL is invalid.');
    }
    
    /**
     * Metodo che consente l'associazione di una canzone all'utente che l'ha caricata. Se l'associazione va a buon
     * fine, la canzone viene salvata nel database.
     */
    private function addSong()
    {
        $vSong = new VSong(); // crea la view 
        
        $user = CSession::getUserFromSession(); // ottiene l'utente della sessione
        if (get_class($user) == EMusician::class) // verifica che l'utente sia un musicista
        {
            $song = $vSong->createSong(); // la view restituisce una ESong costruita a partire dalla form
            if ($vSong->validateLoad($song)) // se l'oggetto e' valido
            {
                $song->setArtist($user); // si imposta l'utente della canzone
                if (FPersistantManager::getInstance()->store($song)) 
                {
                    $song->getMp3()->setId($song->getId()); // assegna all'mp3 l'id appena ottenuto
                    if (FPersistantManager::getInstance()->store($song->getMp3())) // se il caricamento dell'mp3 ha successo
                    {
                        $user->setGenre(); // aggiorna il genere musicale
                        header('Location: /deepmusic/user/profile/' . $user->getId());
                    }
                    else 
                    { // altrimenti cancella la canzone nella table song e ritorna false
                        FPersistantManager::getInstance()->remove(ESong::class, $song->getId());
                        $vSong->showErrorPage($user, 'An error occurs!');
                    }
                } 
                else
                    $vSong->showErrorPage($user, 'An error occurs!');
            } 
            else
                $vSong->showLoadForm($user, false);
        } 
        else
            $vSong->showErrorPage($user, 'You can\'t upload a song! You are not a musician!');
    }
    
    /**
     * Mostra la form per il caricamento di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un musicista.
     * @param int $id l'identificativo della cazone.
     */
    private function editSong($id)
    {
        $vSong = new VSong();
        $user = CSession::getUserFromSession();
        
        $songNew = $vSong->createSong(); // la view restituisce una ESong costruita a partire dalla form
        $songOld = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la vecchia canzone dal db
        if($songOld) // se la canzone esiste
        {
            // verifica che l'utente puo' effettivamente modificarla
            if($songOld->getArtist()->getId()==$user->getId() || is_a($user, EModerator::class))
            {
                if($vSong->validateEdit($songNew)) // verifica che le modifiche siano corrette
                {
                    $songNew->setId($songOld->getId());
                    $songNew->setArtist($songOld->getArtist());
                    FPersistantManager::getInstance()->update($songNew);
                    
                    if(is_a($user, EMusician::class))  // se l'utente e' musicista
                        $user->setGenre(); // aggiorna il genere musicale
                    
                    header('Location: /deepmusic/song/show/'.$songNew->getId());
                }
                else
                    $vSong->showEditForm($user, $songOld, false);
                    
            }
            else
                $vSong->showErrorPage($user, 'You don\'t have the permission to edit this song!');
            
        }
        else   
        {
            $vSong->showErrorPage($user, 'The id doesn\'t match any song.');
        }
    }
    
    /**
     * Effettua l'operazione per la rimozione di una canzone. Reindirizza ad un messaggio di errore
     * se l'utente che vuole rimuovere il brano non è l'autore del brano stesso.
     * @param int $id l'identificativo della cazone.
     */
    private function removeSong($id)
    {
        $vSong = new VSong();
        $user = CSession::getUserFromSession();
        $song = FPersistantManager::getInstance()->load(ESong::class, $id); // carica la canzone dell'url

        if($song) // se la canzone esiste 
        {
            
            if($song->getArtist()->getId()==$user->getId() || is_a($user, EModerator::class)) // verifica che l'utente puo' effettivamente rimuoverla
            {
               
                if($vSong->validateRemove()) // se l'utente ha deciso di rimuoverla...
                { // ...la canzone viene rimossa
                    FPersistantManager::getInstance()->remove(ESong::class, $song->getId()); // rimuove la canzone
                    
                    if(is_a($user, EMusician::class))  // se l'utente e' musicista
                        $user->setGenre(); // aggiorna il genere musicale
                    
                    header('Location: /deepmusic/user/profile/'.$user->getId()); // l'utente viene reindirizzato al profilo
                }
                else // altrimenti si viene reindirizzati ad una pagina di errore 
                    header('Location: /deepmusic/song/show/'.$song->getId()); 
            }
            else 
                $vSong->showErrorPage($user, 'You don\'t have the permission to remove this song!');
                
        }
        else
        {
            $vSong->showErrorPage($user, 'The id doesn\'t match any song.');
        }
    }
}

