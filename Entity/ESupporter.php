<?php

require_once 'inc.php';

/**
 * La classe ESupporter mette in relazione un utente e il musicista che vuole seguire.
 * @author gruppo2
 * @package Entity
 */
class ESupporter
{
    /** la data di scadenza del supporto */    
    private $expirationData;
    /** campo bool che denota se l'utente rinnoverà o meno la sottoscrizione */
    private $renewal;
    /** EMusician che denota il musicista che si sta supportando */
    private $artist;
    /** EUser che denota l'utente che effettua l'operazione di supporto */
    private $support;
    
    /**
     * 
     */
    function __construct()
    {
        
    }
    
    
    /**
     * @return DateTime la data di scadenza del supporto
     */
    public function getExpirationData() : DateTime
    {
        return $this->expirationData;
    }

    /**
     * @return bool true se l'utente rinnova la sottoscrizione, false altrimenti
     */
    public function getRenewal() : bool
    {
        return $this->renewal;
    }

    /**
     * @return EMusician il musicista oggetto del supporto
     */
    public function getArtist() : EMusician
    {
        return $this->artist;
    }

    /**
     * @return EUser l'utente che effettua il supporto
     */
    public function getSupport() : EUser
    {
        return $this->support;
    }

    /**
     * @param mixed $expirationData la data di scadenza
     */
    function setExpirationData(DateTime $expirationData)
    {
        $this->expirationData = $expirationData;
    }

    /**
     * @param bool $renewal true se l'utente rinnova il supporto, false altrimenti
     */
    function setRenewal(bool $renewal)
    {
        $this->renewal = $renewal;
    }

    /**
     * @param EMusician $artist l'artista oggetto del supporto
     */
    public function setArtist(EUser $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @param EUser $support l'utente che effettua l'operazione di supporto
     */
    public function setSupport(EUser $support)
    {
        $this->support = $support;
    }

    /**
     * Verifica che il supporto tra i due utenti sia valido
     * @return bool
     */
    function isValid(): bool
    {
        if ($this->artist->getId() != $this->support->getId())
        {
            if (is_a($this->getArtist(), EMusician::class))
                return true;
            else
                return false;
        } 
        else
            return false;
    }
    
    /**
     * Verifica se il supporto tra i due utenti esiste gia
     * @return bool true se il supporto esiste, false altrimenti
     */
    function exists() : bool
    {
        $uId = $this->artist->getId();
        $pId = $this->support->getId();
        
        if(FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $uId, $pId))
            return true;
        else return false;
    }
    
}

