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
    
    function __construct ()
    {
        $this->mp3 = new EMp3();
        $this->artist = new EMusician();
        $guest = false;
        $supporter = false;
        $registered = false;
    }

/********************************************* GETTER ************************************************/
    
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
    
    /**
     * 
     * @return EMp3 oggetto EMp3
     */
    function getMp3() : EMp3
    {
        if($this->mp3) // se l'mp3 e' gia presente, lo restituisce
            return $this->mp3;
        else // altrimenti effettua una load dal database
        {
            $this->mp3 = FPersistantManager::getInstance()->load('Mp3', $this->id);
            return $this->mp3;
        }
    }
    
/************************************* SETTER *******************************************************/
    /**
     * Metodo che imposta l'artista che ha prodotto la canzone.
     * @param EMusician $artist il musicista che ha realizzato la canzone.
     */
    function setArtist(EMusician &$artist)
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
    
    /**
     * create a new instance of mp3, fill it with parameters and try to store in the DB
     * @param Emp3 $mp3 (optional) l'oggetto mp3 da assegnare al brano
     */
    function setMp3 (EMp3 &$mp3=null)
    {
        if($mp3 && $mp3->getId()==$this->getId())
            $this->mp3 = $mp3;
        else
        {
            $this->mp3->setId($this->id);
            $this->mp3->setMp3( file_get_contents ($_FILES['file']['tmp_name']) );
            $this->mp3->setSize ($_FILES['file']['size']);
            $this->mp3->setType ($_FILES['file']['type']);   
        }
    }
    
/*************************************** PRIVACY SETTINGS *******************************************/    

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
    
/**************************************** DEBUG *****************************************************/
    
    /**
     *
     */
    function setStaticMp3()
    {
        //momentaneamente il file e' una risorsa statica
        $this->mp3->setMp3(file_get_contents('./prova.mp3'));    //si apre il file contenuto nel path.
        $this->mp3->setId($this->id);
        $this->mp3->setSize(200);
        $this->mp3->setType('mp3');
    }
    
    /**
     *
     */
    function closeStaticMp3(){
        fclose($this->mp3->getMp3()); //chiude il file
    }
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
