<?php
require_once 'inc.php';

if(file_exists('config.inc.php'))
{
    $controller = new FrontController();
    $controller->run();
}
else 
    if(Installation::makeInstallation()){
    
        SampleUsers::generateUserPool(5, 5, 3);
        
        //header('Location: /deepmusic/index'); // redirect verso l'applicazione
    }

?>