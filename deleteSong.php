<?php
require_once 'inc.php';

if(FPersistantManager::getInstance()->remove('Song', 1))
    echo "canzone rimossa";
else
    echo "canzone NON trovata";

?>