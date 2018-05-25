<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

class EImg extends EObject
{
    
    //size of the uploaded image
    private $size;
    //mime type of the blob
    private $type;
    //the blob itself
    private $img;
    
    /**
     *
     */
    function __construct () {/*Use functions*/}
    
    /****************************************** GETTER **************************************************/
    
    /**
     *
     * @return mixed
     */
    function getImg ()
    {
        return $this->img;
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
     * @param mixed $img
     */
    function setImg (&$img)
    {
        $this->img = $img;
    }
}