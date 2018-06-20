<?php
require_once 'inc.php';
include_once 'View/VObject.php';

class VSearch extends VObject
{
 
    function __construct()
    {
        parent::__construct();
    }
    
    function getSearchValue() : string 
    {
        $string = "";
        if($_GET['str'])
        { // se l'utente ha inviato tramite GET un valore di ricerca, si ricava la stringa
            $string = $_GET['str'];
        }
    }
    
    function showSimpleSearchResult(EUser $user, $objects, string $key, string $value)
    {
        //assegno a smarty le variabili php
        $smarty->assign('key', $key);
        $smarty->assign('value', $value);
        $smarty->registerObject('user', $user);
        $smarty->assign('objects', $objects);
        
        //mostro il contenuto della pagine
        $smarty->display('search.tpl');
    }
}

