<?php


class FSupInfo

{
    
    
    /******************************************* QUERY ********************************************/
    
    /**
     * Salva una ESong nel database
     * @param PDO $db la connessione verso il dbms
     * @return string la query sql da eseguire
     */
    static function storeSupInfo() : string
    {
        return "INSERT INTO support_info(id_artist, contribute, period)
				VALUES(:id, :contribute, :period)";
    }
    
    /**
     * Carica una canzone dal database e la salva in un oggetto ESong.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id della canzone
     * @return object string la query sql da eseguire
     */
    static function loadSupInfo( ) : string
    {
        return "SELECT *
                FROM support_info
                where id_artist= :id ;"; //query sql
    }
    
 
    /**
     * Aggiorna i dati di una canzone
     * @param PDO $db, ESONG $song
     */
    static function updateSupInfo() : string
    {
        return "UPDATE support_info
                SET id_artist= :id , contribute= :contribute , period= :period
                WHERE id_artist= :id ;";
    }
    
    
    
    
    /***************************** METODI ASSOCIAZIONI ENTITY - TUPLE *****************************/
    
    /**
     * Associa ai campi della query i corrispondenti attributi dell'oggetto ESong.
     * @param PDOStatement $stmt da cui prelevare i campi
     * @param ESong $obj da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESupInfo &$obj)
    {
        $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':contribute', $obj->getContribute(), PDO::PARAM_STR);
        $stmt->bindValue(':period', $obj->getPeriod(), PDO::PARAM_INT);
        
    }
    
    /**
     * Istanzia un oggett ESong a partire dai valori di una tupla ricevuta dal dbms
     * @param array $row la tupla ricevuta dal dbms
     * @return ESong l'oggetto ESong risultato dell'operazione
     */
    static function createObjectFromRow($row)
    {
        // istanzia il musicista autore dell'artista
        $supInfo = new ESupInfo();
        $supInfo->setId($row['id_artist']);
        $supInfo->setContribute($row['contribute']);
        $supInfo->setPeriod($row['period']);
        
        return $supInfo;
    }



    

}

