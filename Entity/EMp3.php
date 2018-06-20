<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

class EMp3 extends EObject
{
    
    //size of the uploaded song
    private $size;
    //mime type of the blob
    private $type;
    //the blob itself
    private $mp3;
    
    /////////////////////////////////////////////specifics methods
    
    function storeToDBMp3() : bool {/*someting that put mp3 in db on foundation*/ return $succes;}
    
    function loadFromDBMp3() : bool {/*someting that put mp3 from db on foundation*/}
    

    /**
     * 
     */
    function __construct () {/*Use functions*/}

/****************************************** GETTER **************************************************/
    
    /**
     *
     * @return mixed
     */
    function getMp3 ()
    {
        return $this->mp3;
    }
    
    /**
     *
     * @return int
     */
    function getSize () : int
    {
        return $this->size;
    }
    
    /**
     *
     * @return string
     */
    function getType () : string
    {
        return $this->type;
    }
    
/********************************************** SETTER *************************************************/  

    /**
     * Imposta la dimensione dell'Mp3
     * @param int $size la dimensione dell'mp3
     */
    function setSize (int $size)
    {
        $this->size = $size;
    }
    
    /**
     * Imposta il Mime Type dell'Mp3
     * @param string $type il mime typ dell'mp3 (audio/mpeg)
     */
    function setType (string $type)
    {
        $this->type = $type;
    }
    
    /**
     * Imposta il contenuto del file
     * @param mixed $mp3 il contenuto del file
     */
    function setMp3 ($mp3)
    {
        $this->mp3 = $mp3;
    }
    
/*************************************** VALIDATION *******************************************/
    
    /**
     * verifica che la dimensione del file sia superiore ad 1Mb
     * @return bool true se la dimensione e' corretta, false altrimenti
     */
    function validateSize() : bool
    {
        if($this->size>=10000)
            return true;
        else
            return false;
    }
    
    /**
     * Verifica che il mime type sia effettivamente riferito ad un mp3. Possibili mime-type sono:
     * - audio/mpeg
     * - audio/mp3
     * @return bool true se il mime type e' corretto, false altrimenti
     */
    function validateType() : bool
    {
        if($this->type!='audio/mpeg' && $this->type!='audio/mp3')
            return false;
        else 
            return true;
    }
}
