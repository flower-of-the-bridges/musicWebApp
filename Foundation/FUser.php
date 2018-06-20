<?php

/**
 * La classe FUser fornisce query per gli oggetti EUser
 * @author gruppo2
 * @package Foundation
 */
class FUser
{
    /**
     * Query che verifica l'esistenza di un nickname nella table users
     * @return string contenente la query sql
     */
    static function existsNickName() : string
    {
        return " SELECT *
                 FROM users
                 WHERE nickname = :value ;";
    }
    
    /**
     * Query che verifica l'esistenza di una mail nella table users
     * @return string contenente la query sql
     */
    static function existsMail() : string
    {
        return "SELECT *
                FROM users
                WHERE mail = :value ;";
    }
    
    /**
     * Query che effettua il salvataggio di un utente nella table users
     * @return string contenente la query sql
     */
    static function storeUser() : string
    {
        return "INSERT INTO users(nickname, password, type, mail)
                VALUES (:nickname, :password, :type, :mail);";
    }
    
    /**
     * Query che effettua l'aggiornamento di un utente nella table users
     * @return string contenente la query sql
     */
    static function updateUser() : string
    {
        return "UPDATE users
                SET nickname = :nickname, password = :password, type = :type, mail = :mail
                WHERE id = :id;";
    }
    
    /**
     * Query per il caricamento di un utente
     * @return string sql rappresentante la SELECT.
     */
    static function loadUser() : string
    {
        return "SELECT *
                FROM users
                WHERE id = :id;";
    }
    
    /**
     * Carica i follower di un utente in un array di EUser
     * @return string la stringa sql per la SELECT
     */
    static function loadFollowers() : string
    {
        return "SELECT users.*
                FROM followers, users
                WHERE followers.id_user = :id AND followers.id_user = users.id ; ";
    }
    
    /**
     * Carica i following di un utente in un array di EUser
     * @return string la stringa sql per la SELECT
     */
    static function loadFollowing() : string
    {
        return "SELECT users.*
                FROM followers, users
                WHERE followers.id_follower = :id AND followers.id_follower = users.id;";
    }
    
    /**
     * Query che rimuove un utente dalla table users.
     * @return string contenente la query sql
     */
    static function removeUser() : string
    {
        return "DELETE
                FROM users
                WHERE id = :id;";
    }
    
    /**
     * Query che seleziona dalla table users degli utenti in base al nome
     * @return string la query sql
     */
    static function searchUserByName() : string
    {
        return "SELECT *
                FROM users
                WHERE LOCATE( :Name , nickname) > 0;";
    }
    
    /**
     * Query che seleziona dalla table users degli utenti in base al genere
     * @return string la query sql
     */
    static function searchUserByGenre() : string
    {
        return "SELECT users.* 
                FROM users, usersInfo
                WHERE LOCATE( :Genre , genre) > 0 AND usersInfo.id = users.id;";
    }
    
    /**
     * Associazione di un oggetto EUser ai campi di una query sql per la table users.
     * @param PDOStatement $stmt lo statement contenente i campi da riempire
     * @param EUser $user l'utente da cui prelevare i dati
     */
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