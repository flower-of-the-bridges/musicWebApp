<?php
require_once 'inc.php';

if(file_exists('config.inc.php'))
{
    $controller = new FrontController();
    $controller->run();
}
else 
    Installation::makeInstallation();


?>