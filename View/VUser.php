<?php

require_once 'inc.php';

class VUser
{
    private $smarty;
    private $errors; // array che contiene gli errori rispetto alle caratteristiche di un euser
    function __construct()
    {
        $this->smarty = SmartyConfig::configure();
        // l'array è istanziato con indici i campi delle varie form, i cui valori sono di default a false (no errori) 
        $this->errors = array(
            'name' => false,
            'mail' => false,
            'pwd' => false
        );
    }
    
    /**
     * Verifica che un utente sia autenticato
     * @return array contenente gli errori
     */
    function validateLogin() : bool
    {
        VUser::validateInputs();
        if(!$this->errors['name'] && !$this->errors['pwd'])
            return true;
        else return false;
    }
    
    /**
     * Restituisce un array contenente gli errori delle form
     * @return array 
     */
    function getErrors() : array
    {
        return $this->errors;
    }
    /**
     * Mostra il profilo di un utente
     * @param EUser $profileUser il profilo di cui visualizzare il profilo
     * @param EUser $loggedUser l'utente che ha effettuato l'accesso alla sessione
     * @param string $content il contenuto da visualizzare nel profilo (Song, Follower, Following)
     * @param array $array l'array del contenuto da visualizzare
     */
    function showProfile(EUser &$profileUser, &$loggedUser, string $content, array $array=NULL)
    {  
        $this->smarty->assign('content', $content);
        $this->smarty->registerObject('user', $loggedUser);
        $this->smarty->registerObject('profile', $profileUser);
        if($array)
            $this->smarty->assign('songs', $array);
        
        $this->smarty->display('profile.tpl');
    }

    /**
     * Mostra la pagina di login
     * @param EUser $user 
     */
    function showLogin()
    {
        $user = new EUser();
        $user->setName('Visitor');
        $user->setType('guest');
        
        $this->smarty->registerObject('user', $user);
        $this->smarty->display('login.tpl');
    }
    
    /**
     * Controlla che gli input delle form, se arrivati dal client tramite POST, siano corretti.
     */
    private function validateInputs() 
    {
       
        if (isset($_POST['mail'])) // se la mail e' inserita...
            if (! filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) // controllo che sia valida
                $this->errors['mail'] = true;
        /*
        if(!preg_match('/^[a-zA-Z0-9_-]{8,32}$/', $_POST['pwd']))
            $this->errors['pwd'] = true;
            */
    }
}

