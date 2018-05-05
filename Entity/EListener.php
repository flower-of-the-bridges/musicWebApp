<?php
require_once 'inc.php';
include_once 'Entity/EObject';

/**
 *
 * @author gruppo 2
 *         La classe EListener rappresenta l'utente base dell'applicazione: come tale
 *         puo' avere una lista di follower e una lista di canzoni preferite.
 *         Puo' seguire altri utenti e, in caso di musicisti, puo' supportarli
 */
class EListener extends EObject
{

    // ATTRIBUTI PER I DATI PERSONALI
    protected $name;
 // il nome dell'utente
    protected $password;
 // la password dell'utente
    protected $email;
 // l'email dell'utente
    protected $region;
 // il luogo dove abita l'utente
    protected $birthDate;
 // la data di nascita dell'utente
    
    /**
     * Metodo costruttore che istanzia un oggetto EListener
     *
     * @param int $id
     *            l'id dell'utente (facoltativo)
     * @param string $user
     *            il nome dell'utente (facoltativo)
     * @param string $mail
     *            l'email associata all'account (facoltativa)
     * @param string $region
     *            il luogo dove abita l'utente (facoltativo
     * @param DateTime $birthDate
     *            la data di nascita (facoltativo)
     */
    function __construct(int $id = null, string $user = null, string $mail = null, string $region = null, DateInterval $birthDate = null)
    {
        parent::__construct($id);
        $this->name = $user;
        $this->email = $mail;
        $this->region = $region;
        $this->birthDate = $birthDate;
    }

    /**
     *
     * @return string l'email dell'utente
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     *
     * @return string la regione dell'utente
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     *
     * @return string il nome dell'utente
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     *
     * @return string la password (criptata) dell'utente
     */
    function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     * @return DateInterval la data di nascita dell'utente
     */
    function getBirthDate(): DateInterval
    {
        return $this->birthDate;
    }

    /**
     *
     * @param string $email
     *            l'email dell'utente
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     *
     * @param string $region
     *            la regione dell'utente
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }

    /**
     *
     * @param DateInterval $birthDate
     *            la data di nascita da impostare
     */
    function setBirthDate(DateInterval $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     *
     * @param string $name
     *            il nome da assegnare all'utente
     */
    function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $pass
     *            la password da impostare
     */
    function setPassword(string $pass)
    {
        $this->password = md5($pass); // cripta la password inserita dall'utente come hash
    }

    /**
     * Viene aggiunto un utente alla lista dei follower.
     *
     * @param EListener $user
     */
    function addFollower(EListener &$user)
    {
        
        // TODO
    }

    /**
     * Aggiunge ai preferiti una canzone.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
    public function addSongToFavourites(Esong &$song): bool
    {
        // TODO
    }

    /**
     * Rimuove una canzone dai preferiti
     *
     * @param int $pos
     *            la posizione della canzone nella struttura dati.
     *            Il conteggio comincia da 1.
     */
    function removeSongFromFavourites(int $pos)
    {
        // TODO
    }

    /**
     * Rimuove un follower data la sua posizione
     *
     * @param int $pos
     *            la posizione del follower nella struttura dati.
     *            Il conteggio comincia da 1.
     */
    function removeFollower(int $pos)
    {
        // TODO
    }

    /**
     * Restituisce una canzone presente tra i preferiti.
     *
     * @param int $pos
     *            la posizione dell'artista (comincia da 1).
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    function getSongsFromFavourites(int $pos): array
    {
        // TODO
    }

    /**
     * Permette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da seguire
     */
    public function follow(EListener &$listener)
    {
        // TODO
    }

    /**
     * Smette di seguire un altro utente
     *
     * @param EListener $listener
     *            l'utente da non seguire
     */
    function unFollow(EListener &$listener)
    {
        // TODO
    }

    /**
     * Permette di supportare un musicista.
     *
     * @param EMusician $musician
     */
    function support(EMusician &$musician)
    {
        // TODO
    }

    /**
     * Smette di supportare un musicista.
     *
     * @param EMusician $musician
     */
    function unSupport(EMusician &$musician)
    {
        // TODO
    }

    function report($object)
    {
        // TODO
    }
}

    