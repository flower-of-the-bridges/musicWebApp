<?php

class VObject
{

    protected $smarty; /*** l'oggetto smarty incaricato di visualizzare i template */

    protected $check; /*** un array avente come indice i campi delle form di cui controllare gli errori. Ogni classe lo definira' secondo le sue esigenze */

    protected function __construct()
    {
        $this->smarty = SmartyConfig::configure();
        // l'array è istanziato con indici i campi delle varie form, i cui valori sono di default a false (no errori)
    }
    
    /**
     * Mostra una pagina di errore, funzione da richiamare se un utente sta visualizzando una pagina
     * che non risulta essere di sua competenza
     * @param EUser $user l'utente della sessione 
     * @param string $error il messaggio di errore da visualizzare
     */
    function showErrorPage(EUser &$user, string $error)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        $this->smarty->assign('error', $error);
        $this->smarty->display('errorPage.tpl');
    }
}

