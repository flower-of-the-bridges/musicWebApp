<?php

session_start();
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
$loggedUser->setId(24);
$loggedUser->setType('listener');

$song = FPersistantManager::getInstance()->load('Song', $_GET['id']);
$mp3 = FPersistantManager::getInstance()->load('Mp3', $_GET['id']);
$profile = $song->getArtist();
$smarty->assign('song', $song);
$smarty->assign('mp3',$mp3);

$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);
$smarty->display('song.tpl');


?>
