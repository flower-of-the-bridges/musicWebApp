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
     * 
     * @param int $size
     */
    function setSize (int $size)
    {
        $this->size = $size;
    }
    
    /**
     * 
     * @param string $type
     */
    function setType (string $type)
    {
        $this->type = $type;
    }
    
    /**
     * 
     * @param mixed $mp3
     */
    function setMp3 (&$mp3)
    {
        $this->mp3 = $mp3;
    }
}
