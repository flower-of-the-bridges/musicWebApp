<?php
/**
 * @author gruppo 2
 */
class FSong {

    /**
     * Store a ESong to database
     * @param PDO $db the database
     * @param ESong $song the song to save
     * @return bool true if loading was successful, false otherwise
     */
    static function storeSong(PDO &$db, ESong $song) : bool
    {
        $sql = "INSERT INTO song(name, artist, genre, forall, registered, supporters)
				VALUES(:name,:artist,:genre,:forall,:registered,:supporters)";
       
        return FSong::execQuery($db, $sql, $song);
    }
    
    static function updateSong(PDO &$db, ESong $song){
        // inserire un controllo con la ESong già presente facendo un load (?)
        // la update va fatta con le pdo una volta aggiornato tutto
    }
    
    /**
     * Binds the query's values to the Esong's object attributes
     * @param PDOStatement $stmt the query statement to analyze
     * @param ESong $song the song to bind
     */
    private function bindValue(PDOStatement &$stmt, ESong &$song){
        $stmt->bindValue(':name', $song->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':artist', $song->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $song->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':forall', (int) $song->isForAll(), PDO::PARAM_INT);
        $stmt->bindValue(':registered', (int) $song->isForRegisteredOnly(), PDO::PARAM_INT);
        $stmt->bindValue(':supporters', (int) $song->isForSupportersOnly(), PDO::PARAM_INT);
    }
	
    /**
     * Commit query
     * @param PDO $db
     * @return bool
    */
    private function confirmChanges(PDO &$db) :bool 
    {
        if($db->commit()){
            return true;
        }
        else {
            $db->rollBack(); //elimino la transazione
            return false;
        }
    }
    
    
    /**
     * Execute a query
     * @param PDO $db the database
     * @param string $sql the sql query
     * @param ESong $song song object
     * @return boolean true if the execution was successful, false otherwise
     */
    private function execQuery(PDO &$db, string $sql, ESong &$song){
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            FSong::bindValue($stmt, $song);
        } catch (PDOException $e) {
                echo('Errore');
        }
        
        //si verifica se la query e' corretta e se il commit va a buon fine
        if (! $stmt->execute()) {
            die('There was an error running the query [' . $db->errorInfo()[0] .']');
            return false;
        }
        else{
            $song->setID($db->lastInsertId()); //assegno all'oggetto l'id del db.
            return FSong::confirmChanges($db);
            
        }
        
    }
	
}
    
