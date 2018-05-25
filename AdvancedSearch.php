<?php
error_reporting(0); //no php notice 
require_once 'inc.php';

$smarty = SmartyConfig::configure();

//creazione utente statico
$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(22);
$loggedUser->setType('listener');


$smarty->registerObject('user', $loggedUser);
$smarty->assign('objects', $objects);

//mostro il contenuto della pagine
$smarty->display('advancedSearch.tpl');

?>
