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
            if($idMod!=null && $idReport != null)
            {
                CManageReport::showReport($idMod,$idReport);
            }else if($idReport == null)
            {
                CManageReport::showReportTable($idMod);   
            }
        }
        else 
            header('Location: HTTP/1.1 405 Invalid URL detected');
    }
    
    /**
     * metodo che permette all'utente moderatore di accettare una segnalazione
     *
     * @param $idReport int
     *      ossia il report che va aggiornato
     */
    static function accept($idReport)
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
    static function decline($idReport)
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
    static function complete($idReport)
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
    
        
    
    /**
     * Mostra la pagina delle info base di tutti i report accettati dal moderatore loggato o quelli non accettati. 
     * Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un moderatore o se sta cercando di visualizzare qualcosa che non dovrebbe.
     * @param int $idMod l'identificativo del moderatore.
     */
    private function showReportTable($idMod, bool $error = false)
    {
        if(!$error){$error=false;}
        
        $vReport = new VReport();
        $loggedUser = CSession::getUserFromSession();
        
        if(CManageReport::checkModSession())
        {
            if($idMod=="" || $idMod == $loggedUser->getId())
            {
                $reportTable = FPersistantManager::getInstance()->load(EReport::class, $idMod, FTarget::LOAD_MOD_REPORT);
                $vReport->showReportTable($reportTable);
            }else 
                $vReport->showErrorPage($loggedUser, "you are trying to visualize something that is none of your business");
        }
    }
    
    
    /**
     * Mostra la pagina delle info di un report. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un moderatore.
     * @param int $id l'identificativo del report.
     */
    private function showReport($idMod, $idReport, bool $error = false)
    {
        if(!$error){$error=false;}
        
        $vReport = new VReport();
        $loggedUser = CSession::getUserFromSession();
        $eReport = FPersistantManager::getInstance()->load(EReport::class, $idReport);
        
        if(CManageReport::checkModSession())
        {
            if($loggedUser->getId() == $idMod)
            {
                if($eReport!=null)
                {
                    $vReport->showReport($eReport);    
                }else 
                    $vReport->showErrorPage($loggedUser, "you are trying to see something that not exist!");
            }else 
                $vReport->showErrorPage($loggedUser, "this report is not one of yours");
        }
    }
    
    
    /**
     * Metodo che controlla se l'utente dispone dei diritti da moderatore
     * 
     * @return bool
     *      se l'utente e' un moderatore verra restituito il valore true
     */
    private function checkModSession() : bool
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
    
    
    
}
