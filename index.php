<?php


require_once('inc.php');
$smarty = SmartyConfig::configure();

$user = new EUser();
$user->setName('Giov');
$user->setType('listener');

$smarty->registerObject('user', $user);
$smarty->display('index.tpl');

?>
