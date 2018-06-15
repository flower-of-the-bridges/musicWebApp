<?php
require_once 'inc.php';


class CSupInfo
{
    
    static function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            CSupInfo::showManageSupport();
            else if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                    CSupInfo::editSupInfo();
            }
            else
                header('Location: HTTP/1.1 405 Invalid HTTP method detected');
    }
    
    
    
    private function showManageSupInfo()
    {
        $vSupInfo = new VSupInfo();
        $user = CSession::getUserFromSession();
        
        if(get_class($loggedUser)!=EMusician::class)
            $vSupInfo->showErrorPage($loggedUser, 'You don\'t have the permession!'); //...mostra errore
                else
                    $vSupInfo->showEditForm($user);
                         
    }
    
    
    private function editSupInfo()
   {
       $vSupInfo = new VSupInfo(); // crea la view
       
       $user = CSession::getUserFromSession(); // ottiene l'utente della sessione
       if (get_class($user) == EMusician::class) // verifica che l'utente sia un musicista
       {
           $supInfo = $vSupInfo->createSupInfo(); // la view restituisce una ESupInfo costruita a partire dalla form
           if ($vSupInfo->validateLoad($supInfo)) // se l'oggetto e' valido
           {   
               $user->setSupInfo();
           }
               
           else
               $vSupInfo->showManageSupport($user);
       }
       else
           $vSupInfo->showErrorPage($user, 'You must be a Musician!');
    
    
    }
    
    
    
}