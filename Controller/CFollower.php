<?php
require_once 'inc.php';

/**
 * La classe CSupporter implementa la funzionalità 'Segui Utente'. Le funzioni follow/unfollow
 * permettono ad un utente di seguire/smettere di seguire un altro utente, in modo tale da poter
 * raggiungere la sua pagina in maniera più immediata.
 * @author gruppo2
 * @package Controller
 */
class CFollower
{
    /**
     * La funzione follow permette di seguire un utente. L'utente, se effettivamente non sta
     * seguendo l'utente da seguire, verrà associato ad esso attraverso un oggetto EFollower, 
     * che salverà tale associazione nel database.
     * @param int $id l'identificativo dell'utente da seguire
     */
    static function follow($id)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if (! is_a($user, EGuest::class)) 
        { // se l'utente non e' guest
            if (is_numeric($id)) 
            { // se l'url contiene un id
                $followUser = FPersistantManager::getInstance()->load(EUser::class, $id); // si carica l'utente
                if ($followUser) // se l'utente esiste
                { // si costruisce l'oggetto follower
                    $follower = new EFollower();
                    $follower->setUser($followUser);
                    $follower->setFollower($user);
                    if ($follower->isValid()) 
                    { // se l'associazione e' valida
                        if (! $follower->exists()) // se i due utenti non si seguono
                        { // salva l'associazione nel database
                            FPersistantManager::getInstance()->store($follower);
                            header('Location: /deepmusic/user/profile/' . $followUser->getId()); // redirect al profilo
                        } 
                        else
                            $vUser->showErrorPage($user, 'You already follow ' . $followUser->getNickName() . '!');
                    } 
                    else
                        $vUser->showErrorPage($user, 'You can\'t follow yourself!');
                }
            }
            else 
                $vUser->showErrorPage($user, 'The URL is invalid!');
        }
        else
            $vUser->showErrorPage($user, 'You must be a DeepMusic\'s user to use the follow function!');
    }
    
    
    /**
     * La funzione unfollow permette di smettere di seguire un utente. Se l'associazione tra i due
     * utenti è effettivamente presente, verrà regolata attraverso un oggetto EFollower,
     * che rimuoverà tale associazione nel database.
     * @param int $id l'identificativo del musicista da non seguire
     */
    static function unfollow($id)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if (! is_a($user, EGuest::class))
        { // se l'utente non e' un guest
            if (is_numeric($id))
            {
                $followUser = FPersistantManager::getInstance()->load(EUser::class, $id);
                if ($followUser)
                { // se l'utente esiste, si costruisce l'oggetto follower
                    $follower = new EFollower();
                    $follower->setUser($followUser);
                    $follower->setFollower($user);
                    if ($follower->isValid()) 
                    {
                        if ($follower->exists()) 
                        { // se i due utenti si seguono, si rimuove la corrispondenza dal database
                            FPersistantManager::getInstance()->remove(EFollower::class, $follower->getUser()->getId(), $follower->getFollower()->getId());
                            header('Location: /deepmusic/user/profile/' . $followUser->getId());
                        } 
                        else
                            $vUser->showErrorPage($user, 'You are not following ' . $followUser->getNickName() . '!');
                    } 
                    else
                        $vUser->showErrorPage($user, 'You can\'t unfollow yourself!');
               }
            }
            else
                $vUser->showErrorPage($user, 'The URL is invalid!');
        }
        else
            $vUser->showErrorPage($user, 'You must be a DeepMusic\'s user to use the follow function!');
    }
}

