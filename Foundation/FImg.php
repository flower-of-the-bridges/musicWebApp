<?php

/**
 * La classe FImg fornisce le query sql rispetto alla classe EImg.
 * @author gruppo 2
 * @package Follower
 */
class FImg
{
    /**************************************   QUERY   ******************************************/
    
    /**
     * Salva una EImg nel database.
     * @return string la query sql
     */
    static function storeImg() : string
    {
        return "INSERT INTO `image`(`id`, `size`, `type`, `img`)
                VALUES (:id, :size, :type, :img)";
    }
    
    /**
     * Recupera una immagine dal database.
     * @return string la query sql.
     */
    static function loadImg() : string
    {
        return "SELECT *
                FROM image
                WHERE id = :id";
    }
    
    /**
     * Aggiorna una EImg nel database
     * @return string la query sql
     */
    static function updateImg() : string
    {
        return "UPDATE image
                SET size= :size, type= :type, img= :img
                WHERE id= :id ;";
    }
    
    /**
     * Rimuove una EImg dal database
     * @return string la query sql
     */
    static function removeImg() : string
    {
        return " DELETE
                 FROM image
                 WHERE id= :id ;"; //query sql
    }
    
    /*******************************   BIND MODEL - TUPLE **************************************/
    
    /**
     * Associa ai campi di una query gli attributi di un oggetto EImg
     * @param PDOStatement $stmt lo statement che definisce la query
     * @param EImg $img l'oggetto da associare alla query
     */
    static function bindValues(PDOStatement &$stmt, EImg &$img)
    {
        $stmt->bindValue(':id',$img->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':size',$img->getSize(), PDO::PARAM_INT);
        $stmt->bindValue(':type',$img->getType(), PDO::PARAM_STR);
        $stmt->bindParam(':img',$img->getImg(), PDO::PARAM_LOB);
    }
    
    /**
     * Costruisce un oggetto EImg a partire da una tupla
     * @param array $row contenente i valori ricevuti dal db, indicizzati come nella table
     * @return EImg un oggetto EImg
     */
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