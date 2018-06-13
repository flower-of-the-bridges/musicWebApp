<?php
require_once 'inc.php';

class CFollower
{
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
                            header('Location: /deepmusic/user/profile/' . $followUser->getId() . '&song'); // redirect al profilo
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
                            header('Location: /deepmusic/user/profile/' . $followUser->getId() . '&song');
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

