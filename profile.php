<?php

require_once 'inc.php';
require_once 'config.inc.php';

$smarty = SmartyConfig::configure(); 

$content = 'Song List';

$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(22);
$loggedUser->setType('musician');

$profile = new EMusician();
$profile->setName('Giov');
$profile->setId(22);

$smarty->assign('content', $content);
$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);
$smarty->assign('songs', $profile->getSongs());

$smarty->display('profile.tpl');


?>
