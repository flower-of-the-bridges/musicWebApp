<?php

require_once 'inc.php';
require_once 'config.inc.php';

$smarty = SmartyConfig::configure(); 

$content = 'Song List';

$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(22);
$loggedUser->setType('musician');

$profile = new EUser();
$profile->setType('musician');
$profile->setName('Rush');
$profile->setId(1);
//$profile->setGenre();
//var_dump($profile);
$songs = FPersistantManager::getInstance()->load('musicianSongs', $profile->getId());
//var_dump($songs);
$smarty->assign('content', $content);
$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);
$smarty->assign('songs', $songs);

$smarty->display('profile.tpl');


?>
