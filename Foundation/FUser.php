<?php


class FUser
{
    
    static function existUserName() : string
    {
        return "EXISTS(SELECT *
                      FROM users
                      WHERE nickname = :value;)";
    }
    
    static function existUserMail() : string
    {
        return "EXISTS(SELECT *
                      FROM users
                      WHERE mail = :value;)";
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
        $stmt->bindValue(':nickname', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $user->getType(), PDO::PARAM_STR);
    }
    
    static function createObjectFromRow($row) : EUser
    {
        $user = new EUser();
        $user->setId($row['id']);
        $user->setName($row['nickname']);
        $user->setPassword($row['password']);
        $user->setMail($row['mail']);
        $user->setType($row['type']);
        
        return $user;
    }
    
    
}