<?php
/**
 * @author gruppo 2
 */
class FSong {
    
    private $blob; //momentaneamente utilizzato per upload statico di mp3

/******************************************* QUERY ********************************************/
    
    /**
     * Salva una ESong nel database
     * @param PDO $db la connessione verso il dbms
     * @return string la query sql da eseguire
     */
    static function storeSong() : string
    {
        return "INSERT INTO song(name, artist, genre, mp3, forall, registered, supporters)
				VALUES(:name,:artist,:genre, :mp3, :forall, :registered,:supporters)";
    }
        
    /**
     * Carica una canzone dal database e la salva in un oggetto ESong.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id della canzone
     * @return object string la query sql da eseguire
     */
    static function loadSong( ) : string
    {
        return "select * from song where id_song= :id ;"; //query sql
    }
    
    /**
     * Carica dal database canzoni di un certo utente.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id dell'utente a cui appartengono le canzoni
     * @return string la query sql da eseguire
     */
    static function loadMusicianSongs() : string
    {
        return "select * from song where id_artist= :id ;"; //query sql
    }
    
    /**
     * Aggiorna i dati di una canzone
     * @param PDO $db, ESONG $song
     */
    static function updateSong() : string
    {
        $sql = "UPDATE song
                SET name= :name, genre= :genre, forall= :forall, registered= :registered, supporters= :supporters
                WHERE id_artist= :id";
    }
    
    /**
     * Elimina una canzone dal db .
     * @param PDO $db la connessione al dbms
     * @param int $id la canzone da eliminare
     */
    static function removeSong(PDO &$db, int $id) : string
    {
        return " delete  from song where ID= :id ;"; //query sql
    }
    
    /**
     * Cancella tutte le entry di una query. Usata a scopo di debug.
     * @param PDO $db
     */
    static function emptyTable (PDO &$db)
    {
        $db->beginTransaction();                         //inizio transazione
        
        $stmt = $db->prepare("TRUNCATE TABLE song;");    //prepara lo statement
        
        $stmt->execute();
        
        $db->commit();    
    }
    
/***************************** METODI ASSOCIAZIONI ENTITY - TUPLE *****************************/
    
    /**
     * Associa ai campi della query i corrispondenti attributi dell'oggetto ESong.
     * @param PDOStatement $stmt da cui prelevare i campi
     * @param ESong $obj da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESong &$obj) 
    {
        $stmt->bindValue(':name', $obj->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':id_artist', $obj->getArtist()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':genre', $obj->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3', $obj->getMp3(), PDO::PARAM_LOB);
        $stmt->bindValue(':forall', (int) $obj->isForAll(), PDO::PARAM_INT);
        $stmt->bindValue(':registered', (int) $obj->isForRegisteredOnly(), PDO::PARAM_INT);
        $stmt->bindValue(':supporters', (int) $obj->isForSupportersOnly(), PDO::PARAM_INT);
    }
    
    /**
     * Istanzia un oggett ESong a partire dai valori di una tupla ricevuta dal dbms
     * @param array $row la tupla ricevuta dal dbms
     * @return ESong l'oggetto ESong risultato dell'operazione
     */
    static function createObjectFromRow($row)
    {
        $musician = FPersistantManager::getInstance()->load('Musician', $row[id_artist]); // istanzia il musicista autore dell'artista
        $song = new ESong($row ['id_song'], $row['name'], $musician, $row['genre']); // creazione dell'oggetto Esong
        
        //impostazione visibilita'.
        if ($rows['forall']) $song->setForAll();
        elseif ($rows['registered']) $song->setForRegisteredOnly();
        elseif ($rows['supporters']) $song->setForSupportersOnly();
        else $obj->setHidden();
        return $song; // restituisce la canzone
    }      
}
    
