<?php

session_start();
require_once 'inc.php';
require_once 'config.inc.php';

$smarty = SmartyConfig::configure();

$content = 'Song';
$smarty->assign('content', $content);

$loggedUser = new EUser();
$loggedUser->setName('Giov');
$loggedUser->setId(24);
$loggedUser->setType('listener');


$song = FPersistantManager::getInstance()->load('Song', $_GET['id']);
$mp3 = FPersistantManager::getInstance()->load('Mp3', $_GET['id']);
$profile = $song->getArtist();
$smarty->assign('song', $song);
$smarty->assign('mp3',$mp3);

$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);
$smarty->display('profile.tpl');


?>
