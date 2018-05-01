<?php

require_once 'inc.php';
/**
 * @author gruppo 2
 * La classe EMusician rappresenta una tipologia di utente piu' avanzata di quella
 * di EListener (di cui infatti eredita i metodi). Un utente istanza di EMusician
 * ha infatti un genere musicale, ricavato dalla lista di canzoni che egli stesso puo'
 * caricare.
 */
class EMusician extends EListener{
    
    private $songs; //lista di canzoni appartenenti al musicista
    private $genre; //genere musicale adottato dal musicista. Calcolato rispetto ai generi di ogni singola canzone.
    
    /**
     *
     * @param int $id
     * @param string $user
     * @param string $mail
     * @param string $region
     * @param DateInterval $birthDate
     * @param string $genre
     */
    public function __construct(int $id, string $user=null, string $mail=null, string $region=null, DateInterval $birthDate=null, string $genre) {
        
        parent::__construct($id, $user, $mail, $region, $birthDate); //richiamo il costruttore della classe padre
        $this->genre=$genre;
        $this->songs =array();
    }
    
    /**
     * Assegna una canzone all'artista.
     * @param Esong $song la canzone da aggiungere
     */
    public function addSong(Esong &$song){
        //FPersistantManger->store?
        $reducedSong=new ESong($song->getName(),$song->getArtist(), $song->getGenre()); //carica nell'array una versione ridotta della canzone
        $reducedSong->setId($song->getId());
        $this->songs[]=$reducedSong;
    }
    
    /**
     * Rimuove una canzone del musicista
     * @param int $pos la posizione della canzone nella struttura dati (comincia da 1)
     * @return bool true se l'operazione e' riuscita, false altrimenti
     */
    public function removeSong(int $pos){
        if($pos<$this->numberOfSongs() && $pos>0){
            unset($this->songs[$pos]);
            return true;
        }
        else return false;
    }
    
    /**
     * Restituisce una canzone dell'artista
     * @param int $pos la posizione dell'artista (comincia da 1)
     * @return ESong|NULL ritorna una ESong se la posizione e' valida, NULL altrimenti
     */
    public function getSong(int $pos) : ESong{
        if($pos<=$this->numberOfSongs() && $pos>0)
            //load FSong?
            return $this->songs[$pos];
            else return null;
    }
    
    /**
     * Restituisce il numero delle canzoni associate all'artista
     * @return number il numero di canzoni
     */
    public function numberOfSongs(){
        return (int) count($this->songs);
    }
    
    /**
     * @return string il genere musicale dell'artista
     */
    public function getGenre() : string
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
    public function setGenre(string $genre = null): void
    {
        if ($genre != null) { //se non e' specificato il genere, il metodo procede con il calcolo
            $genre=""; //si cancella eventualmente il precedente genere
            foreach ($this->songs as $value)
                if (strpos($this->genre, $value) !== false) // verifica che il genere non sia gia stato inserito
                $this->genre .= $value . " ";
        } else
            $this->genre = $genre;
    }
    
}
