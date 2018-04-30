<?php
/**
 * @author gruppo 2
 */
class EListener extends EUser{
    //Spostare in EUser e discriminare tra musicista e ascoltatore tramite campo type?
    
    private $favourites; //lista canzoni preferite
    
    function __construct($user=null, $birthDate=null){
        parent::__construct($user, $birthDate);
        $favourites=array();
    }

    /**
     * Aggiunge ai preferiti una canzone.
     *
     * @param Esong $song la canzone da aggiungere
     */
    public function addFavouriteSong(Esong &$song): bool
    {
        $reducedSong = new ESong($song->getName(), $song->getArtist(), $song->getGenre()); // carica nell'array una versione ridotta della canzone
        $reducedSong->setId($song->getId());
        $this->favourites[] = $reducedSong;    
    }
    
    /**
     * Rimuove una canzone dai preferiti
     * @param int $pos la posizione della canzone nella struttura dati
     */
    public function removeFavouriteSong(int $pos){
        unset($this->favourites[$pos]);
    }
    
    /**
     * Restituisce una canzone presente tra i preferiti.
     * @param int $pos la posizione dell'artista
     * @return ESong|NULL ritorna una canzone se la posizione e' valida, NULL altrimenti
     */
    public function getFavouriteSong(int $pos) : ESong{
        if($pos<$this->numberOfSongs())
            return $this->favourites[$pos];
            else return null;
    }
    
    /**
     * Restituisce il numero delle canzoni salvate tra i preferiti
     * @return number il numero di canzoni
     */
    public function numberOfFavouriteSongs(){
        return (int) count($this->favourites);
    }
    
}
