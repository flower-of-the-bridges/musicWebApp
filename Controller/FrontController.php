<?php

class FrontController
{
    function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $resources = explode("/", $_SERVER['REQUEST_URI']);
        
        $controller = 'C' . ucfirst($resources[2]);
        if (class_exists($controller))
        {
            $method = $resources[3];
            if (method_exists($controller, $method))
            {
                $param = NULL;
                if(isset($resources[4]))
                    $param = $resources[4];
                    if($param)
                        $controller::$method($param);
                    else
                        $controller::$method();
            }
            else
            {
                $user = CSession::getUserFromSession();
                $smarty = SmartyConfig::configure();
                $smarty->registerObject('user', $user);
                $smarty->assign('uType', lcfirst(substr(get_class($user),1)));
                $smarty->display('index.tpl');
            }
        }
        else
        {
            $user = CSession::getUserFromSession();
            $smarty = SmartyConfig::configure();
            $smarty->registerObject('user', $user);
            $smarty->assign('uType', lcfirst(substr(get_class($user),1)));
            $smarty->display('index.tpl');
        }
        
        exit;
    }
}

