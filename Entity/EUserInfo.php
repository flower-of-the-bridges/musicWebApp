<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

//this class is made to be a container for all the
//informations about the users that are not crucial or necessary
/**
 * La classe EUserInfo e' pensata per contenere tutte le informazioni sull'utente che non 
 * sono necessarie in fase di autenticazione/registrazione/ricerca. Proprio per questo, estende
 * la classe EObject avendo come id lo stesso identificativo dell'utente a cui appartengono.
 * @author gruppo2
 * @package Entity
 */
class EUserInfo extends EObject
{
    /** il nome dell'utente */
    private $firstName;         //the first name of the user
    /** il cognome dell'utente */
    private $lastName;          //the last name of the user
    /** il luogo di nascita dell'utente */
    private $birthPlace;        //the birth place of the user    
    /** la data di nascita dell'utente */
    private $birthDate;         //the birth date of the user    
    /** la biografia dell'utente */
    private $bio;               //a self made introduction of the user himself
    /** il genere musicale dell'utente */
    private $genre;             //the generated genre of this user
    
    /**
     * Costruisce un oggetto EUserInfo vuoto.
     */
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
    
    
    /**
     * Costruisce il genere musicale dell'utente a partire dalle canzoni passate alla funzione.
     * @param array $song contenente oggetti ESong da cui ricavare il genere | NULL se nessuna canzone e' presente
     */
    function generateGenre(&$songs)
    {
        $this->genre = ''; // il genere viene azzerato
        
        if ($songs) // se ci sono canzoni
        {            
            foreach ($songs as $song)  // per ogni canzone...
            {
                $songGenre = $song->getGenre(); // ricava il genere
                
                if (! preg_match('/\b' . $songGenre . '\b/', $this->genre)) // verifica che il genere non sia gia stato inserito
                    $this->genre .= $songGenre . " "; // aggiunge il valore al genere
            }
        }
    }

    
    /**
     * 
     * @param string $firstName il nome dell'utente
     */
    function setFirstName (string $firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * 
     * @return string il nome dell'utente
     */
    function getFirstName () 
    {
        return $this->firstName;
    }
    
    /**
     * 
     * @param string $lastname il cognome dell'utente
     */
    function setLastName (string $lastname)
    {
        $this->lastName = $lastname;
    }
    
    /**
     * 
     * @return string il cognome dell'utente
     */
    function getLastName () 
    {
        return $this->lastName;
    }
    
    /**
     * 
     * @param string $birthPlace il luogo di nascita
     */
    function setBirthPlace (string $birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }
    
    /**
     * 
     * @return string il luogo di nascita
     */
    function getBirthPlace () 
    {
        return $this->birthPlace;
    }
    
    /**
     * 
     * @param string $birthDate la data di nascita
     */
    function setBirthDate (string $birthDate)
    {
        $this->birthDate = new DateTime($birthDate);
    }
    
    /**
     * Restituisce la data di nascita dell'utente
     * @param bool $showFormat (opzionale) imposta la data nel formato di visualizzazione
     * @return string contenente la data in formato y-m-d (m/d/y se il campo bool e' true) e' specificata | NULL altrimenti
     */
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
    
    /**
     * 
     * @param string $bio la biografia dell'utente
     */
    function setBio(string $bio)
    {
        $this->bio = $bio;
    }
    
    /**
     * 
     * @return string la biografia dell'utente
     */
    function getBio() 
    {
        return $this->bio;
    }
    
    /**
     * 
     * @param string $genre il genere musicale
     */
    function setGenre (string $genre)
    {
        $this->genre = $genre;
    }
    
    /**
     * 
     * @return string il genere musicale
     */
    function getGenre ()
    {
        return $this->genre;
    }
      
    /**
     * Controlla che i dati dell'oggetto siano validi. I valori booleani passati per riferimento
     * saranno true o false a seconda se il dato attributo sia valido o meno.
     * @param bool $fn controllo del primo nome
     * @param bool $ln controllo del cognome
     * @param bool $bp controllo del luogo di nascita
     * @param bool $bd controllo della data di nascita
     * @param bool $bio controllo della biografia
     */
    function validate(bool &$fn, bool &$ln, bool &$bp, bool &$bd, bool $bio)
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
        
        if (preg_match("/^(\p{L})|([a-zA-Z0-9][a-zA-Z0-9 -])+$/ui", $this->description)) // solo lettere, numeri e spazi
            $bio = true;
        else 
            $bio = false;
    }
    
    
}















