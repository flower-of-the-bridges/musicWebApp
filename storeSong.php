<?php

require 'inc.php';

$p=FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

//prima insert
$s=new ESong("2112", "Rush","Rock");
$s->setFilePath('./prova.mp3');
$p->store($s);
echo($s);

//seconda insert
$s=new ESong("Tom Sawyer", "Rush","Rock");
$s->setForSupportersOnly();
$s->setFilePath('./prova.mp3');
$p->store($s);
echo($s);

//terza insert
$s=new ESong("YXZ", "Rush","Rock");
$s->setForSupportersOnly();
$s->setFilePath('./prova.mp3');
$p->store($s);
echo($s);

?>