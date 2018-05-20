<?php
error_reporting(0); //no php notice 
require_once 'inc.php';

$smarty = SmartyConfig::configure();

//creazione utente statico
$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(22);
$loggedUser->setType('listener');

$objects; //oggetti recuperati dal db

$key = 'Song'; //chiave di ricerca default
$value = 'Genre'; //valore da ricercare default

if($_GET['value'] && $_GET['key']) // se e' stata effettuata una ricerca avanzata
{
    // si assegnano i valori ricevuti dal client alle opzioni di ricerca
    
    if($_GET['value'] == 'name' || $_GET['value'] == 'genre')
        $value = ucfirst($_GET['value']);
    if($_GET['key'] == 'song' || $_GET['key'] == 'musician')
        $key = ucfirst($_GET['key']);
}

if($_GET['str'])
{ // se l'utente ha inviato tramite GET un valore, si cerca nel DB
    $objects = FPersistantManager::getInstance()->search($key, $value, $_GET['str']);
    $smarty->assign('string', $_GET['str']);
}
else 
    $smarty->assign('string', ""); 

//assegno a smarty le variabili php
$smarty->assign('key', $key);
$smarty->assign('value', $value);
$smarty->registerObject('user', $loggedUser);
$smarty->assign('objects', $objects);

//mostro il contenuto della pagine
$smarty->display('search.tpl');

?>
