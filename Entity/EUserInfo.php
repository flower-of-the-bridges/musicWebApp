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
        $this->firstName='';
        $this->lastName='';
        $this->birthPlace='';
        $this->birthDate='';
        $this->bio='';
        $this->genre='';
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
    function getFirstName () 
    {
        return $this->firstName;
    }
    
    function setLastName (string $lastname)
    {
        $this->lastName = $lastname;
    }
    function getLastName () 
    {
        return $this->lastName;
    }
    
    function setBirthPlace (string $birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }
    
    function getBirthPlace () 
    {
        return $this->birthPlace;
    }
    
    function setBirthDate (string $birthDate)
    {
        $this->birthDate = new DateTime($birthDate);
    }
    function getBirthDate (bool $showFormat = null)
    {
        if($this->birthDate)
        {
            $format = "y-m-d";
            if($showFormat)
               $format = "m/d/y";
                
            return $this->birthDate->format($format);
        }
        else 
            return NULL;
    }
    
    function setBio (string $bio)
    {
        $this->bio = $bio;
    }
    function getBio () 
    {
        return $this->bio;
    }
    
    function setGenre (string $genre)
    {
        $this->genre = $genre;
    }
    function getGenre ()
    {
        return $this->genre;
    }
      
    function validateInfo(&$fn, &$ln, &$bp, &$bd)
    {
        if (ctype_alpha($this->firstName)) 
        {
            strtolower($this->firstName);
            ucfirst($this->firstName);
            $fn=true;
        } else $fn = false;
        
        if (ctype_alpha($this->lastName)) 
        {
            strtolower($this->lastName);
            ucwords($this->lastName);
            $ln=true;
        } else $ln = false;
        
        if (ctype_alpha($this->birthPlace))
        {
            strtolower($this->birthPlace);
            ucwords($this->birthPlace);
            $bp=true;
        } else $bp = false;
        
        
        if(ctype_digit($this->birthDate))
        {
            date_format($this->birthDate, 'DD/MM/YYYY');
            if($this->birthDate <= mktime(0,0,0,1,1,2000))
            {
                $bd = true;
            } else $bd = false;
        } else $bd = false;
        
    }
    
    
}















