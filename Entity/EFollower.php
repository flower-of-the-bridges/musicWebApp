<?php

require_once 'inc.php';

/**
 * La classe EFollower fornisce un modello per la funzionalità Segui. Un'istanza di tale classe mette in
 * relazione un utente con un ulteriore utente, che ha deciso di seguirlo. 
 * @author gruppo2
 */
class EFollower
{
    private $user; // l'utente oggetto del follow
    private $follower; // l'utente follower
    
    /**
     * 
     */
    function __construct(){}
    
    /**
     * 
     * @return EUser l'utente oggetto del follow
     */
    function getUser() : EUser
    {
        return $this->user;
    }

    /**
     * @return EUser l'utente follower
     */
    function getFollower() : EUser
    {
        return $this->follower;
    }

    /**
     * @param EUser l'utente oggetto del follow
     */
    function setUser(EUser &$user)
    {
        $this->user = $user;
    }

    /**
     * @param EUser l'utente follower
     */
    function setFollower(EUser &$follower)
    {
        $this->follower = $follower;
    }

    /**
     * Verifica che l'associazione tra i due utenti sia valida, ovvero che un utente non stia 
     * seguendo se stesso.
     * @return bool true se l'associazione è valida, false altrimenti
     */
    function isValid() : bool
    {
        if($this->user->getId()!=$this->follower->getId())
            return true;
        else
            return false;
    }
    
    /**
     * Verifica che l'associazione tra gli utenti sia presente nel database
     * @return bool true se l'associazione esiste, false altrimenti
     */
    function exists() : bool
    {
        $uId = $this->user->getId();
        $pId = $this->follower->getId();
        
        if(FPersistantManager::getInstance()->exists(EFollower::class, FTarget::EXISTS_FOLLOWER, $uId, $pId))
            return true;
        else return false;
    }
    
    
}

