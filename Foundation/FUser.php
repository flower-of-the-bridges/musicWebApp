<?php


class FUser
{
    
    static function existsNickName() : string
    {
        return " SELECT *
                 FROM users
                 WHERE nickname = :value ;";
    }
    
    static function existsMail() : string
    {
        return "SELECT *
                FROM users
                WHERE mail = :value ;";
    }
    
    static function existsUser() : string
    {
        return "SELECT *
                FROM users
                WHERE nickname = :value AND password = :value2;";
    }
    
    static function storeUser() : string
    {
        return "INSERT INTO users(nickname, password, type, mail)
                VALUES (:nickname, :password, :type, :mail);";
    }
    
    static function updateUser() : string
    {
        return "UPDATE users
                SET nickname = :nickname, password = :password, type = :type, mail = :mail
                WHERE id = :id;";
    }
    
    static function loadUser() : string
    {
        return "SELECT *
                FROM users
                WHERE id = :id;";
    }
    
    static function removeUser() : string
    {
        return "DELETE
                FROM users
                WHERE id = :id;";
    }
    
    static function searchUserByName() : string
    {
        return "SELECT *
                FROM users
                WHERE nickname = :Name;";
    }
    
    
    
    static function bindValues(PDOStatement &$stmt, EUser &$user)
    {
        $stmt->bindValue(':nickname', $user->getNickName(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $stmt->bindValue(':type', lcfirst(substr(get_class($user),1)), PDO::PARAM_STR);
    }
    
    /**
     * Crea una Entity da una row del database
     * @param array $row avente come indici i campi della table da cui e' stata prelevata l'entry
     * @return EListener | EMusician | EModerator
     */
    static function createObjectFromRow($row) 
    {
        $uType = 'E'.ucfirst($row['type']); // costruisce la classe da cui istanziare l'oggetto 
  
        $user = new $uType();
        
        $user->setId($row['id']);
        $user->setNickName($row['nickname']);
        $user->setPassword($row['password']);
        $user->setMail($row['mail']);
        
        return $user;
    }
    
    
}