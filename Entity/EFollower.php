<?php

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

    
    
}

