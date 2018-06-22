<?php

require_once 'inc.php';

/**
 * La classe CReport implementa la funzionalita' 'Segnala Contenuto': offre metodi grazie ai quali
 * e' possibile segnalare un oggetto o una canzone. Permette inoltre, agli utenti di tipo moderatore,
 * la visualizzazione di un report.
 * @author gruppo2
 * @package Controller
 *
 */
class CReport {
      
    /**
     * Mostra le informazioni di un report.
     * @param $idReport
     */
    static function show($idReport=null)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            CReport::showReport($idReport);
        }
        else
            header('Location: HTTP/1.1 405 Invalid URL detected');
    }
    /**
     * Metodo che fa la distinzione tra i due metodi di richiesta GET e POST
     * invocando la vista incaricata a mostrare l'appropriata interfaccia utente
     */
    static function make($id = null, $type = null)
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            CReport::showMakeReportForm($id, $type);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            CReport::registerReport($id, $type);
        }
        else
            header('Location: Invalid HTTP method detected');
    }
    
    /**
     * Mostra la pagina delle info di un report. Reindirizza ad un messaggio di errore
     * se l'utente che accede alla risorsa non e' un moderatore.
     * @param int $id l'identificativo del report.
     */
    private function showReport($idReport = null)
    {
        
        $vReport = new VReport();
        $loggedUser = CSession::getUserFromSession();
        
        if(get_class($loggedUser)==EModerator::class) // se l'utente e' moderatore
        {
            if(is_numeric($idReport)) // se l'id report e' specificato
            { // si carica il report
                $eReport = FPersistantManager::getInstance()->load(EReport::class, $idReport); // carica il report
                
                if($eReport) // se il report esiste
                { // si verifica che il moderatore puo' vederlo (il report non deve essere assegnato oppure deve essere assegnato a lui)
                    if($loggedUser->isReportAcceptable($eReport))
                        $vReport->showReport($loggedUser, $eReport);
                    else
                        $vReport->showErrorPage($loggedUser, "This report is not one of yours");
                }
                else
                    $vReport->showErrorPage($loggedUser, "You are trying to see something that not exist!");
            }
            else
                $vReport->showErrorPage($loggedUser, 'The id is not specified!');
        }
        else
            $vReport->showErrorPage($loggedUser, 'You must be a moderator to see reports!');
            
            
    }
    
    /**
     * Permette l'invio di un report
     * EUser $loggedUser
     *      l'utente che sta inviando il report invia
     * EReport $report
     *      l'oggetto report stesso contenente
     * EObject $obj
     *      l'oggetto segnalato
     */
    private function registerReport ($id = null, $type = null)
    {
        $loggedUser = CSession::getUserFromSession();
        $vReport = new VReport();
        $report = $vReport->createReport();
        if(get_class($loggedUser)!=EGuest::class || get_class($loggedUser)!=EModerator::class)
        {
            if(CReport::makeReportedObject($id, $type, $vReport, $loggedUser))
            {
                $report->setIdSegnalatore($loggedUser->getId());
                $report->setIdObject($id);
                $report->setObjectType($type);
                if ($vReport->validateReport($report))
                {
                    FPersistantManager::getInstance()->store($report);
                    header('Location: /deepmusic/index');
                }
                else 
                    $vReport->showReportForm($loggedUser, $id, $type);
            }
            
        }
        else
            $vReport->showErrorPage($user, 'You must be logged to report application contents. Maybe you\'re a moderator!');
            
        
    }
    
    /**
     * Mostra la form per la creazione di un report
     * @param int $id identificativo della risorsa da segnalare
     * @param string $type tipologia della risorsa da segnalare ('user' o 'song')
     */
    private function showMakeReportForm($id = null, $type = null)
    {
        $vReport = new VReport(); // costruisce la view
        $user = CSession::getUserFromSession(); // riottiene l'utente dalla sessione
        if (get_class($user) != EGuest::class && get_class($user)!= EModerator::class)  // verifica che l'utente non sia guest o moderatore
        {
            if(CReport::makeReportedObject($id, $type, $vReport, $user))
                $vReport->showReportForm($user, $id, $type);
        }
        else
            $vReport->showErrorPage($user, 'You must be logged to report application contents. Maybe you\'re a moderator!');
    }
    
    /**
     * Costruisce un oggetto EReport partire dai valori id e type.
     * @param int $id identificativo della risorsa da segnalare
     * @param string $type tipologia della risorsa da segnalare ('user' o 'song')
     * @param VReport $vReport la view occupata di visualizzare messaggi di errori
     * @param EUser $user l'utente della sessione attiva
     * @return boolean true se l'oggetto esiste, false altrimenti
     */
    private function makeReportedObject($id = null, $type = null, VReport &$vReport, EUser &$user)
    {
        if ($type) // verifica che il tipo sia specificato
        {
            $className = 'E' . ucfirst($type); // costruisce la classe Entity associata al tipo di risorsa
            
            if ($className == EUser::class || $className == ESong::class) // vede se si ha un EUser o un EMusician
            {
                if (is_numeric($id)) // controlla che sia specificato l'id
                {
                    $obj = FPersistantManager::getInstance()->load($className, $id); // carica l'oggetto dal db
                    if ($obj) // se esiste mostra la form
                        return true;
                    else 
                    {
                        $vReport->showErrorPage($user, 'The id doesn\'t match any ' . $type . '!');
                        return false;
                    }
                }
                else
                {
                    $vReport->showErrorPage($user, 'The id is not specified!');
                    return false;
                }
            }
            else
            {
                $vReport->showErrorPage($user, 'The resource type doesn\'t support the report function');
                return false;
            }
        }
        else
        {
            $vReport->showErrorPage($user, 'The resource type is not specified!');
            return false;
        }
    }
     
}