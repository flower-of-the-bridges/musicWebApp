<?php

if(file_exists('config.inc.php'))
    require_once 'config.inc.php';
    

require_once 'inc.php';

class CAdmin
{
    /**
     * Metodo che implementa il caso d'uso di login. Se richiamato tramite GET, fornisce
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
    
    /**
     * Metodo che implementa il caso d'uso di registrazione. Se richiamato a seguito di una richiesta
     * GET da parte del client, mostra la form di compilazione; altrimenti se richiamato tramite POST
     * riceve i dati forniti dall'utente e procede con la creazione di un nuovo utente.
     */
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
     * Effettua il logout.
     */
    static function logout()
    {
        CSession::destroySession();
        header('Location: /deepmusic/home');
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
        
        try{
            global $address, $database;
            $this->db = new PDO ("mysql:host=$address;dbname=$database", $loggedUser->getNickName(), $loggedUser->getPassword());
            
        }
        catch (PDOException $e){
            echo "Errore : " . $e->getMessage();
            die;
        }
    }
    
    /**
     * La funzione Register permette di creare un nuovo utente
     * ammesso che non vi siano presenti utenti con stessa mail o nome utente inseriti nella form
     */
    private function register()
    {
        $vUser = new VUser();
        $loggedUser = $vUser->createUser(); // viene creato un utente con i parametri della form
        
        if($vUser->validateSignUp($loggedUser))
        {
            if(!FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $loggedUser->getNickName())
                && !FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_MAIL, $loggedUser->getMail()))
            {
                // se il nickname e la mail non sono stati ancora usati, si puo salvare l'utente
                
                $loggedUser->hashPassword(); // si cripta la password
                
                FPersistantManager::getInstance()->store($loggedUser); // si salva l'utente
                
                CSession::startSession($loggedUser);
                
                if(is_a($loggedUser, EMusician::class)) // se l'utente e' musicista...
                {
                    $loggedUser->setSupportInfo(); // ..carica le info di supporto di default
                }
                
                $loggedUser->setUserInfo();
                $loggedUser->setImage();
                
                
                header('Location: /deepmusic/userInfo/editInfo/');
            }
            else
                $vUser->showSignUp(true);
        }
        else
            $vUser->showSignUp();
    }
    
}

