<?php

require_once 'inc.php';
/**
 * @author gruppo 2
 */
class EMusician extends EUser{
    
    private $songs; //lista di canzoni create dal musicista 
    private $genre; //genere musicale adottato dall'artista. Calcolato rispetto ai generi di ogni singola canzone.
    
    /**
     * @param string $user
     * @param DateTime $birthDate
     */
    public function __construct(string $user, DateTime $birthDate) {
        
        parent::__construct($user, $birthDate);
        $this->songs =array();
    }
    
    /**
     * Assegna una canzone all'artista.
     * @param Esong $song la canzone da aggiungere
     */
    public function addSong(Esong &$song){
        $reducedSong=new ESong($song->getName(),$song->getArtist(), $song->getGenre()); //carica nell'array una versione ridotta della canzone
        $reducedSong->setId($song->getId());
        $this->songs[]=$reducedSong;
    }
    
    /**
     * Rimuove una canzone dal musicista
     * @param int $pos la posizione della canzone nella struttura dati
     */
    public function removeSong(int $pos){
        unset($this->songs[$pos]);
    }
    
    /**
     * Restituisce una canzone dell'artista
     * @param int $pos la posizione dell'artista
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    public function getSong(int $pos) : ESong{
        if($pos<$this->numberOfSongs())
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
     * Overrided method from the parent class.
     * @param $birthDate DateTime value
     */
    public function setBirthDate($birthDate) {
        parent::setBirthDate($birthDate);
    }
	
    /**
     * Overrided method from the parent class.
     * @return DateTime representing the birth date of the musician.
     */
    public function getBirthDate() {
        return parent::getBirthDate();
    }

    public function getName() : string{
        parent::getName();
    }

    public function setName(string $name){
        parent::setName($name);
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
     * di ogni singola canzone.
     */
    public function setGenre() : void
    {
        foreach ($this->songs as $value)
            if(strpos($this->genre, $value)!== false) //verifica che il genere non sia gia stato inserito
                $this->genre.=$value." ";
    }


}
