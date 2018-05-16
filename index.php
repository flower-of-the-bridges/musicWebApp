<?php

// put full path to Smarty.class.php
require('/opt/lampp/php/Smarty/Smarty.class.php');
require_once('inc.php');
$smarty = new Smarty();

$smarty->setTemplateDir('/opt/lampp/htdocs/DeepMusic/smarty/templates');
$smarty->setCompileDir('/opt/lampp/htdocs/DeepMusic/smarty/templates_c');
$smarty->setCacheDir('/opt/lampp/htdocs/DeepMusic/smarty/cache');
$smarty->setConfigDir('/opt/lampp/htdocs/DeepMusic/smarty/configs');

$user = new EUser();
$user->setType('listener');

$smarty->registerObject('user', $user);
$smarty->display('index.tpl');

?>
