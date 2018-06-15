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
    function getImg (bool $encode = null)
    {
        if($encode)
            $this->img = base64_encode($this->img);
        return $this->img;
    }
    
    /**
     *
     * @return int | NULL
     */
    function getSize () 
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
    
    function setStatic()
    {
        $file = dirname(__DIR__)."/def/defProPic.jpg";
        
        $this->img = file_get_contents($file);
        $this->type = mime_content_type($file);
        $this->size = (int) filesize($file);
        
        var_dump($this);
    }
}
