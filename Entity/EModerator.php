<?php

include_once 'Entity/EUser.php';

/**
 * La classe EModerator estende la classe EUser e implementa la tipologia di utenti Moderator.
 * @author gruppo2
 * @package Entity
 *
 */
class EModerator extends EUser
{
    /**
     * 
     */
    function __construct()
    {
        parent::__construct();
    }
}

