<?php

include_once 'Entity/EUser.php';

/**
 * La classe EModerator estende la classe EUser e implementa la tipologia di utenti Moderator.
 * @author gruppo2
 * @package Entity
 *
 */
class EModerator extends EUser
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Restituisce i report assegnati al moderatore
     * @return array se il moderatore ha report assegnati | NULL altrimenti
     */
    function getAssignedReports()
    {
        $reports = FPersistantManager::getInstance()->load(EReport::class, $this->id, FTarget::LOAD_MOD_REPORTS);
        return $reports;
    }
    
    /**
     * Restituisce i report che non hanno un moderatore assegnato
     * @return array se ci sono report assegnati | NULL altrimenti
     */
    function getUnassignedReports()
    {
        $reports = FPersistantManager::getInstance()->load(EReport::class, 0, FTarget::LOAD_MOD_REPORTS);
        return $reports;
    }
    
    /**
     * Verifica che un report sia disponibile per essere preso in carico
     * @param EReport $report il report da analizzare
     * @return bool true se il moderatore puo' accettare il report, false altrimenti
     */
    function isReportAcceptable(EReport &$report) : bool
    {
        if(!$report->isAccepted() || $report->getIdModeratore() == $this->getId())
            return true;
        else
            return false;
    }
    
    /**
     * Metodo con cui il moderatore prende in carico un report
     * @param EReport $report il report da prendere in carico
     */
    function acceptReport(EReport &$report)
    {
        $report->setIdModeratore($this->getId());
        FPersistantManager::getInstance()->update($report);
    }
    
    /**
     * Metodo con cui il moderatore declina un report, se effettivamente e' di sua competenza
     * @param EReport $report il report da non avere piu in carico
     */
    function declineReport(EReport &$report) : bool
    {
        if($report->getIdModeratore() == $this->getId())
        {
            $report->setIdModeratore(0);
            return FPersistantManager::getInstance()->update($report);
        }
        else
            return false;
    }
    
    /**
     * Metodo con cui il moderatore completa un report, se effettivamente e' di sua competenza
     * @param EReport $report il report da completare
     */
    function completeReport(EReport &$report) : bool
    {
        if($report->getIdModeratore() == $this->getId())
        {
            return FPersistantManager::getInstance()->remove(EReport::class, $report->getId());
        }
        else
            return false;
    }
}

