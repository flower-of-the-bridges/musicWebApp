<?php
namespace Foundation;

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
    
    static function bindValues(\PDOStatement &$stmt)
    {
        
    }
    
    static function createObjectFromRow($row)
    {
        
    }
}

