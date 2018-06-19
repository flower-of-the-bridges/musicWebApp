<?php

/**
 * La classe FrontController effettua il dispatching verso i metodi dei vari controller 
 * a seconda dell'url richiesta dal client. 
 * @author gruppo2
 * @package Controller
 */
class FrontController
{
    /**
     * La funzione run effettua il dispatching verso i metodi di un determinato controller.
     * Un URL ha il seguente formato: 
     *                  /deepmusic/controller/method/(params)
     * Se l'URL non e' valida, l'utente viene reindirizzato alla pagina principale
     */
    function run()
    {
        $resources = explode("/", $_SERVER['REQUEST_URI']); // individua le componenti dell'url
        
        $controller = 'C' . ucfirst($resources[2]); // costruisce il nome della classe del Controller 
        if (class_exists($controller)) // se la classe esiste
        { // verifica che il metodo sia valido
            $method = $resources[3];
            if (method_exists($controller, $method)) // se il metodo e' valido...
            { // verifica la presenza di eventuali parametri
                $param = NULL;
                if(isset($resources[4]))
                    $param = $resources[4];
                    if($param) // se i parametri sono definiti
                        $controller::$method($param); // li passa al controller
                    else
                        $controller::$method();
            }
            else // se il metodo non esiste, si viene reindirizzati alla pagina principale
            {
                $user = CSession::getUserFromSession();
                $smarty = SmartyConfig::configure();
                $smarty->registerObject('user', $user);
                $smarty->assign('uType', lcfirst(substr(get_class($user),1)));
                $smarty->display('index.tpl');
            }
        }
        else // se la classe non esiste, si viene reindirizzati alla pagina principale
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

