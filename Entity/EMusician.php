<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

/**
 *
 * @author gruppo 2
 *         La classe EMusician rappresenta una tipologia di utente piu' avanzata di quella
 *         di EListener (di cui infatti eredita i metodi). Un utente istanza di EMusician
 *         ha infatti un genere musicale, ricavato dalla lista di canzoni che egli stesso puo'
 *         caricare.
 * @package Entity
 */
class EMusician extends EUser
{
    /** le informazioni per il supporto dell'utente */
    private $supInfo; 
    
    /**
     *
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Restituisce le informazioni sul supporto
     * @return ESupInfo | NULL
     */
    function getSupportInfo()
    {
        $this->supInfo = FPersistantManager::getInstance()->load(ESupInfo::class, $this->id);
        return $this->supInfo;
    }
    
    /**
     * Imposta le informazioni sul supporto 
     * @param ESupInfo $supInfo
     */
    function setSupportInfo(ESupInfo $supInfo)
    {
        $supInfo->setId($this->id);
        
        if(!FPersistantManager::getInstance()->load(ESupInfo::class, $this->id))
        {
            FPersistantManager::getInstance()->store($supInfo);
        }
        else
        {
            FPersistantManager::getInstance()->update($supInfo);
        }
        
        $this->supInfo = $supInfo;
    }
  
  
    /**
     * Restituisce le canzoni dell'artista
     *
     * @return array le canzoni del musicista
     */
    function getSongs()
    {
        $songs = FPersistantManager::getInstance()->load(ESong::class, $this->id, FTarget::LOAD_MUSICIAN_SONG);
        if ($songs == NULL)
            return null;
        else
            return $songs;
    }
}
