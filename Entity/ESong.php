<?php
/**
 * @author gruppo 2
 */
class ESong
{

    private $IdSong;    //identificativo univoco canzone               
    
    private $name; 		//stringa contenente il nome dela canzone      PK sul db

    private $artist; 	//il nome dell'artista                         PK sul db

    private $lenght; 	//lunghezza del brano

    private $genre; 	//il genere del brano

    private $lyrics; 	//testo del brano (facoltativo)
    
    private $composers; //i compositori del brano (facoltativo)

    //attributi booleani che denotano la visibilita' del brano
    private $guests;

    private $supporters;

    private $users;
    
    //stringa che contiene il path del brano
    private $pathMp3;

    /**
     * Inizializza una canzone. La visibilita' di default e'
     * per gli utenti registrati e i supporters.
     * @param string $name il nome del brano
     * @param string $artist il nome dell'artista
     * @param string $genre il genere del brano
     */
    public function __construct(string $name, string $artist,string $genre)
    {
        $this->name = $name;
        $this->artist=$artist;
        $this->genre = $genre;
        $this->guests = false;
        $this->supporters = true;
        $this->users = true;
    }

    /**
     * Metodo che fornisce il path del file .mp3 associato
     * alla canzone nel filesystem del server.
     * @return string il path del filesystem
     */
    function getFilePath() :string {
        return $this->pathMp3;
    }
    
    /**
     * Metodo che imposta il path del file .mp3 associato
     * alla canzone nel filesystem del server.
     * @param string $path il path da utilizzare.
     */
    function setFilePath(string $path) : void{
        $this->pathMp3 = $path;
    }
    
    /**
     * Metodo che restituisce l'identificativo univoco della canzone
     * nel database.
     * @return int l'id della canzone.
     */
    function getID() {
        return $this->IdSong;
    }
    
    /**
     * Metodo che assegna alla canzone l'id univoco nel database.
     * Va richiamato dalle classi Foundation che comunicano con il 
     * DBMS.
     * @param int $id l'id univoco della canzone.
     */
    function setID(string $id) {
        $this->IdSong = $id;
    }
    
    /**
     * Metodo che fornisce il nome dell'artista che ha 
     * prodotto la canzone
     * @return string il nome dell'artista
     */
    function getArtist() : string
    {
        return $this->artist;
    }
    
    /**
     * Metodo che imposta il nome dell'artista che ha 
     * prodotto la canzone.
     * @param string $artist il nome dell'artista.
     */
    function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * Metodo che fornisce il nome della canzone
     * @return string il nome della canzone
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * Metodo che fornisce la durata in secondi della canzone.
     * @return DateTime la durata della canzone.
     */
    function getLenght(): DateTime
    {
        return $this->lenght;
    }

    /**
     * Metodo che fornisce il genere della canzone
     * @return string il genere della canzone
     */
    function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * Metodo che imposta il nome della canzone.
     * @param string $name il nome della canzone.
     */
    function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Metodo che imposta la durata della canzone.
     * @param DateTime $lenght la durata della canzone
     */
    function setLenght(DateTime $lenght)
    {
        $this->lenght = $lenght;
    }

    /**
     * Metodo che imposta il genere della canzone.
     * @param string $genre il genere musicale della canzone.
     */
    function setGenre(string $genre)
    {
        $this->genre = $genre;
    }
    
    /**
     * Metodo che restituisce il testo della canzone
     * @return string che rappresenta il testo della canzone(puo' essere null).
     */
    function getLyrics() : string
    {
        return $this->lyrics;
    }
    
    /**
     * Metodo che restituisce i compositori della canzone
     * @return string che rappresenta i composuitori (puo' essere null).
     */
    function getComposers() : string
    {
        return $this->composers;
    }
    
    /**
     * Metodo che imposta il testo della canzone
     * @param string $lyrics il testo della canzone.
     */
    function setLyrics(string $lyrics)
    {
        $this->lyrics = $lyrics;
    }
    
    /**
     * Metodo che imposta i compositori della canzone.
     * @param mixed $composers i compositori della canzone
     */
    function setComposers(string $composers)
    {
        $this->composers = $composers;
    }

    /**
     * Metodo che verifica se il brano e' nascosto a tutte le tipologie di utenti.
     * @return bool true se il brano e' nascosto, false altrimenti.
     */
    function isHidden() : bool{
        return !$this->users && !$this->guests && !$this->supporters;
    }

    /**
     * Controlla se il brano e' visibile per tutte le tipologie di utenti
     * @return bool true se le tre categorie di utenti (guest, registrati e supporters)
     * possono vedere i brani
     */
    function isForAll(): bool
    {
        return $this->guests && $this->users && $this->supporters;
    }

    /**
     * Controlla se il brano e' visibile solo per chi supporta l'artista
     * @return bool true se solo i supporters possono ascoltare i brani, 
     * false altrimenti.
     */
    function isForSupportersOnly(): bool
    {
        return $this->supporters && !$this->users;
    }

    /**
     * Controlla se il brano e' visibile solo per chi e' registrato
     * @return bool
     */
    function isForRegisteredOnly(): bool
    {
        return $this->users && $this->supporters;
    }

   /**
    * Imposta la visibilita' per tutti gli utenti.
    */
    function setForAll() : void
    {
        $this->All = true;
        $this->supporters = true;
        $this->users = true;
    }

    /**
     * Imposta la visibilita' solo per chi supporta l'artista
     */
    function setForSupportersOnly() : void
    {
        $this->All = false;
        $this->users = false;
        $this->supporters = true;
    }

    /**
     * Imposta la visibilita' solo per chi e' registrato.
     */
    function setForRegisteredOnly() : void
    {
        $this->All = false;
        $this->supporters = true;
        $this->users = true;
    }

    /**
     * Nasconde il brano a tutti gli utenti
     */
    function setHidden() : void
    {
        $this->All = false;
        $this->supporters = false;
        $this->users = false;
    }


    /**
     * Funzione che trasforma in una stringa l'oggetto.
     * Utile per il debug.
     * @return string una stringa rappresentante le informazioni sull'oggetto.
     */
    function __toString(){
        $string="Nome :".$this->name."\nArtista: ".
            $this->artist."\nGenere: ".
			$this->genre."\nVisibilita': ";
        if($this->isForAll())
			$string.="Per tutti. \n";
        if($this->isForRegisteredOnly())
			$string.="Solo registrati. \n";
        if($this->isForSupportersOnly())
			$string.="Solo supporters. \n";
        $string.=$this->getID() . "\n";
        return $string;
        
    }



  
    
}
