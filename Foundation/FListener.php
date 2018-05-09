<?php


/**
 * @author gruppo 2
 */
class FListener {
    
/************************************** QUERY *************************************************/     
    /**
     * Aggiunge un utente Listener al database
     * @param PDO $db la connessione al dbms
     * @param EListener $listener l'utente Listener da salvare
     * @return bool l'esito dell'operazione
     */
    static function storeListener(PDO &$db, EListener &$listener) : string
    {
        return "INSERT INTO user(name, password, email, birthDate, type)
				VALUES(:name,:password,:email, :birthdate, listener)";
    }
    
    /**
     * Rimuove un utente Listener dal database.
     * @param int $id dell'utente Listener da eliminare
     * @return bool l'esito dell'operazione
     */
    static function removeListener(int $id) : bool 
    {
        return " delete  from user where id= :id ;"; //query sql
    }
    
    static function updateListener(PDO &$db, EListener &$listener) : bool{
        $sql = "UPDATE user 
                SET name= :name, password= :password, email= :email, birthDate= :birthDate 
                WHERE id= :id";
    }
    
    static function loadListener() : string {
       return "select * from song where id= :id ;"; //query sql
    }
    
    static function bindValues(PDOStatement $stmt, EListener $obj)
    {
        $stmt->bindValue(':name', $obj->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $obj->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':birthDate', $obj->getBirthDate(), PDO::PARAM_STR);
    }
   
}
