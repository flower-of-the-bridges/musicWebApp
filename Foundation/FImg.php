<?php

class FImg
{
    /**************************************   QUERY   ******************************************/
    
    static function storeImg() : string
    {
        return "INSERT INTO `image`(`id`, `size`, `type`, `img`)
                VALUES (:id, :size, :type, :img)";
    }
    
    static function loadImg() : string
    {
        return "SELECT *
                FROM image
                WHERE id = :id";
    }
    
    static function updateImg() : string
    {
        return "UPDATE image
                SET size= :size, type= :type, img= :img
                WHERE id= :id ;";
    }
    
    static function removeImg() : string
    {
        return " DELETE
                 FROM image
                 WHERE id= :id ;"; //query sql
    }
    
    /*******************************   BIND MODEL - TUPLE **************************************/
    
    static function bindValues(PDOStatement &$stmt, EImg &$img)
    {
        $stmt->bindValue(':id',$img->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':size',$img->getSize(), PDO::PARAM_INT);
        $stmt->bindValue(':type',$img->getType(), PDO::PARAM_STR);
        $stmt->bindParam(':mp3',$img->getImg(), PDO::PARAM_LOB);
    }
    
    static function createObjectFromRow($row) : EImg
    {
        $img = new EImg();
        $img->setId($row['id']);
        $img->setType($row['type']);
        $img->setSize($row['size']);
        $img->setImg($row['img']);
        return $img;
    }
}