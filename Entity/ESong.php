<?php

require_once 'inc.php';
include_once 'Entity/EObject.php';

/**
 * @author gruppo 2
 * La classe ESong caratterizza le canzoni su cui si basa l'applicazione. Oltre a 
 * caratteristiche generali, quali nome artista e genere, la classe permette di impostare
 * la visibilita' del brano in modo tale da proporlo a specifiche categorie di utenti.
 * Inoltre, una canzone racchiude al suo interno anche i commenti lasciati dagli altri utenti.
 */
class ESong extends EObject
{
    // attributi generali del brano
    private $name;          //stringa contenente il nome dela canzone
    private $artist;        //stringa contenente il nome dell'artista
    private $lenght;        //time stamp che indica lunghezza del brano
    private $genre; 	    //stringa contenente il genere del brano
    private $lyrics; 	    //stringa contenente il testo del brano (facoltativo)
    private $composers;     //stringa contenente i compositori del brano (facoltativo)
    
    //attributi booleani che denotano la visibilita' del brano rispetto a...
    private $guests;        //...guest
    private $supporters;    //...utenti supporters
    private $users;         //...utenti registrati
    
    //stringa che contiene il path del brano
    private $pathMp3; 
    
    //numero di ascolti del brano
    private $listens; 
    
    /**
     * Inizializza una canzone. La visibilita' di default e'
     * per gli utenti registrati e i supporters.
     * @param int $id l'id della canzone
     * @param string $name il nome del brano
     * @param string $artist il nome dell'artista
     * @param string $genre il genere del brano
     */
    function __construct(int $id = null, string $name = null, string $artist = null, string $genre = null)
    {
        parent::__construct($id);
        
        $this->name = $name;
        $this->artist = $artist;
        $this->genre = $genre;
        
        //la visibilita' viene impostata solo per i registrati al sito (user e supporter)
        $this->setForRegisteredOnly();
       
        // numero di ascolti : di default gli ascolti sono impostati a zero.
        $this->listens = 0; 
    }
    
    /**
     * Metodo che fornisce il path del file .mp3 associato
     * alla canzone nel filesystem del server.
     */
    function getFilePath() : string
    {
        return $this->pathMp3;
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
     * Metodo che fornisce il nome della canzone
     * @return string il nome della canzone
     */
    function getName() : string
    {
        return $this->name;
    }
    
    /**
     * Metodo che fornisce la durata in secondi della canzone.
     * @return DateTime la durata della canzone.
     */
    function getLenght() : DateTime
    {
        return $this->lenght;
    }
    
    /**
     * Metodo che fornisce il genere della canzone
     * @return string il genere della canzone
     */
    function getGenre() : string
    {
        return $this->genre;
    }
    
    /**
     * @return number
     */
    function getListens() : int
    {
        return $this->listens;
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
     * Metodo che imposta il path del file .mp3 associato
     * alla canzone nel filesystem del server.
     * @param string $path il path da utilizzare.
     */
    function setFilePath(string $path)
    {
        $this->pathMp3 = $path;
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
     * Imposta il numero di ascolti
     * @param number $listens il numero di ascolti
     */
    function setListens(int $listens)
    {
        $this->listens = $listens;
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
     * Aggiunge un ascolto al brano
     */
    function addListen()
    {
        $this->listens++;
        //update ??
    }  
    
    /**
     * Metodo che verifica se il brano e' nascosto a tutte le tipologie di utenti.
     * @return bool true se il brano e' nascosto, false altrimenti.
     */
    function isHidden() : bool
    {
        return !$this->supporters;
    }
    
    /**
     * Controlla se il brano e' visibile per tutte le tipologie di utenti
     * @return bool true se le tre categorie di utenti (guest, registrati e supporters)
     * possono vedere i brani
     */
    function isForAll() : bool
    {
        return $this->guests;
    }
    
    /**
     * Controlla se il brano e' visibile solo per chi supporta l'artista
     * @return bool true se solo i supporters possono ascoltare i brani,
     * false altrimenti.
     */
    function isForSupportersOnly() : bool
    {
        return $this->supporters;
    }
    
    /**
     * Controlla se il brano e' visibile solo per chi e' registrato
     * @return bool
     */
    function isForRegisteredOnly() : bool
    {
        return $this->users;
    }
    
    /**
     * Imposta la visibilita' per tutti gli utenti.
     */
    function setForAll() 
    {
        $this->All = true;
        $this->supporters = true;
        $this->users = true;
    }
    
    /**
     * Imposta la visibilita' solo per chi supporta l'artista
     */
    function setForSupportersOnly()
    {
        $this->All = false;
        $this->users = false;
        $this->supporters = true;
    }
    
    /**
     * Imposta la visibilita' solo per chi e' registrato.
     */
    function setForRegisteredOnly() 
    {
        $this->All = false;
        $this->supporters = true;
        $this->users = true;
    }
    
    /**
     * Nasconde il brano a tutti gli utenti
     */
    function setHidden() 
    {
        $this->All = false;
        $this->supporters = false;
        $this->users = false;
    }

    /**
     * Funzione che trasforma in una stringa l'oggetto.
     * Utile per il debug.
     *
     * @return string una stringa rappresentante le informazioni sull'oggetto.
     */
    function __toString() : string
    {
        $string = "Nome :" . $this->name . "\nArtista: " . $this->artist . "\nGenere: " . $this->genre . "\nVisibilita': ";
        if ($this->isForAll())
            $string .= "Per tutti. \n";
        
        if ($this->isForRegisteredOnly())
            $string .= "Solo registrati. \n";
        
        if ($this->isForSupportersOnly())
            $string .= "Solo supporters. \n";
        
        if ($this->id!=NULL)
            $string .= $this->getId() . "\n";
        return $string;
    }
    
}
