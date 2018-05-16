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
 */
class EMusician extends EUser
{

    private $genre;
 // genere musicale adottato dal musicista. Calcolato rispetto ai generi di ogni singola canzone.
    
    /**
     *
     */
    function __construct()
    {
        $this->setType('musician');
    }

    /**
     *
     * @return string il genere musicale dell'artista
     */
    function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Calcola il genere musicale dell'artista come combinazione dei generi musicali
     * di ogni singola canzone, oppure viene fornito in ingresso.
     *
     * @param string $genre
     *            il genere musicale dell'artista (facoltativo)
     */
    function setGenre(string $genre = null): void
    {
        // TODO
    }

  
    /**
     * Assegna una canzone all'artista.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
     
     function addSong(Esong &$song) : bool
     {
         if(FPersistantManager::getInstance()->store($song)){
             $song->setMp3();
             return FPersistantManager::getInstance()->store($song->getMp3());
         }
         else return false;
     }
     
     /**
     * Rimuove una canzone del musicista
     *
     * @param int $id l'id della canzone da ottenere
     * @return bool true se l'operazione e' riuscita, false altrimenti
     */
     function removeSong(ESong &$song) : bool
     {
     // TODO
     }

    /**
     * Restituisce le canzoni dell'artista
     *
     * @return array le canzoni del musicista
     */
    function getSongs()
    {
        $songs = FPersistantManager::getInstance()->load('musicianSongs', $this->id);
        if ($songs == NULL)
            return null;
        else
            return $songs;
    }
}
