<?php
require 'inc.php';
$p=FPersistantManager::getInstance();
$s=new ESong("2112", "Rush","Rock");
$s->setForSupportersOnly();
echo($s);
$p->store($s);
?>