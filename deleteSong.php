<?php
require_once 'inc.php';

$p = FPersistantManager::getInstance();

if($p->remove("Song", 1))
    echo "canzone rimossa";
else
    echo "canzone NON trovata";

    $p->closeDBConnection();
?>