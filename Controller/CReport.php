<?php

require_once 'inc.php';

class CReport {
    
    /**
     * Permette l'invio di un report
     * EUser $loggedUser
     *      l'utente che sta inviando il report
     * EReport $report
     *      l'oggetto report stesso
     * EObject $obj
     *      l'oggetto segnalato
     */
    private function registerReport ()
    {
        $loggedUser = CSession::getUserFromSession();
        $vRep = new VReport();
        $report = $vRep->createReport();
        $report->setIdSegnalatore($loggedUser->getId());
        
        FPersistantManager::getInstance()->store($report);
    }
    
    static function make()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $vReport = new VReport();
            $vReport->showReportForm();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CReport::registerReport();   
        }
        else 
            header('Location: Invalid HTTP method detected');
    }
    
}