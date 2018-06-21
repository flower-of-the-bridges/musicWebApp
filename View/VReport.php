<?php
require_once 'inc.php';
include_once 'View/VObject.php';

class VReport extends VObject
{
  
    function __construct()
    {
        parent::__construct();
        
        $this->check = array(
            'title' =>true,
            'decription' => true,
            'idSegnalatore' => true,
            'idObject' => true,
            'objectType' => true
        );
    }
    
    /**
     * Funzione che permette la creazione di un oggetto report
     * con i valori prelevati da una form
     * @return EReport il report ottenuto dai campi della form
     */
    function createReport() : EReport
    {
        $report = new EReport();
        if(isset($_POST['title'])){
            $report->setTitle($_POST['title']);
        }
        if(isset($_POST['decription'])){
            $report->setDescription($_POST['decription']);
        }
        if(isset($_POST['idSegnalatore'])){
            $report->setIdSegnalatore($_POST['idSegnalatore']);
        }
        if(isset($_POST['idObject'])){
            $report->setIdObject($_POST['idObject']);
        }
        if(isset($_POST['objectType'])){
            $report->setObjectType($_POST['objectType']);
        }
        
        return $report;
    }
    
    /**
     * Verifica la validità del report
     *
     * @return true se non si sono commessi errori, false altrimenti
     */
    function validateReport (EReport &$rep) : bool
    {
        if(
            $this->check['title'] = $rep->validateTitle() &&
            $this->check['description'] = $rep->validateDescription() &&
            $this->check['idSegnalatore'] = $rep->validateIdSegnalatore() &&
            $this->check['idObject'] = $rep->validateObject() &&
            $this->check['objectType'] = $rep->validateObject()
            )
            return  true;
        else 
            return false;
    }
    
    
    /**
     * mostra i dettagli di un report
     * pagina riservata solo al moderatore che ha accettato il report
     * 
     */
    function showReport (EReport $eReport, bool $error = null)
    {
        if(!$error){ $error = false; }
        
        
        
    }
    
    function showReportTable($reportTable, bool $error = null)
    {
        if(!$error){ $error = false; }
        
        
    }
    
    /**
     * mostra la form di creazione del report
     * visibile all'utente che vuole inviare una segnalazione
     */
    function showReportForm (bool $error = null) 
    {
        if(!$error)
        {   $error = false; }
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>