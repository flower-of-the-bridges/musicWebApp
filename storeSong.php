<?php

require 'inc.php';

$p = FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

$mus = new EMusician(1, "Rush", null, null, "Rock");

//prima insert
$s = new ESong(null, "2112", $mus,"Rock");
$s->setFilePath('./prova.mp3');
if ($p->store($s)) { echo($s); }

//seconda insert
$s=new ESong(null, "Tom Sawyer", $mus,"Rock");
$s->setForSupportersOnly();
$s->setFilePath('./prova.mp3');
if ($p->store($s)) { echo($s); }

//terza insert
$s=new ESong(null, "YXZ", $mus,"Rock");
$s->setForSupportersOnly();
$s->setFilePath('./prova.mp3');
if ($p->store($s)) { echo($s); }

$p->closeDBConnection();			 //end PDO connection instance

?>
