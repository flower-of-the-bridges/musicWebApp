<?php
require_once 'inc.php';
include_once 'Entity/EObject.php';

//This is the EUser Class, a class made to handle all 
//kind of users of the application,
//this is going to be the main class for every action performed

class EUser extends EObject
{
    private $nickname;
    private $mail;
    private $password;
    private $type;
    
    private $userInfo; // le informazioni dell'utente
    private $img; // le immagini dell'utente 
    private $supInfo; // le informazioni per il supporto dell'utente (se musicista)
        
    function __construct()
    {
        parent::__construct();
    }
    
    function isStringOk(string $toCheck) : bool
    {          
        if( !preg_match('/^[a-zA-Z0-9_-]{8,32}$/', $toCheck) )
            {return false;}
        return true;
    }
    
    function validateMail(string $tc) : string
    {
        return filter_var($tc, FILTER_VALIDATE_EMAIL);        
    }
    
    
    function hashPwd (string $pwd) : string
    {
        return password_hash($pwd, PASSWORD_DEFAULT);
    }
    
    function validatePwd (string $pwd) : bool
    {
        return password_verify($pwd, FPersistantManager::getInstance()->load(EUser::class, $this->id)->getPassword());
    }
    
    
    function getName () : string
    {
        return $this->nickname;
    }
    
    function setName (string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * Restituisce le info dell'utente
     * @return EUserInfo|NULL
     */
    function getUserInfo()
    {
        $this->userInfo = FPersistantManager::getInstance()->load(EUserInfo::class, $this->id); 
        return $this->userInfo;
    }
    
    /**
     * Imposta le informazioni dell'utente
     * @param EUserInfo $info
     */
    function setUserInfo(EUserInfo $info)
    {
        $info->setId($this->id);
        
        if(!FPersistantManager::getInstance()->load(EUserInfo::class, $this->id)) // se le informazioni non sono presenti...
        { //vengono caricate nel db
            FPersistantManager::getInstance()->store($info);
        }
        else 
        { //altrimenti vengono aggiornate
            FPersistantManager::getInstance()->update($info);
        }
        
        $this->userInfo = $info;
    }
    
    /**
     * Restituisce l'immagine dell'utente
     * @return EImg | NULL
     */
    function getImage()
    {
        $this->img = FPersistantManager::getInstance()->load(EImg::class, $this->id);
        return $this->img;
    }
    
    /**
     * Imposta l'immagine dell'utente
     * @param EImg $img
     */
    function setImage(EImg $img)
    {
        $img->setId($this->id);
        
        if(!FPersistantManager::getInstance()->load(EImg::class, $this->id)) // se le informazioni non sono presenti...
        { // vengono salvate nel db
            FPersistantManager::getInstance()->store($img); 
        }
        else
        { // altrimenti vengono aggiornate
            FPersistantManager::getInstance()->update($img);
        }
        
        $this->img = $img;
    }
    
    /**
     * Restituisce le informazioni sul supporto dell'utente (di tipo musicista)
     * @return ESupInfo | NULL
     */
    function getSupportInfo()
    {
        $this->supInfo = FPersistantManager::getInstance()->load(ESupInfo::class, $this->id);
        return $this->supInfo;
    }
    
    /**
     * Imposta le informazioni sul supporto dell'utente (di tipo musicista)
     * @param ESupInfo $supInfo
     */
    function setSupportInfo(ESupInfo $supInfo)
    {
        $supInfo->setId($this->id);
        
        if(!FPersistantManager::getInstance()->load(ESupInfo::class, $this->id))
        {
            FPersistantManager::getInstance()->store($supInfo);
        }
        else
        {
            FPersistantManager::getInstance()->update($supInfo);
        }
        
        $this->supInfo = $supInfo;
    }
    
    
    function getType () : string
    {
        return $this->type;
    }
    
    function setType (string $type)
    {
        $this->type = $type;
    }
    
    function getPassword () : string
    {
        return $this->password;
    }
    function setPassword (string $pwd)
    {
        $this->password = $pwd;
    }
    
    function getMail () : string
    {
        return $this->mail;
    }
    function setMail (string $mail)
    {
        $this->mail = $mail;
    }
    
    function __toString()
    {
        return "Nome: ".$this->nickname."\nTipo: ".$this->type."\nId: ".$this->id;
    }
    
}
