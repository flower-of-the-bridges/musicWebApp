<?php
use Entity\EObject;

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
    protected $name; // il nome dell'utente
    protected $password; // la password dell'utente
    protected $email; // l'email dell'utente
    protected $region; // il luogo dove abita l'utente
    protected $birthDate; // la data di nascita dell'utente
    
    // ATTRIBUTI PER LE STRUTTURE DATI
    protected $followers; // lista dei follower dell'utente
    protected $following; // lista degli utenti seguiti dall'utente
    protected $favourites; // lista delle canzoni preferite
    
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
    function __construct(int $id=null, string $user = null, string $mail = null, string $region = null, DateInterval $birthDate = null){
        parent::__construct($id);
        $this->name = $user;
        $this->email = $mail;
        $this->region = $region;
        $this->birthDate = $birthDate;
        
        $this->followers = array();
        $this->following = array();
        $this->favourites = array();
    }
    
    /**
     * @return string l'email dell'utente
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return string la regione dell'utente
     */
    public function getRegion() : string
    {
        return $this->region;
    }
    
    /**
     *
     * @return string il nome dell'utente
     */
    function getName(): string {
        return $this->name;
    }
    
    /**
     *
     * @return string la password (criptata) dell'utente
     */
    function getPassword(): string {
        return $this->password;
    }

    /**
     *
     * @return DateInterval la data di nascita dell'utente
     */
    function getBirthDate(): DateInterval{
        return $this->birthDate;
    }
    
    
    /**
     * @param string $email l'email dell'utente
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $region la regione dell'utente
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
    function setBirthDate(DateInterval $birthDate) {
        $this->birthDate = $birthDate;
    }
    
    /**
     *
     * @param string $name
     *            il nome da assegnare all'utente
     */
    function setName(string $name) {
        $this->name = $name;
    }
    
    /**
     *
     * @param string $pass
     *            la password da impostare
     */
    function setPassword(string $pass) {
        $this->password = md5($pass); // cripta la password inserita dall'utente come hash
    }
    
    /**
     * Viene aggiunto un utente alla lista dei follower.
     * @param EListener $user
     */
    function addFollower(EListener &$user) {
        // viene caricata nella struttura dati una versione ridotta
        $reducedUser = new EListener($user->getId(), $user->getName());
        $this->followers[]['user'] = $reducedUser;
    }
    
    /**
     * Aggiunge ai preferiti una canzone.
     *
     * @param Esong $song
     *            la canzone da aggiungere
     */
    public function addSongToFavourites(Esong &$song): bool {
        // carica nell'array una versione ridotta della canzone
        $reducedSong = new ESong($song->getId(), $song->getName(), $song->getArtist(), $song->getGenre());
        $this->favourites[] = $reducedSong;
        // store sul db?
    }
    
    /**
     * Rimuove una canzone dai preferiti
     *
     * @param int $pos
     *            la posizione della canzone nella struttura dati.
     *            Il conteggio comincia da 1.
     */
    public function removeSongFromFavourites(int $pos) {
        if ($pos <= $this->numberOfFavouriteSongs() && $pos > 0)
            unset($this->favourites[$pos - 1]);
    }
    
    /**
     * Rimuove un follower data la sua posizione
     *
     * @param int $pos
     *            la posizione del follower nella struttura dati.
     *            Il conteggio comincia da 1.
     */
    public function removeFollower(int $pos) {
        if ($pos <= $this->numberOfFollowers() && $pos > 0)
            unset($this->followers[$pos - 1]);
    }
    
    /**
     * Restituisce una canzone presente tra i preferiti.
     *
     * @param int $pos
     *            la posizione dell'artista (comincia da 1).
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    public function getSongFromFavourites(int $pos) : ESong {
        if ($pos <= $this->numberOfSongs() && $pos > 0) // verifica che la posizione sia valida
            return $this->favourites[$pos - 1];
            else
                return null;
    }
    
    /**
     * Restituisce il numero di follower di un brano.
     *
     * @return int il numero di follower.
     */
    function numberOfFollowers(): int
    {
        return count($this->followers);
    }
    
    /**
     * Restituisce il numero delle canzoni salvate tra i preferiti.
     *
     * @return number il numero di canzoni.
     */
    public function numberOfFavouriteSongs() : int {
        return count($this->favourites);
    }
    
    /**
     * Permette di seguire un altro utente
     * @param EListener $listener l'utente da seguire
     */
    public function follow(EListener &$listener) {
        $listener->addFollower($this);
        $reducedUser = new EListener($listener->getId(), $listener->getName());
        $this->following[] = $reducedUser;
        // store sul db ?
    }
    
    /**
     * Smette di seguire un altro utente
     * @param EListener $listener l'utente da non seguire
     */
    public function unFollow(EListener &$listener) {
        // TODO
    }
    
    /**
     * Permette di supportare un musicista.
     * @param EMusician $musician
     */
    public function support(EMusician &$musician) {
        // TODO
    }
    
    /**
     * Smette di supportare un musicista.
     * @param EMusician $musician
     */
    public function unSupport(EMusician &$musician) {
        // TODO
    }
}