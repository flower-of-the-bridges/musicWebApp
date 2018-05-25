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
        return "INSERT INTO supporter
                VALUES :id, :id2, :expirationDate, :renewal;";
    }
    
    /**
     * Carica i follower di un utente in un array di EUser
     * @return string la stringa sql per la SELECT
     */
    static function loadSupporters() : string
    {
        return "SELECT users.*
                FROM supporter, users
                WHERE supporter.id_artist = :id AND supporter.id_supporter = users.id ; ";
    }
    
    /**
     * Carica i following di un utente in un array di EUser
     * @return string la stringa sql per la SELECT
     */
    static function loadSupporting() : string
    {
        return "SELECT users.*
                FROM supporter, users
                WHERE supporter.id_user = :id AND supporter.id_supporter = users.id;";
    }
    
    /**
     * Rimuove un follower
     * @return string la stringa sql per la DELETE
     */
    static function removeSupporter() : string
    {
        return "DELETE FROM supporter
                WHERE id_artist = :id AND id_supporter = :id2 ; ";
    }
    
    static function updateSupporter() : string
    {
    
        return "UPDATE supporter
                SET id_artist = :id,
                    id_supporter = :id2,
                    expiration_date = :expirationDate,
                    renewal = :renewal
                WHERE id_artist = :id1 AND id_support = :id2;";
                    
        
    }
    
    
    
    
    /**
     * Controlla se un utente sta seguendo un altro utente
     * @return string la stringa sql pe l'EXISTS
     */
    static function existsSupporter() : string
    {
        return "EXISTS(SELECT *
                       FROM supporter
                       WHERE id_artist = :value AND id_supporter= :value2 ; ";
    }
    
    /**
     * Associa ad uno statement PDO gli attributi di un oggetto EFollower
     * @param PDOStatement $stmt lo statement contenente i campi da associare
     * @param EFollower $supporter l'oggetto da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESupporter &$supporter)
    {
        $stmt->bindValue(':id', $supporter->getArtist()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':id2', $supporter->getSupport()->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':expirationDate', $supporter->getExpirationData(), PDO::PARAM_STR);
        $stmt->bindValue(':renewal', $supporter->getRenewal(), PDO::PARAM_BOOL);
    }
    
}
