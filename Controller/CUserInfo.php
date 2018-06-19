<?php

require_once 'inc.php';

/**
 * La classe CUserInfo implementa la funzionalità 'Gestione Profilo': le sue funzioni infatti
 * presentano/ricevono una form in cui l'utente inserirà informazioni su di se, come :
 * - Nome e Cognome (se non è un Musician)
 * - Info 
 * - Data di Nascita
 * - Luogo di Nascita
 * - Immagine del profilo
 * 
 * @author gruppo2
 * @package Controller
 *
 */
class CUserInfo
{
    /**
     * A seconda del tipo di metodo richiesto dal client, verranno attivate funzioni diverse.
     * In particolare:
     * - register() salva su DB le informazioni inserite dall'utente.
     * - showUserInfoForm() mostra all'utente la form in cui inserire i dati.
     */
    static function editInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CUserInfo::register();
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            CUserInfo::showUserInfoForm();
        }
    }
    
    /**
     * La funzione Register permette di creare un nuovo oggetto info utente e salvarlo sul DB.
     * Se anche l'immagine è stata caricata, salverà anche il corrispondente oggetto EImg
     */
    private function register()
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        $loggedUserInfo = $vUserInfo->createUserInfo();
        $loggedUser->setUserInfo($loggedUserInfo);
        
        $pic = $vUserInfo->createUserPic();
        
        if($pic->getSize())
        {
            $loggedUser->setImage($pic);   
        }
        
        
    }
    
    /**
     * Mostra all'utente la form per la modifica delle informazioni. Se l'utente è Guest, verrà
     * reindirizzato ad un messaggio di errore.
     */
    private function showUserInfoForm()
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        if(get_class($loggedUser)!=EGuest::class)
        {
            $vUserInfo->showUserInfoForm($loggedUser);
        }
        else 
            $vUserInfo->showErrorPage($loggedUser, 'You must be a DeepMusic\'s user to edit your info!');
        
    }
    
    static function setDefaultUserImg(EUser &$log)
    {
        $file = "./def/defProPic.jpg";
        $img = new EImg();
        $img->setImg(file_get_contents($file));
        $img->setType(mime_content_type($file));
        $img->setSize(filesize($file));
        
        $log->setImage($img);
    }
    
}




?>