<?php
require_once 'inc.php';

class CFollower
{
    static function support($id)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if (! is_a($user, EGuest::class))
        { // se l'utente non e' guest
            if (is_numeric($id))
            { // se l'url contiene un id
                $supportUser = FPersistantManager::getInstance()->load(EUser::class, $id); // si carica l'utente
                if ($supportUser) // se l'utente esiste
                { // si costruisce l'oggetto supporter
                    $supporter = new ESupporter();
                    $supporter->setArtist($supportUser);
                    $supporter->setSupport($user);
                    if ($supporter->isValid())
                    { // se l'associazione e' valida
                        if (! $supporter->exists()) // se i due utenti non si supportano
                        { // salva l'associazione nel database
                            FPersistantManager::getInstance()->store($supporter);
                            header('Location: /deepmusic/user/profile/' . $supportUser->getId() . '&song'); // redirect al profilo
                        }
                        else
                            $vUser->showErrorPage($user, 'You already suppport ' . $supportUser->getNickName() . '!');
                    }
                    else
                        $vUser->showErrorPage($user, 'You can\'t support yourself!');
                }
            }
            else
                $vUser->showErrorPage($user, 'The URL is invalid!');
        }
        else
            $vUser->showErrorPage($user, 'You must be a DeepMusic\'s user to use the support function!');
    }
    
    static function unsupport($id)
    {
        $vUser = new VUser();
        $user = CSession::getUserFromSession();
        
        if (! is_a($user, EGuest::class))
        { // se l'utente non e' un guest
            if (is_numeric($id))
            {
                $supportUser = FPersistantManager::getInstance()->load(EUser::class, $id);
                if ($supportUser)
                { // se l'utente esiste, si costruisce l'oggetto supporter
                    $supporter = new ESupporter();
                    $supporter->setArtist($supportUser);
                    $supporter->setSupport($user);
                    if ($supporter->isValid())
                    {
                        if ($supporter->exists())
                        { // se i due utenti si supportano, si rimuove la corrispondenza dal database
                            FPersistantManager::getInstance()->remove(ESupporter::class, $supporter->getArtist()->getId(), $supporter->getSupport()->getId());
                            header('Location: /deepmusic/user/profile/' . $supportUser->getId() . '&song');
                        }
                        else
                            $vUser->showErrorPage($user, 'You are not supporting ' . $supportUser->getNickName() . '!');
                    }
                    else
                        $vUser->showErrorPage($user, 'You can\'t unsupport yourself!');
                }
            }
            else
                $vUser->showErrorPage($user, 'The URL is invalid!');
        }
        else
            $vUser->showErrorPage($user, 'You must be a DeepMusic\'s user to use the support function!');
    }
}

