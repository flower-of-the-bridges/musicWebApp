<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

//this class is made to be a container for all the
//informations about the users that are not crucial or necessary

class EUserInfo extends EObject
{
    private $firstName;         //the first name of the user
    private $lastName;          //the last name of the user
    private $birthPlace;        //the birth place of the user    
    private $birthDate;         //the birth date of the user    
    private $bio;               //a self made introduction of the user himself
    private $genre;             //the generated genre of this user
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    //this method make a new genre based on user preferences
    function generateGenre(string $genre = null)
    {
        if($genre!=NULL)
        {
            $this->genre = $genre;
        }
        else
        {
            $this->genre = ''; //inizializza il genere
            $songs = FPersistantManager::getInstance()->load('musicianSongs', $this->id);
            if($songs)
            {
                foreach ($songs as $song)
                {
                    $songGenre = $song->getGenre();
                    if(!preg_match('/\b'.$songGenre.'\b/',$this->genre)) //verifica che il genere non sia gia stato inserito
                        $this->genre.=$songGenre." "; // aggiunge il valore al genere
                }
            }
            FPersistantManager::getInstance()->update($this);
        }
    }
    
    
    function setFirstName (string $firstName)
    {
        $this->firstName = $firstName;
    }
    function getFirstName () : string
    {
        return $this->firstName;
    }
    
    function setLastName (string $lastname)
    {
        $this->lastName = $lastname;
    }
    function getLastName () : string
    {
        return $this->lastName;
    }
    
    function setBirthPlace (string $birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }
    function getBirthPlace () : string
    {
        return $this->birthPlace;
    }
    
    function setBirthDate (DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
    function getBirthDate () : DateTime
    {
        return $this->birthDate;
    }
    
    function setBio (string $bio)
    {
        $this->bio = $bio;
    }
    function getBio () : string
    {
        return $this->bio;
    }
    
    function setGenre (string $genre)
    {
        $this->genre = $genre;
    }
    function getGenre () : string
    {
        return $this->genre;
    }
      
}















