<?php

require_once 'inc.php';
require_once 'config.inc.php';

$smarty = SmartyConfig::configure();

$content = 'ManageSupport';

$loggedUser = new EUser();
$loggedUser->setName('Rush');
$loggedUser->setId(22);
$loggedUser->setType('musician');

$profile = new EMusician();
$profile->setName('Rush');
$profile->setId(22);
$profile->setGenre();

$sup = $profile->getSupInfo();
$cont = $sup->getContribute();
$per = $sup->getPeriod();


$smarty->assign('content', $content);
$smarty->assign('cont', $cont);
$smarty->assign('per', $per);
$smarty->registerObject('user', $loggedUser);
$smarty->registerObject('profile', $profile);


$smarty->display('profile.tpl');


?>