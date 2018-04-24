<?php
/**
 * @author gruppo 2
 */
class FSong {

    static function storeSong(PDO &$db, ESong $song)
    {
		$db->beginTransaction(); //inizio della transazione
        $sql = "INSERT INTO song(name, artist, genre, forall, registered, supporters) 
				VALUES(:name,:artist,:genre,:forall,:registered,:supporters)";
		$stmt = $db->prepare($sql); 
		//si prepara la query facendo un bind tra parametri e variabili dell'oggetto

		$stmt->bindValue(':name', $song->getName(), PDO::PARAM_STR);
	
		$stmt->bindValue(':artist', $song->getArtist(), PDO::PARAM_STR);
		$stmt->bindValue(':genre', $song->getGenre(), PDO::PARAM_STR);
		$stmt->bindValue(':forall', (int) $song->isForAll(), PDO::PARAM_INT);
		$stmt->bindValue(':registered', (int) $song->isForRegisteredOnly(), PDO::PARAM_INT);
		$stmt->bindValue(':supporters', (int) $song->isForSupportersOnly(), PDO::PARAM_INT);
		//si verifica se la query e' corretta e se il commit va a buon fine
		if (! $stmt->execute()) { 
            die('There was an error running the query [' . $db->errorCode(). ']');
            return false;
        }
        else{
            $db->commit();
            return true;
        }
    }
	
	static function updateSong(mysqli &$db, ESong $song){
		// inserire un controllo con la ESong già presente facendo un load (?)
		// la update va fatta con le pdo una volta aggiornato tutto
	}
}
    
