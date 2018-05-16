<?php

require_once 'inc.php';
require_once 'config.inc.php';

require('/opt/lampp/php/Smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('/opt/lampp/htdocs/DeepMusic/smarty/templates');
$smarty->setCompileDir('/opt/lampp/htdocs/DeepMusic/smarty/templates_c');
$smarty->setCacheDir('/opt/lampp/htdocs/DeepMusic/smarty/cache');
$smarty->setConfigDir('/opt/lampp/htdocs/DeepMusic/smarty/configs');


$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(22);
$loggedUser->setType('listener');

$profile = new EMusician();
$profile->setName('Rush');
$profile->setId(22);


$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);
$smarty->assign('songs', $profile->getSongs());


$smarty->display('profile.tpl');


?>
