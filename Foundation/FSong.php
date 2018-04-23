<?php
/**
 * @author gruppo 2
 */
class FSong {

    static function storeSong(mysqli &$db, ESong $song)
    {
        $sql = "INSERT INTO `song`(`name`, `artist`, `genre`, `forall`, `registered`, `supporters`) VALUES ";
        $sql.= "('" . $song->getName() . "','" . $song->getArtist() . "','" .
                      $song->getGenre() . "'," . (int) $song->isForAll() . "," . 
                      (int) $song->isForRegisteredOnly() . "," . 
                      (int) $song->isForSupportersOnly() . ");";
        if (! $result = $db->query($sql)) {
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
    
