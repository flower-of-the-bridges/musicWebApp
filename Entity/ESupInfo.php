<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

class ESupInfo extends EObject
{
    private $contribute;
    private $period;
    /**
     * @return mixed
     */
    
    function __construct()
    {
       
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
    function setContribute($contribute)
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

   
    
}