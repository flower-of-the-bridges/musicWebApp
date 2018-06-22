<?php

if(file_exists('config.inc.php'))
    require_once 'config.inc.php';
require_once 'inc.php';

/**
 * La classe CAdmin fornisce un accesso all'amministratore del database per effettuare alcune
 * operazioni basiche attraverso l'applicazione, come :
 * - signup di utenti esteso (possibilità di aggiungere moderatori)
 * - rimozione di tuple dalla table supporter che hanno la data di scadenza scaduta
 * @author gruppo2
 * @package Controller
 *
 */
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
            $vAdmin = new VAdmin();
            $user = CSession::getUserFromSession();
            if(!CSession::checkAdminPrivileges())
                $vAdmin->showLogin();
            else
                header('Location: /deepmusic/admin/panel');
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CAdmin::authentication();
            else
                header('Location: HTTP/1.1 Invalid HTTP method detected');
    }
    
    /**
     * Mostra il pannello di amministrazione.
     */
    static function panel()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') // se il metodo e' get...
        { 
            $vAdmin = new VAdmin();
            $user = CSession::getUserFromSession();
            if(CSession::checkAdminPrivileges()) // se l'utente ha i privilegi, accede
                $vAdmin->showPanel($user);
            else 
                $vAdmin->showErrorPage($user, 'You don\'t have administration privilegies');
        }
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
            $vAdmin = new VAdmin();
            $user = CSession::getUserFromSession();
            
            if (CSession::checkAdminPrivileges()) // se l'utente non è guest, non puo accedere al login
                $vAdmin->showSignUp();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            CAdmin::register();
        else
            header('Location: Invalid HTTP method detected');
    }
    
    /**
     * Effettua il logout dalla sessione di amministrazione.
     */
    static function logout()
    {
        CSession::removeAdminPrivileges();
        header('Location: /deepmusic/index');
    }
    
    /**
     * La funzione authentication verifica che le credenziali di accesso al pannello di amministrazione
     * (le stesse usate per l'accesso al database) siano valide. In caso affermativo, instaura un parametro 
     * di sessione che denota il privilegio di amministrazione e effettua un redirect verso il pannello di controllo.
     */
    private function authentication()
    {
        $vAdmin = new VAdmin();
        $user = CSession::getUserFromSession();
        list($userAdmin, $userPassword) = $vAdmin->getUserAndPassword();
        
        global $admin, $pass;
        
        if($userAdmin == $admin && $userPassword == $pass)
        {
            CSession::setAdminPrivileges();
            header('Location: /deepmusic/admin/panel');
        }
        else
            $vAdmin->showLogin(true);
       
    }
    
    /**
     * La funzione Register permette di creare un nuovo utente
     * ammesso che non vi siano presenti utenti con stessa mail o nome utente inseriti nella form
     */
    private function register()
    {
        $vAdmin = new VAdmin();
        $loggedUser = CSession::getUserFromSession();
        $createdUser = $vAdmin->createUser(); // viene creato un utente con i parametri della form
        
        if($vAdmin->validateSignUp($createdUser))
        {
            if(!FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_NICKNAME, $createdUser->getNickName())
                && !FPersistantManager::getInstance()->exists(EUser::class, FTarget::EXISTS_MAIL, $createdUser->getMail()))
            {
                // se il nickname e la mail non sono stati ancora usati, si puo salvare l'utente
                
                $createdUser->hashPassword(); // si cripta la password
                
                FPersistantManager::getInstance()->store($createdUser); // si salva l'utente
                
                if(is_a($createdUser, EMusician::class)) // se l'utente e' musicista...
                {
                    $createdUser->setSupportInfo(); // ..carica le info di supporto di default
                }
                
                $createdUser->setUserInfo();
                $createdUser->setImage();
                
                
                header('Location: /deepmusic/advanced/panel/');
            }
            else
                $vAdmin->showSignUp(true);
        }
        else
            $vAdmin->showSignUp();
    }
    
}

