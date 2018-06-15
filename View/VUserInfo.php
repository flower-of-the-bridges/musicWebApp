<?php

require_once 'inc.php';
include_once 'View/VObject.php';

class VUserInfo extends VObject
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->check = array(
            'firstName' => true,
            'lastName' => true,
            'birthPlace' => true,
            'birthDate' => true,
            'bio' => true,
            'file' => true
        );
    }
    
    /**
     * Funzione che permette la creazione delle info utente con i valori prelevati da una form
     * @return EUserInfo ottenuta dai campi della form
     */
    function createUserInfo() : EUserInfo
    {
        $userInfo = new EUserInfo();
        if(isset($_POST['firstName']))
            $userInfo->setFirstName($_POST['firstName']);
        if(isset($_POST['lastName']))
            $userInfo->setLastName($_POST['lastName']);
        if(isset($_POST['birthPlace']))
            $userInfo->setBirthPlace($_POST['birthPlace']);
        if(isset($_POST['birthDate']))
            $userInfo->setBirthDate($_POST['birthDate']);
        if(isset($_POST['birthDate']))
            $userInfo->setBirthDate($_POST['birthDate']);
        if(isset($_POST['genre']))
            $userInfo->setGenre($_POST['genre']);
    
        return $userInfo;
    }
    
    /**
     * Funzione che permette la creazione delle info utente con i valori prelevati da una form
     * @return EUserInfo ottenuta dai campi della form
     */
    function  createUserPic() : EImg
    {
        $img = new EImg();
        
        if(isset($_POST['file']))
        {
            $img->setImg(file_get_contents($_FILES['file']['tmp_name']));
            $img->setSize($_FILES['file']['size']);
            $img->setType($_FILES['file']['type']);
        }
        return $img;
    }
    
    
    /**
     * Mostra le informazioni del profilo di un utente
     *
     * @param EUserInfo $profileInfo
     *            l'oggetto di cui mostrare le informazioni
     * @param EUser $loggedUser
     *            l'utente che ha effettuato l'accesso alla sessione
     * @param array $array
     *            l'array dei contenuti da visualizzare
     */
    function showProfileInfo(EUserInfo &$profileInfo, EUser &$loggedUser, array $array = null)
    {
        $this->smarty->registerObject('user', $loggedUser);
        
        $this->smarty->assign('array', $array);
        
        #$this->smarty->display('profileInfo.tpl');???????
    }
    
    
    /**
     * Mostra la form di prima inserzione delle info utente
     *
     * @param bool $error
     *            facoltativo se presente un errore
     */
    function showSignUpInfo (EUser $user, bool $error = null)
    {
        if(!$error)
            $error = false;
        
        $userInfo = new EUserInfo();
 
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('userInfo', $userInfo);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));

        $this->smarty->assign('error', $error);
        $this->smarty->display('registerUserInfo.tpl');
    }
    
    function validateUserInfo(EUserInfo $eui)
    {
        $eui->validateInfo($this->check['firstName'], $this->check['lastName'], $this->check['birthPlace'], $this->check['birthDate']);
    }
    
    
    /**
     * Mostra la form di modifica delle info utente
     *
     * @param bool $error
     *            facoltativo se presente un errore
     */
    function showUserInfoForm(EUser &$user, bool $error = NULL)
    {
        if (! $error)
            $error = false;
          
        $userInfo = $user->getUserInfo();
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uInfo', $userInfo);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        
        $this->smarty->assign('error', $error);
        $this->smarty->display('registerUserInfo.tpl');
    }
    
    
}

?>