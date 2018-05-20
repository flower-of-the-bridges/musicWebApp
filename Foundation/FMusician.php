<?php

/**
 * La classe FMusician consente di prelevare tramite i suoi metodi statici le informazioni
 * di un musicista: tali informazioni possono essere relative all'utente che sta visitando 
 * il sito oppure di un musicista di cui l'utente vuole ottenere informazioni. 
 * @author gruppo 2
 */
 
class FMusician{
    
    /**
     * 
     * @return string
     */
    static function storeMusician() : string 
    {
        return "INSERT INTO musician(id, nickname) 
                VALUES (:id,:nickname);";
    }
    
    /**
     * 
     * @return string
     */
    static function updateMusician() : string
    {
        return "UPDATE musician
                SET nickname = :nickname, genre = :genre
                WHERE id = :id;";
    }
    
    /**
     * 
     * @return string
     */
    static function loadMusician() : string
    {
        return "SELECT *    
                FROM musician
                WHERE id = :id;";
    }
    
    /**
     * 
     * @return string
     */
    static function removeMusician() : string 
    {
        return "DELETE 
                FROM song
                WHERE id = :id;";
    }
    
    static function searchMusicianByName() : string
    {
        return "SELECT *
                FROM musician
                WHERE nickname = :Name;";
    }
    
    static function searchMusicianByGenre() : string
    {
        return "SELECT *
                FROM musician
                WHERE LOCATE( :Genre , genre) > 0;";
    }
    
    /**
     * 
     * @param PDOStatement $stmt
     * @param EMusician $mus
     */
    static function bindValues(PDOStatement &$stmt, EMusician &$mus)
    {
        $stmt->bindValue(':id', $mus->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nickname', $mus->getName(), PDO::PARAM_STR); 
        
        if($mus->getGenre()!=NULL)
            $stmt->bindValue(':genre', $mus->getGenre(), PDO::PARAM_STR);
        
    }
    
    /**
     * 
     * @param array $row
     * @return EMusician
     */
    static function createObjectFromRow($row) : EMusician
    {
        $mus = new EMusician();
        $mus->setId($row['id']);
        $mus->setName($row['nickname']);
        $mus->setGenre($row['genre']);
        
        return $mus;
    }
}
