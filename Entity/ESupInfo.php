<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

class ESupInfo extends EObject
{
    const CONT_BASE = "1 $";
    const CONT_MIDDLE = "5 $";
    const CONT_TOP = "10 $";
    const TIME_BASE = "7";
    const TIME_MIDDLE = "30";
    const TIME_TOP = "365";
    
    private $contribute;
    private $period;
    /**
     * @return mixed
     */
    
    function __construct()
    {
       $this->contribute = ESupInfo::CONT_BASE;
       $this->period = ESupInfo::TIME_BASE;
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
    function setContribute(string $contribute)
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
        if ($this->contribute != ESupInfo::CONT_BASE && $this->contribute != ESupInfo::CONT_MIDDLE && $this->contribute != ESupInfo::CONT_TOP) 
            return false;
        else
            return true;
    }
    
    
    function validatePeriod() : bool
    {
        if ($this->period != ESupInfo::TIME_BASE && $this->period != ESupInfo::TIME_MIDDLE && $this->period != ESupInfo::TIME_TOP)
            return false;
        else
            return true;
    }
    
    
    
}