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
    //generics
    private $name;          //string containing song name
    private $artist;        //string containing the reference to the EMusician instance
    
    private $genre; 	    //string containing genre of the song
    
    //booleans used to set privacy settings respect to...
    private $guest;              //...guest
    private $supporter;         //...utenti supporters
    private $registered;        //...utenti registrati
    
    //stringa che contiene la maniglia all'oggetto Emp3
    private $mp3; 
    
    
    ///////////////////////////////////////////////////////MP3////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //create a new instance of mp3, fill it with parameters and try to store in the DB
    function createMp3 (array $file)
    {
        $this->mp3 = new EMp3();
        
        $this->mp3->getSong ($this);
        
        $this->mp3->getMp3( file_get_contents ($file['file']['tmp_name']) );
        $this->mp3->getSize ($file['file']['size']);
        $this->mp3->getType ($file['file']['type']);
        
    }
    
<<<<<<< HEAD
    //return the mp3 instance
    function getMp3() : EMp3
=======
    /**
     * Metodo che fornisce il file .mp3 associato
     * alla canzone nel filesystem del server.
     * @return 
     */
    function getMp3() 
>>>>>>> 503664500c73136faf833f1511c194c01dfff83a
    {
        return $this->mp3;
    }
    
    function storeMp3 () : bool
    {
        return $this->mp3->storeToDBMp3();
    }
    
    function retrieveMp3 () : bool
    {
        return $this->mp3->loadFromDBMp3();
    }
    
    
    /*

    /**
     * Metodo che imposta il file .mp3 associato
     * alla canzone nel filesystem del server.
     * @param mixed $bytes il contenuto dell'mp3 (momentaneamente null perche statico
<<<<<<< HEAD
     * /
    function setMp3Old($bytes = null)
=======
     */
    function setMp3(string $name, string $type, $byte)
>>>>>>> 503664500c73136faf833f1511c194c01dfff83a
    {
        //momentaneamente il file e' una risorsa statica
        $mp3=fopen($obj->getFilePath(), 'rb') or die('cant open');    //si apre il file contenuto nel path.
    }
    
    /**
     * DEBUG ONLY
     * /
    function closeMp3(){
        fclose($mp3); //chiude il file
    }
    /**
     * Metodo che fornisce il file .mp3 associato
     * alla canzone nel filesystem del server.
     * return byte del file
     #*/
    
    ///////////////////////////////////////////////////////MP3////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    
    
    
    
    
    
    
    ///////////////////////////////////////////////////////PRIVACY SETTINGS///////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Metodo che verifica se il brano e' nascosto a tutte le tipologie di utenti.
     * @return bool true se il brano e' nascosto, false altrimenti.
     */
    function isHidden() : bool
    {
        return !$this->supporter;
    }
    
    /**
     * Controlla se il brano e' visibile per tutte le tipologie di utenti
     * @return bool true se le tre categorie di utenti (guest, registrati e supporters)
     * possono vedere i brani
     */
    function isForAll() : bool
    {
        return $this->guest;
    }
    
    /**
     * Controlla se il brano e' visibile solo per chi supporta l'artista
     * @return bool true se solo i supporters possono ascoltare i brani,
     * false altrimenti.
     */
    function isForSupportersOnly() : bool
    {
        return $this->supporter;
    }
    
    /**
     * Controlla se il brano e' visibile solo per chi e' registrato
     * @return bool
     */
    function isForRegisteredOnly() : bool
    {
        return $this->registered;
    }
    
    /**
     * Imposta la visibilita' per tutti gli utenti.
     */
    function setForAll() 
    {
        $this->guest = true;
        $this->supporter = true;
        $this->registered = true;
    }
    
    /**
     * Imposta la visibilita' solo per chi supporta l'artista
     */
    function setForSupportersOnly()
    {
        $this->guest = false;
        $this->registered = false;
        $this->supporter = true;
    }
    
    /**
     * Imposta la visibilita' solo per chi e' registrato.
     */
    function setForRegisteredOnly() 
    {
        $this->guest = false;
        $this->supporter = true;
        $this->registered = true;
    }
    
    /**
     * Nasconde il brano a tutti gli utenti
     */
    function setHidden() 
    {
        $this->guest = false;
        $this->supporter = false;
        $this->registered = false;
    }
    ///////////////////////////////////////////////////////PRIVACY SETTINGS///////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    
    
/////////////////////////////////////////////////
    function __construct () {/*Use functions*/}//
/////////////////////////////////////////////////

    
    ///////////////////////////////////////////////////////GETTER/////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Metodo che fornisce il nome dell'artista che ha
     * prodotto la canzone
     * @return EMusician il musicista autore della canzone
     */
    function getArtist() : EMusician
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
     * Metodo che fornisce il genere della canzone
     * @return string il genere della canzone
     */
    function getGenre() : string
    {
        return $this->genre;
    }
    ///////////////////////////////////////////////////////GETTER/////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    ///////////////////////////////////////////////////////SETTER/////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Metodo che imposta l'artista che ha prodotto la canzone.
     * @param EMusician $artist il musicista che ha realizzato la canzone.
     */
    function setArtist(EMusician $artist)
    {
        $this->artist = $artist;
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
     * Metodo che imposta il genere della canzone.
     * @param string $genre il genere musicale della canzone.
     */
    function setGenre(string $genre)
    {
        $this->genre = $genre;
    }
    ///////////////////////////////////////////////////////SETTER/////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    
    ////////////////////////////////////////////////////TO STRING/////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Funzione che trasforma in una stringa l'oggetto.
     * Utile per il debug.
     * @return string una stringa rappresentante le informazioni sull'oggetto.
     */
    function __toString() : string
    {
        $string = "Nome :" . $this->name . "\nArtista: " . $this->artist->getName() . "\nGenere: " . $this->genre . "\nVisibilita': ";
        if ($this->isForAll())
            $string .= "Per tutti. \n";
        elseif ($this->isForRegisteredOnly())
            $string .= "Solo registrati. \n";
        elseif ($this->isForSupportersOnly())
            $string .= "Solo supporters. \n";
        else $string .= "Nascosta. \n";
        if ($this->id!=NULL)
            $string .= $this->getId() . "\n";
        return $string;
    }
    
}
