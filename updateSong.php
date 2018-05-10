<?php

require 'inc.php';

$p=FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

//carico il primo elemento
$s = $p->load('Song', 3);

$s->setForAll();
$s->setName('La Villa Strangiato');

$p->update($s);

echo($p->load('Song', 3));

$p->closeDBConnection()//end PDO connection instance

?>
