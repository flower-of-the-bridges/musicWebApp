<?php

require_once 'inc.php';
require_once 'config.inc.php';

$loggedUser = new EUser();
$loggedUser->setName('Rush');
$loggedUser->setId(22);
$loggedUser->setType('musician');

$profile = new EMusician();
$profile->setName('Rush');
$profile->setId(22);
$profile->setGenre();

$supinfo= new ESupInfo();
$supinfo->setPeriod($_POST['period']);
$supinfo->setContribute($_POST['contribute']);
$supinfo->setId(22);

$profile->setSupInfo($supinfo);

?>
