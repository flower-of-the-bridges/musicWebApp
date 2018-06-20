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
     * @return string la data di scadenza del supporto
     */
    public function getExpirationData() : string
    {
        return $this->expirationData;
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
     * @param string $expirationData la data di scadenza nel formato y-m-d
     */
    function setExpirationData(string $expirationData)
    {
        $this->expirationData = $expirationData;
    }
    
    /**
     * Costruisce la data di scadenza sommando alla data attuale il numero di giorni passati alla funzione.
     * @param int $days i giorni da sommare alla data
     */
    function makeExpirationDateFromPeriod(int $days)
    {
        $date = new DateTime();
        $date->modify("+".$days."days");
        $this->expirationData = $date->format('y-m-d');
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
     * Verifica che il supporto tra i due utenti sia valido, ovvero che un utente non sia 
     * supportando se stesso. L'utente che riceve il supporto deve essere musicista, chi lo offre
     * non deve essere guest.
     * @return bool true se l'associazione e' valida, false altrimenti
     */
    function isValid(): bool
    {
        if ($this->artist->getId() != $this->support->getId())
        {
            if (is_a($this->getArtist(), EMusician::class))
            {
                if(is_a($this->getSupport(), EGuest::class))
                    return false;
                else
                    return true;
            }
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
        $artistId = $this->artist->getId();
        $supporterId = $this->support->getId();
        
        if(FPersistantManager::getInstance()->exists(ESupporter::class, FTarget::EXISTS_SUPPORTER, $artistId, $supporterId))
            return true;
        else 
            return false;
    }
    
}

