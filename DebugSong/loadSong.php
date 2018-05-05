<?php

require 'inc.php';

$p=FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

//carico il primo elemento
$s = $p->load('Song', 1);

echo($s);

$p->closeDBConnection();			 //end PDO connection instance

?>
