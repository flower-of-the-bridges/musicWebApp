<?php

class FMp3
{
    /**************************************   QUERY   ******************************************/
    
    static function storeMp3() : string
    {
        return "INSERT INTO `mp3`(`id_song`, `size`, `type`, `mp3`) 
                VALUES (:id,:size,:type,:mp3)";
    }
    
    static function loadMp3() : string
    {
        return "SELECT *
                FROM mp3
                WHERE id_song = :id";
    }
    
    /*******************************   BIND MODEL - TUPLE **************************************/
    
    static function bindValues(PDOStatement &$stmt, EMp3 &$mp3)
    {
        $stmt->bindValue(':id',$mp3->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':size',$mp3->getSize(), PDO::PARAM_INT);
        $stmt->bindValue(':type',$mp3->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3',$mp3->getMp3(), PDO::PARAM_LOB);
    }
    
    static function createObjectFromRow($row)
    {
        
    }
}

