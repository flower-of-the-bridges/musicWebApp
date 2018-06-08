<?php

require_once 'inc.php';

class CUser
{
    /**
     * Metodo che implementa la funzionalita' di login. Se richiamato tramite GET, fornisce
     * la pagina di login, se richiamato tramite POST cerca di autenticare l'utente attraverso
     * i valori che quest'ultimo ha fornito
     */
    static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') // se il metodo e' get...
        { //...carica la pagina del login, se l'utente e' effettivamente un guest
            $vUser = new VUser();
            $user = CSession::getUserFromSession();
            if(get_class($user)!=EGuest::class) // se l'utente non è guest, non puo accedere al login
            {
                $vUser->showErrorPage($user, 'Why are you doing this? Yuo\'re already logged!');
            }
            else
                $vUser->showLogin();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CUser::authentication();
        else
            header('Location: HTTP/1.1 Invalid HTTP method detected');
    }

    static function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') //se il metodo http utilizzato e' GET...
        { //...visualizza la pagina di signup, controllando che l'utente sia effettivamente un guest
            $vUser = new VUser();
            $user = CSession::getUserFromSession();
            if (get_class($user)!=EGuest::class) // se l'utente non è guest, non puo accedere al login
                $vUser->showErrorPage($user, 'Why are you doing this? Yuo\'re already logged!');
            else
                $vUser->showSignUp();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CUser::register();
        else
            header('Location: Invalid HTTP method detected');
    }
    
    /**
     * La funzione mostra il profilo di un utente. A seconda del tipo di URL, saranno visualizzati contenuti differenti.
     * In particolare:
     *  - /deepmusic/user/profile/id&song mostra la lista delle canzoni
     *  - /deepmusic/user/profile/id&follower mostra la lista dei follower
     *  - /deepmusic/user/profile/id&following mostra la lista dei following dell'utente
     * @param $string l'argomento della url. se non specificato, si viene reindirizzati ad una pagina di errore.
     */
    static function profile($string = null)
    {
        $vUser = new VUser();
        $loggedUser = CSession::getUserFromSession();
        
        if ($string && $_SERVER['REQUEST_METHOD'] == 'GET') // se la stringa e' specificata, l'url e' completa e si puo procedere
        {
            if (is_numeric($string)) // se presenta solo l'id
            {
                $profileUser = FPersistantManager::getInstance()->load(EUser::class, $string); // si cerca di caricare l'utente dal database
                if ($profileUser) // se esiste...
                    $vUser->showProfile($profileUser, $loggedUser, 'None'); // si mostra il profilo base
                else
                    $vUser->showErrorPage($loggedUser, 'The user id doesn\'t match any DeepMusic\'s user!'); // altrimenti si reindirizza ad una pagina di errore
            } 
            elseif ($params = explode('&', $string)) // se l'url e' nella forma "id&content", si separano i valori
            {
                if (is_numeric($params[0])) // se il primo valore e' l'id...
                {
                    // si effettua il caricamento dell'utente
                    $profileUser = FPersistantManager::getInstance()->load(EUser::class, $params[0]);
                    
                    if ($profileUser) 
                    {
                        if ($params[1] == 'song')  // se il parametro e' song
                        {
                            // si carica la lista delle canzoni dell'utente (caricate se musician, preferite se listener)
                            $songs = FPersistantManager::getInstance()->load(ESong::class, $params[0], FTarget::LOAD_MUSICIAN_SONG);
                            $vUser->showProfile($profileUser, $loggedUser, 'Song List', $songs);
                        }
                    } 
                    else
                        $vUser->showErrorPage($loggedUser, 'The user id doesn\'t match any DeepMusic\'s user!');
                } 
                else
                    header('Location: HTTP/1.1 Invalid URL scheme');
            } 
            else
                header('Location: HTTP/1.1 Invalid HTTP method detected');
        } 
        else
            $vUser->showErrorPage($loggedUser, 'The URL has too few arguments');
    }

    /**
     * La funzione Authentication verifica che le credenziali di accesso inserite da un utente
     * siano corrette: in tal caso, l'applicazione lo riporterà verso la sua pagina, altrimenti
     * restituirà la schermata di login, con un messaggio di errore
     */
    private function authentication()
    {
        $vUser = new VUser();
        $loggedUser = $vUser->createUser();
        
        if($vUser->validateLogin($loggedUser))
        {
            $authenticated = false; // bool per l'autenticazione
            
            $userId = FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $loggedUser->getNickName()); // si verifica che l'utente inserito matchi una entry nel db
            
            if($userId) // se e' stato prelevato un id...
            {
               
                $loggedUser->setId($userId); // viene assegnato all'utente l'user id

                if($loggedUser->checkPassword()) // se la password e' corretta
                {
                    unset($loggedUser); // l'istanza utilizzata per il login viene rimossa
                    $user = FPersistantManager::getInstance()->load(EUser::class, $userId); // viene caricato l'utente
                    
                    $authenticated = true; // l'utente e' autenticato
                    
                    CSession::startSession($user);
                                    
                    header('Location: /deepmusic/index');
                }
            }
            
            if(!$authenticated)
                $vUser->showLogin(true);
                
        }
        else
            $vUser->showLogin();
            
    }
    
    /**
     * La funzione Authentication verifica che le credenziali di accesso inserite da un utente
     * siano corrette: in tal caso, l'applicazione lo riporterà verso la sua pagina, altrimenti
     * restituirà la schermata di login, con un messaggio di errore
     */
    private function register()
    {
        $vUser = new VUser();
        $loggedUser = $vUser->createUser(); // viene creato un utente con i parametri della form
        
        if($vUser->validateSignUp($loggedUser))
        {
            if(!FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $loggedUser->getName())
                && !FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_MAIL, $loggedUser->getMail()))
            {
                // se il nickname e la mail non sono stati ancora usati, si puo salvare l'utente
 
                $loggedUser->hashPassword(); // si cripta la password
            
                FPersistantManager::getInstance()->store($loggedUser); // si salva l'utente
                
                CSession::startSession($loggedUser);
               
                $vUser->showProfile($loggedUser, $loggedUser, 'None');
            }
            else
                $vUser->showSignUp(true);
        }
        else
            $vUser->showSignUp();
            
    }
    
    /**
     * Effettua il logout.
     */
    static function logout()
    {
        CSession::destroySession();
        header('Location: /deepmusic/home');
    }
    
    
}

