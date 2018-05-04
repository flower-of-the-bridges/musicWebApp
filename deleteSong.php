<?php
require_once 'in.php';

$p = FPersistantManager::getInstance();

if($p->remove("Song", 1))
    echo "canzone rimossa";
else
    echo "canzone NON trovata";

    $p->closeDBConnection();
?>