<?php

require_once 'inc.php';


/**
 * La classe CManageReport implementa i metodi responsabili dell'updating 
 * dei report, riservata ai soli utenti di classe moderatore
 * 
 * @author gruppo2
 * @package Controller
 */
class CManageReport
{
    
    static function show($idMod=null,$idReport=null)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            if($idMod!=null && $idReport == null)
            {
                
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
            ;
    }
        
    static function update($idReport=null,$action=null)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($idReport != null && $action != null)
            {
                $action=$action.'Report';
                CManageReport::$action($idMod,$idReport);
            }
        }
        else
            header('Location: HTTP/1.1 405 Invalid URL detected');
    }
        
    private function showReport(bool $error = false)
    {
        if(!$error){$error=false;}
        
        
    }
    
    
    /**
     * metodo statico che controlla se l'utente dispone dei diritti da moderatore
     * 
     * @return bool
     *      se l'utente è un moderatore verra restituito il valore true
     */
    static function checkModSession() : bool
    {
        $vReport = new VReport();
        
        $loggedUser = CSession::getUserFromSession();
        
        if(get_class($loggedUser) != EModerator::class)
        {
            $vReport->showErrorPage($loggedUser, "you are not supposed to be here, how did you went this far from home?");
            return false;
        }else
            return true;
    }
    
    /**
     * metodo che permette all'utente moderatore di accettare una segnalazione
     * 
     * @param $idReport int
     *      ossia il report che va aggiornato
     */
    private function acceptReport($idReport)
    {
        $vReport = new VReport();
        $eReport = FPersistantManager::getInstance()->load(EReport::class, $idReport);
        
        $loggedUser = CSession::getUserFromSession();
        
        if (CManageReport::checkModSession())
        {
            if($eReport != null)
            {
                if($eReport->getIdModeratore() == "")
                {
                    $eReport->setIdModeratore($loggedUser->getId());
                    FPersistantManager::getInstance()->update($eReport);
                }else 
                    $vReport->showErrorPage($loggedUser, "this report is already under the attenction of a moderator");
            }else
                $vReport->showErrorPage($loggedUser, "you are trying to accept something that does not exist");
        }
    }
    
    /**
     * metodo che permette all'utente moderatore di rinunciare ad una segnalazione
     * precedentemente accettata
     *
     * @param $idReport int
     *      ossia il report che va aggiornato
     */
    private function declineReport($idReport)
    {
        $vReport = new VReport();
        $eReport = FPersistantManager::getInstance()->load(EReport::class, $idReport);
        
        $loggedUser = CSession::getUserFromSession();
        
        if (CManageReport::checkModSession())
        {
            if($eReport != null)
            {
                if($eReport->getIdModeratore() == $loggedUser->getId())
                {
                    $eReport->setIdModeratore("");
                    FPersistantManager::getInstance()->update($eReport);
                }else
                    $vReport->showErrorPage($loggedUser, "this report is not under your attenction");
            }else
                $vReport->showErrorPage($loggedUser, "you are trying to decline something that does not exist");
        }
    }
    
    /**
     * metodo che permette all'utente moderatore di completare e quindi rimuovere una segnalazione
     *
     * @param $idReport int
     *      ossia il report che va aggiornato
     */
    private function completeReport($idReport)
    {
        $vReport = new VReport();
        $eReport = FPersistantManager::getInstance()->load(EReport::class, $idReport);
        
        $loggedUser = CSession::getUserFromSession();
        
        if (CManageReport::checkModSession())
        {
            if($eReport != null)
            {
                if($eReport->getIdModeratore() == $loggedUser->getId())
                {
                    FPersistantManager::getInstance()->remove(EReport::class, $eReport->getId());
                }else
                    $vReport->showErrorPage($loggedUser, "this report is not under your attenction");
            }else
                $vReport->showErrorPage($loggedUser, "you are trying to complete something that does not exist");
        }
    }
    
    
}
