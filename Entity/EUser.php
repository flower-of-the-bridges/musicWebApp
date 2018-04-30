<?php
use Entity\EObject;

/**
 * @author gruppo 2
 * Super Class for users
 */
class EUser extends EObject{
    
    protected 	$name; //il nome dell'utente
    private 	$password; //la password dell'utente
    protected 	$birthDate; //la data di nascita dell'utente
    protected 	$followers; // i follower dell'utente
    
    function __construct(string $user=null, DateTime $birthDate=null) {
        $this->name = $user;
        $this->birthDate = $birthDate;
        $this->followers = array();
    }
    
    function getBirthDate() {
        return $this->birthDate;
    }

    function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    function getName() {
        return (string) $this->name;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function setName(string $name){
        $this->name=$name;
    }
    
    function setPassword(string $pass){
        $this->password=md5($pass); //cripta la password inserita dall'utente come hash
    }
    
    /**
     * Viene aggiunto un utente alla lista dei follower. 
     * @param EUser $user
     * @return boolean
     */
    function addFollower(EUser &$user){
        if($this->user!=$user){
            //viene caricata nella struttura dati una versione ridotta
            $reducedUser=new EUser($user->getName()); 
            $reducedUser->setId($user->getId());
            $this->followers[]=$user;
            return true;
        }
        else return false;
    }
    
    function numberOfFollowers() : int {
        return count($this->followers);
    }

}
