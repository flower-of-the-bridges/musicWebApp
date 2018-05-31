<?php
require_once 'inc.php';

class VUser
{

    private $smarty;

    private $errors;
 // array che contiene gli errori rispetto alle caratteristiche di un euser
    function __construct()
    {
        $this->smarty = SmartyConfig::configure();
        // l'array è istanziato con indici i campi delle varie form, i cui valori sono di default a false (no errori)
        $this->errors = array(
            'name' => false,
            'mail' => false,
            'pwd' => false,
            'type' => false
        );
    }

    /**
     * Verifica che un utente sia autenticato
     *
     * @return array contenente gli errori
     */
    function validateLogin(): bool
    {
        VUser::validateInputs();
        if (! $this->errors['name'] && ! $this->errors['pwd'])
            return true;
        else
            return false;
    }

    /**
     * Verifica che un utente sia autenticato
     *
     * @return array contenente gli errori
     */
    function validateSignUp(): bool
    {
        if (isset($_POST['name']) && isset($_POST['pwd']) && isset($_POST['mail']) && isset($_POST['type'])) {
            // se i campi della form sono arrivati correttamente, vengono convalidati
            VUser::validateInputs();
            
            if (! $this->errors['name'] && ! $this->errors['pwd'] && ! $this->errors['mail'])
                return true;
            else
                return false;
        } else
            return false;
    }

    /**
     * Restituisce un array contenente gli errori delle form
     *
     * @return array
     */
    function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Mostra il profilo di un utente
     *
     * @param EUser $profileUser
     *            il profilo di cui visualizzare il profilo
     * @param EUser $loggedUser
     *            l'utente che ha effettuato l'accesso alla sessione
     * @param string $content
     *            il contenuto da visualizzare nel profilo (Song, Follower, Following)
     * @param array $array
     *            l'array del contenuto da visualizzare
     */
    function showProfile(EUser &$profileUser, &$loggedUser, string $content, array $array = NULL)
    {
        $this->smarty->assign('content', $content);
        $this->smarty->registerObject('user', $loggedUser);
        $this->smarty->registerObject('profile', $profileUser);
        
        if ($array)
            $this->smarty->assign('songs', $array);
        
        $this->smarty->display('profile.tpl');
    }

    /**
     * Mostra la pagina di login
     *
     * @param bool $error
     *            facoltativo se è stato rilevato un errore
     */
    function showLogin(bool $error = NULL)
    {
        if (! $error)
            $error = false;
        
        $user = new EUser();
        $user->setName('Visitor');
        $user->setType('guest');
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

    /**
     * Mostra la pagina di signup
     *
     * @param bool $error
     *            facoltativo se è stato rilevato un errore
     */
    function showSignUp(bool $error = NULL)
    {
        if (! $error)
            $error = false;
        
        $user = new EUser();
        $user->setName('Visitor');
        $user->setType('guest');
        
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('error', $error);
        $this->smarty->display('register.tpl');
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
         * if (isset($_POST['pwd']))
         * if (! preg_match('/^\w{8}$/', $_POST['pwd']))
         * $this->errors['pwd'] = true;
         */
        if (isset($_POST['name']))
            if (! preg_match('/^[[:alpha:]]{3,20}$/', $_POST['name']))
                $this->errors['name'] = true;
        
        if (isset($_POST['type']))
            if ($_POST['type'] != 'listener' && $_POST['type'] != 'musician')
                $this->errors['type'] = true;
    }
}

