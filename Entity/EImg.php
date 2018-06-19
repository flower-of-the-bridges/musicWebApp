<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

class EImg extends EObject
{
    
    /** Dimensione dell'immagine */
    private $size;
    /** Mime Type dell'immagine */
    private $type;
    /** I byte del file */
    private $img;
    
    /**
     *
     */
    function __construct () {/*Use functions*/}
    
    /****************************************** GETTER **************************************************/
    
    /**
     * @param bool $encode (opzionale) se posto a true, effettua la codifica in base64 per la visualizzazione
     * @return mixed I byte dell'immagine
     */
    function getImg (bool $encode = null)
    {
        if($encode)
            $this->img = base64_encode($this->img);
        return $this->img;
    }
    
    /**
     *
     * @return int la dimensione dell'immagine | NULL se non e' specificata
     */
    function getSize () 
    {
        return $this->size;
    }
    
    /**
     *
     * @return string il mime-type del file.
     */
    function getType () : string
    {
        return $this->type;
    }
    
    /********************************************** SETTER *************************************************/
    
    /**
     *
     * @param int $size la dimensione dell'immagine
     */
    function setSize (int $size)
    {
        $this->size = $size;
    }
    
    /**
     *
     * @param string $type il mime-type dell'immagine
     */
    function setType (string $type)
    {
        $this->type = $type;
    }
    
    /**
     *
     * @param mixed $img i byte contenuti nel file
     */
    function setImg ($img)
    {
        $this->img = $img;
    }
    
    /**
     * Imposta l'oggetto con valori statici, ricavati da un immagine contenuta nella directory
     * di lavoro.
     */
    function setStatic()
    {
        $file = dirname(__DIR__)."/def/defProPic.jpg";
        
        $this->img = file_get_contents($file);
        $this->type = mime_content_type($file);
        $this->size = (int) filesize($file);
    }
}
