<?php
require 'inc.php';
$p=FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms
$p->truncate('Song'); //cancello tutte le entry nella table
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
//carico il primo elemento
$s=$p->load('Song', 1);
echo($s);

?>