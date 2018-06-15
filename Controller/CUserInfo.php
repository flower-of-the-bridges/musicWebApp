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
        var_dump($loggedUserInfo);
        var_dump($loggedUserInfo->getBirthDate());
        $loggedUser->setUserInfo($loggedUserInfo);
        
        $pic = $vUserInfo->createUserPic();
        
        if($pic->getSize())
        {
            $loggedUser->setImage($pic);   
        }
        
        
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
        if(get_class($loggedUser)!=EGuest::class)
        {
            $vUserInfo->showUserInfoForm($loggedUser);
        }
        else 
            $vUserInfo->showErrorPage($loggedUser, 'You must be a DeepMusic\'s user to edit your info!');
        
    }
    
}




?>