<?php

require_once 'inc.php';

$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];
//$params = $_SERVER['REQUEST_URI'];
//MainController::MainPage();

switch($resource)
{
    case($resource=='/DeepMusic/login'):
        if($method=='GET') // se get
            CUser::Login(); // fornisce la pagina di login
        if($method=='POST') //se post
            CUser::Authentication(); // fornisce l'autenticazione
        break;
    case($resource=='/DeepMusic/logout'):
        if($method=='GET')
            CUser::Logout();
    default:
        $user = CUser::getUserFromSession();
        $smarty = SmartyConfig::configure();
        $smarty->registerObject('user', $user);
        $smarty->display('index.tpl');
        break;
}

?>