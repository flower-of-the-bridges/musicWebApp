<?php
require_once 'inc.php';
include_once 'Entity/EUser.php';

/**
 *
 * @author gruppo 2
 *         La classe EListener rappresenta l'utente base dell'applicazione.
 *         Puo' seguire altri utenti e, in caso di musicisti, puo' supportarli
 */
class EListener extends EUser
{

    // ATTRIBUTI PER I DATI PERSONALI
 //   protected $region;
 // il luogo dove abita l'utente
 // protected $birthDate;  la data di nascita dell'utente
    
    /**
     * Metodo costruttore che istanzia un oggetto EListener
     *
     */
    function __construct()
    {
        $this->setType('listener');
    }


    /**
     * Viene aggiunto un utente alla lista dei follower.
     *
     * @param EListener $user l'utente da aggiungere
     */
    function addFollower(EUser &$user) : bool
    {
        // TODO 
    }
    
    /**
     * Rimuove un utente dalla lista dei follower
     *
     * @param int $id del follower
     */
    function removeFollower(EUser &$user)
    {
        // TODO
    }

    /**
     * Aggiunge ai preferiti una canzone.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
    function addSongToFavourites(Esong &$song): bool
    {
        // TODO
    }

    /**
     * Rimuove una canzone dai preferiti.
     *
     * @param int $id della canzone.
     */
    function removeSongFromFavourites(ESong &$song) : bool
    {
        // TODO
    }

 
    /**
     * Restituisce una canzone presente tra i preferiti.
     *
     * @param int $id della canzone
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    function getSongsFromFavourites(): array
    {
        // TODO
    }

    /**
     * Permette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da seguire
     */
    function follow(EUser &$user) : bool
    {
        // TODO
    }

    /**
     * Smette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da non seguire
     */
    function unFollow(EListener &$user) : bool
    {
        // TODO
    }

    /**
     * Permette di supportare un musicista.
     *
     * @param EMusician $musician
     */
    function support(EMusician &$musician) : bool
    {
        // TODO
    }

    /**
     * Segnala un contenuto dell'applicazione.
     * @param object $object il contenuto da segnalare.
     */
    function report($object) : bool
    {
        // TODO
    }
}

    