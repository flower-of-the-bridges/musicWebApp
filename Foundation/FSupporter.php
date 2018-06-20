<?php

/**
 * @author gruppo 2
 */
class FSupporter {
    
    /**
     * Salva un ESupporter nel db
     * @return string la stringa sql per la STORE
     */
    static function storeSupporter() : string
    {
        return "INSERT INTO supporter(id, id_supporter, expiration_date)
                VALUES (:id, :id2, :expirationDate);";
    }
    
    
    /**
     * Rimuove un follower
     * @return string la stringa sql per la DELETE
     */
    static function removeSupporter() : string
    {
        return "DELETE FROM supporter
                WHERE id = :id AND id_supporter = :id2 ; ";
    }
    
    static function updateSupporter() : string
    {
    
        return "UPDATE supporter
                SET id_artist = :id,
                    id_supporter = :id2,
                    expiration_date = :expirationDate
                WHERE id_artist = :id1 AND id_support = :id2;";
                    
        
    }
    
    
    
    
    /**
     * Controlla se un utente sta seguendo un altro utente
     * @return string la stringa sql pe l'EXISTS
     */
    static function existsSupporter() : string
    {
        return        "SELECT *
                       FROM supporter
                       WHERE id = :value AND id_supporter= :value2 ; ";
    }
    
    /**
     * Associa ad uno statement PDO gli attributi di un oggetto EFollower
     * @param PDOStatement $stmt lo statement contenente i campi da associare
     * @param EFollower $supporter l'oggetto da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESupporter &$supporter)
    {
        $stmt->bindValue(':id', $supporter->getArtist()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id2', $supporter->getSupport()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':expirationDate', $supporter->getExpirationData(), PDO::PARAM_STR);
    }
    
}
