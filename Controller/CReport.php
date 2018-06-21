<?php

require_once 'inc.php';

class CReport {
    
    /**
     * Permette l'invio di un report
     * EUser $loggedUser
     *      l'utente che sta inviando il report invia
     * EReport $report
     *      l'oggetto report stesso contenente
     * EObject $obj
     *      l'oggetto segnalato
     */
    private function registerReport ()
    {
        $loggedUser = CSession::getUserFromSession();
        $vRep = new VReport();
        $report = $vRep->createReport();
        $report->setIdSegnalatore($loggedUser->getId());
        $report->setIdModeratore("");
        
        FPersistantManager::getInstance()->store($report);
    }
    
	/**
	 * Metodo che fa la distinzione tra i due metodi di richiesta GET e POST
	 * invocando la vista incaricata a mostrare l'appropriata interfaccia utente
	 */
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