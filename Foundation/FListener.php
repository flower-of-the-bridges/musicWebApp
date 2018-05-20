<?php


/**
 * @author gruppo 2
 */
class FListener {
    
/************************************** QUERY *************************************************/     
    /**
     * Aggiunge un utente Listener al database
     * @return string la query da inviare al database
     */
    static function storeListener() : string
    {
        return "INSERT INTO listener(:id, :nickname)
				VALUES(:id, :name);";
    }
    
    /**
     * Rimuove un utente Listener dal database.
     * @return string la query da inviare al database
     */
    static function removeListener() : bool 
    {
        return " DELETE
                 FROM listener 
                 WHERE id= :id ;"; //query sql
    }
    
    /**
     * Aggiorna un utente Listener nel database
     * @return string la query da inviare al database
     */
    static function updateListener(PDO &$db, EListener &$listener) : bool
    {
        $sql = "UPDATE listener
                SET nickname= :nickname
                WHERE id= :id";
    }
    
    /**
     * Carica dal database un utente EListener
     * @return string la query da inviare al database
     */
    static function loadListener() : string 
    {
       return "SELECT * 
               FROM listener
               WHERE id= :id ;"; //query sql
    }
    
/****************************** ASSOCIAZIONI QUERY - TUPLE ************************************/
    
    /**
     * Associa ai parametri di uno statement gli attributi di un oggetto EListener
     * @param PDOStatement $stmt
     * @param EListener $obj
     */
    static function bindValues(PDOStatement $stmt, EListener $obj)
    {
        $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $obj->getName(), PDO::PARAM_STR);

    }
   
    /**
     * Associa ad un oggetto EListener i risultati di una tupla
     * @param array $row la tupla ricevuta dal database
     * @return EListener l'oggetto EListener risultato dell'operazione
     */
    static function createOBjectFromRow($row) : EListener 
    {
        $list = new EListener(); //creazione dell'oggetto EListener
        $list->setId($row['id']);
        $list->setName($row['nickname']);
    }
}
