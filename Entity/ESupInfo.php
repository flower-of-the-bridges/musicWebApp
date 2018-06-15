<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

class ESupInfo extends EObject
{
    const CONT_BASE = "1 $";
    const CONT_MIDDLE = "5 $";
    const CONT_TOP = "10 $";
    const BASE_TIME = "7";
    const MIDDLE_TIME = "30";
    const TOP_TIME = "365";
    
    private $contribute;
    private $period;
    /**
     * @return mixed
     */
    
    function __construct()
    {
       $this->contribute = 1;
       $this->period = 7;
    }
    
    
    
    function getContribute() : string
    {
        return $this->contribute;
    }

    /**
     * @return mixed
     */
    function getPeriod() : int
    {
        return $this->period;
    }

    /**
     * @param mixed $contribute
    */
    function setContribute(int $contribute)
    {
        $this->contribute = $contribute ;
    
    }

    /**
     * @param mixed $renewal
     */
    function setPeriod(int $period)
    {
        $this->period = $period;
    }

    function validateContribute() : bool
    {
        if ($this->contribute != ESupInfo::CONT_BASE || $this->contribute != ESupInfo::CONT_MIDDLE || $this->contribute != ESupInfo::CONT_TOP) 
            return false;
            else
                return true;
    }
    
    
    function validatePeriod() : bool
    {
        if ($this->period != ESupInfo::BASE_TIME|| $this->period != ESupInfo::MIDDLE_TIME || $this->period != ESupInfo::TOP_TIME)
            return false;
            else
                return true;
    }
    
    
    
}