<?php
/**
 * @author gruppo 2
 */
class FSong {

    static function storeSong(mysqli &$db, ESong $song)
    {
		$sql = "INSERT INTO song(name, artist, genre, forall, registered, supporters) 
				VALUES(':name',':artist',':genre',':forall',':registered',':supporters')";
		$stmt = $db->prepare($sql);
		
		$name = $song->getName();
		$stmt->bindValue(':name', $name);
		$artist = $song->getArtist();
		$stmt->bindValue(':artist', $artist);
		$genre = $song->getGenre();
		$stmt->bindValue(':genre', $genre);
		$forall = (int) $song->isForAll();
		$stmt->bindValue(':forall', $forall);
		$registered = (int) $song->isForRegisteredOnly();
		$stmt->bindValue(':registered', $registered);
		$supporters = (int) $song->isForSupportersOnly();
		$stmt->bindValue(':supporters', $supporters);
		
		$stmt->execute();
		
		//manca il controllo errori
		//da testare
        if (! $result = $stmt) {
            die('There was an error running the query [' . $db->error . ']');
            return false;
        }
        else 
            return true;
    }
	
	static function updateSong(mysqli &$db, ESong $song){
		// inserire un controllo con la ESong già presente facendo un load (?)
		// la update va fatta con le pdo una volta aggiornato tutto
}
    
