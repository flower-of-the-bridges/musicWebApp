<?php

require_once 'inc.php';

class CUserInfo
{

       
    /**
     * La funzione Register permette di creare un nuovo oggetto info utente
     */
    private function register()
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        $loggedUserInfo = $vUserInfo->createUserInfo();
        
        $loggedUser->setUserInfo($loggedUserInfo);
        
        $pic=$vUserInfo->createUserPic();
        
        if($pic)
        {
            $loggedUser->setImage($pic);   
        }
        
        #in teoria prima di tornare al profilo dopo la registrazione l'utente deve essere guidato qui
        header('Location: /deepmusic/user/profile/'.$loggedUser->getId().'&song');
        
    }
    
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
 
    
    private function showUserInfoForm()
    {
        $vUserInfo = new VUserInfo();
        $loggedUser = CSession::getUserFromSession();
        
        $ui = $loggedUser->getUserInfo();
        
        $vUserInfo->showUserInfoForm($loggedUser);
    }
    
}




?>