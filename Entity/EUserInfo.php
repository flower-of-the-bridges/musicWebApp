<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';


class EUserInfo extends EObject
{
    private $firstName;
    private $lastName;
    private $birthPlace;
    private $birthDate;
    private $bio;
    private $imgID;
    private $genre;
    
    function __construct()
    {
        parent::__construct();
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
    
    function setImgId (int $imgID)
    {
        $this->imgID = $imgID;
    }
    function getImgId () : int
    {
        return $this->imgID;
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















