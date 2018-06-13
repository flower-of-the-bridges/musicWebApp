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
        );
    }
    
    /**
     * Funzione che permette la creazione delle info utente con i valori prelevati da una form
     * @return EUserInfo ottenuta dai campi della form
     */
    function createUserInfo() : EUserInfo
    {
        $userInfo;
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
        //TODO
    }
    
    
    /**
     * Mostra la form di prima inserzione delle info utente
     *
     * @param bool $error
     *            facoltativo se presente un errore
     */
    function showSignUpInfo (bool $error = null)
    {
        if(!$error)
            $error = false;
        
        $userInfo = new EUserInfo();
        
        $this->smarty->registerObject('userInfo', $userInfo);

        $this->smarty->assign('error', $error);
        $this->smarty->display('registerUserInfo.tpl');
    }
    
    
    /**
     * Mostra la form di modifica delle info utente
     *
     * @param bool $error
     *            facoltativo se presente un errore
     */
    function showModifyInfo(bool $error = null)
    {
        if(!$error)
            $error = false;
            
        $userInfo = new EUserInfo();
        
        //TODO
    }
}

?>