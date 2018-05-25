<?php

require_once 'inc.php';

class ESupporter
{
        
    private $expirationData;
    private $renewal;
    private $artist;
    private $support;
    
    
    
    
    /**
     * @return mixed
     */
    public function getExpirationData() : DateTime
    {
        return $this->expirationData;
    }

    /**
     * @return mixed
     */
    public function getRenewal() : bool
    {
        return $this->renewal;
    }

    /**
     * @return mixed
     */
    public function getArtist() : EUser
    {
        return $this->artist;
    }

    /**
     * @return mixed
     */
    public function getSupport() : EUser
    {
        return $this->support;
    }

    /**
     * @param mixed $expirationData
     */
    public function setExpirationData(DateTime $expirationData)
    {
        $this->expirationData = $expirationData;
    }

    /**
     * @param mixed $renewal
     */
    public function setRenewal(bool $renewal)
    {
        $this->renewal = $renewal;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist(EUser $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @param mixed $support
     */
    public function setSupport(EUser $support)
    {
        $this->support = $support;
    }

    public function __construct()
    {}
}

