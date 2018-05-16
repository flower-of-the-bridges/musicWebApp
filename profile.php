<?php

require_once 'inc.php';
require_once 'config.inc.php';

$smarty = SmartyConfig::giovConf(); 

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
