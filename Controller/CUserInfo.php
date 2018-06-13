<?php

require_once 'inc.php';

class CUserInfo
{
    /**
     * La funzione mostra le informazioni del profilo di un utente.
     * @param $string l'argomento della url. se non specificato, si viene reindirizzati ad una pagina di errore.
     */
    static function profile($string = null)
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if($params = explode('&', $string)) //se l'url è nella forma "id&content", si separano i valori
            {
                if(is_numeric($params[0])) //se il primo valore è l'id....
                {
                    //si caricano i dati dell'utente relativo
                    $profileInfo = FPersistantManager::getInstance()->load(EUserInfo::class, $params[0]);
                    
                    if($profileInfo)
                    {
                        $following = false; // bool che denota se l'utente della sessione sta seguendo l'utente del profilo
                        
                        if($loggedUser->getId()!=$profileInfo->getId())
                        { // se l'id dei due utenti e' diverso, si verifica se l'utente sessione segue l'utente del profilo cercato
                            $follower = new EFollower();
                            $follower->setUser($profileUser);
                            $follower->setFollower($loggedUser);
                            $following = $follower->exists();
                        }
                        
                        // array contenente i dati dell'utente da visualizzare
                        $array = FPersistantManager::getInstance()->load(EUserInfo::class, $params[0]); 
                        
                        $vUserInfo->showProfileInfo($profileInfo, $loggedUser, $array);
                    }
                    else 
                        $vUserInfo->showErrorPage($loggedUser, 'The user id doesn\'t match any DeepMusic\'s user!');
                }
                else
                    $vUser->showErrorPage($loggedUser, 'The URL is invalid!');
            }
            else
                $vUser->showErrorPage($loggedUser, 'The URL is invalid!');
        }
        else
            $vUser->showErrorPage($loggedUser, 'The URL has too few arguments');
    }
    
    
    /**
     * La funzione Register permette di creare un nuovo oggetto info utente
     */
    private function register()
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        $loggedUserInfo = $vUserInfo->createUserInfo();
        $loggedUserInfo->setId($loggedUser->getId());
        
        FPersistantManager::getInstance()->store($loggedUserInfo);
        
        #in teoria prima di tornare al profilo dopo la registrazione l'utente deve essere guidato qui
        header('Location: /deepmusic/user/profile/'.$loggedUser->getId().'&song');
        
    }
    
    static function signupinfo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CUserInfo::register();
        else
            header('Location: Invalid HTTP method detected');
    }
    
}




?>