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
    
    function isValid() : bool
    {
        if($this->artist->getId()!=$this->support->getId())
      {
        if(is_a($this->getArtist(), EMusician::class))
           return true;
                else 
                    return false;
            
        }
           else
                return false;
    }
    
    function exists() : bool
    {
        $uId = $this->artist->getId();
        $pId = $this->support->getId();
        
        if(FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $uId, $pId))
            return true;
            else return false;
    }
    

    public function __construct()
    {}
}

