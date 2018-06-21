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
            'description' => true,
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
        if(isset($_POST['description'])){
            $report->setDescription($_POST['description']);
        }
 
        return $report;
    }
    
    /**
     * Verifica la validit� del report
     *
     * @return true se non si sono commessi errori, false altrimenti
     */
    function validateReport (EReport &$rep) : bool
    {
        if(
            $this->check['title'] = $rep->validateTitle() &&
            $this->check['description'] = $rep->validateDescription()/* &&
            $this->check['idSegnalatore'] = $rep->validateIdSegnalatore() &&
            $this->check['idObject'] = $rep->validateObject() &&
            $this->check['objectType'] = $rep->validateObject()
            */)
            return  true;
        else 
            return false;
    }
    
    
    /**
     * Mostra i dettagli di un report.
     * Pagina riservata solo al moderatore che ha accettato il report.
     * 
     */
    function showReport (EReport $eReport, bool $error = null)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('report', $eReport);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        
        $this->smarty->assign('check', $this->check);
        $this->smarty->display('report.tpl');
        
        
        
    }
    
    function showReportTable($reportTable, bool $error = null)
    {
        if(!$error){ $error = false; }
        
        
    }
    
    /**
     * Mostra la form di creazione del report
     * visibile all'utente che vuole inviare una segnalazione
     */
    function showReportForm (EUser &$user, int $id, string $type) 
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('type', $type);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
 
        $this->smarty->assign('check', $this->check);
        
        $this->smarty->display('makeReport.tpl');
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>