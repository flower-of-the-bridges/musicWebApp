<?php

require 'inc.php';

$p=FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

$p->truncate('Song'); //cancello tutte le entry nella table

?>