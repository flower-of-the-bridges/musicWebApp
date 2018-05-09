<?php

class EMp3
{
    
    //ESong reference instance
    private $song;
    //size of the uploaded song
    private $size;
    //mime type of the blob
    private $type;
    //the blob itself
    private $mp3;
    
    /////////////////////////////////////////////specifics methods
    
    function storeToDBMp3() : bool {/*someting that put mp3 in db on foundation*/ return $succes;}
    
    function loadFromDBMp3() : bool {/*someting that put mp3 from db on foundation*/}
    
    /////////////////////////////////////////end specific methods
    
/////////////////////////////////////////////////
    function __construct () {/*Use functions*/}//
/////////////////////////////////////////////////

    ////////////////////////////////////////////getter e setter
    /////////////////////////
    function getSong () : ESong
    {
        return $this->song;
    }
    function setSong (ESong $s)
    {
        $this->song = $s;
    }
    /////////////////////////
    /////////////////////////
    function getSize () : int
    {
        return $this->size;
    }
    function setSize (int $s)
    {
        $this->size = $s;
    }
    /////////////////////////
    /////////////////////////
    function getType () : string
    {
        return $this->type;
    }
    function setType (string $t)
    {
        $this->type = $t;
    }
    /////////////////////////
    /////////////////////////
    function getMp3 () : string
    {
        return $this->mp3;
    }
    function setMp3 (string $m)
    {
        $this->mp3 = $m;
    }
    /////////////////////////    
}
