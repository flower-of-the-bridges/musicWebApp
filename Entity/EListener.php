<?php
require_once 'inc.php';
include_once 'Entity/EUser.php';

/**
 *
 * @author gruppo 2
 *         La classe EListener rappresenta l'utente base dell'applicazione.
 *         Puo' seguire altri utenti e, in caso di musicisti, puo' supportarli.
 * @package Entity
 */
class EListener extends EUser
{

    /**
     * Metodo costruttore che istanzia un oggetto EListener
     */
    function __construct()
    {
        parent::__construct();
    }


}

    