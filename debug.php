<?php
require 'inc.php';
$p=FPersistantManager::getInstance();
$s=new ESong("2112", "Rush","Rock");
$p->store($s);
echo($s);

$s=new ESong("Tom Sawyer", "Rush","Rock");
$s->setForSupportersOnly();
$p->store($s);
echo($s);

$s=new ESong("YXZ", "Rush","Rock");
$s->setForSupportersOnly();
$p->store($s);
echo($s);

?>