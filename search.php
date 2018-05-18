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

$key = 'Song'; //chiave di ricerca
$value = 'Genre'; //valore da ricercare

if($_GET['value']){ // se l'utente ha inviato tramite GET un valore, si cerca nel DB
    $objects = FPersistantManager::getInstance()->search($key, $value, $_GET['value']);
    $smarty->assign('string', $_GET['value']);
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
