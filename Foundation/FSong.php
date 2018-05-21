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
        return "INSERT INTO song(id_artist, name, genre, forall, registered, supporters)
				VALUES(:id_artist, :name, :genre, :forall, :registered, :supporters)";
    }
        
    /**
     * Carica una canzone dal database e la salva in un oggetto ESong.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id della canzone
     * @return object string la query sql da eseguire
     */
    static function loadSong() : string
    {
        return "SELECT song.*, users.nickname
                FROM song, users
                where song.id= :id AND song.id_artist = users.id;"; //query sql
    }
    
    /**
     * Carica dal database canzoni di un certo utente.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id dell'utente a cui appartengono le canzoni
     * @return string la query sql da eseguire
     */
    static function loadMusicianSongs() : string
    {
        return "SELECT song.*, users.nickname
                FROM song, users
                where song.id_artist= :id AND song.id_artist = users.id;"; //query sql
    }
    
    /**
     * Aggiorna i dati di una canzone
     * @param PDO $db, ESONG $song
     */
    static function updateSong() : string
    {
        return "UPDATE song
                SET id_artist= :id_artist, name= :name, genre= :genre, forall= :forall, registered= :registered, supporters= :supporters
                WHERE id= :id ;";
    }
    
    /**
     * Elimina una canzone dal db .
     * @param PDO $db la connessione al dbms
     * @param int $id la canzone da eliminare
     */
    static function removeSong() : string
    {
        return " DELETE
                 FROM song 
                 WHERE id= :id ;"; //query sql
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
    
    static function searchSongByName() : string
    {
        return "SELECT song.*, users.nickname
                FROM song, users
                WHERE song.name = :Name AND song.id_artist = users.id;";
    }
    
    static function searchSongByGenre() : string
    {
        return "SELECT song.*, users.nickname
                FROM song, users
                WHERE song.genre = :Genre AND song.id_artist = users.id;";
    }
    
/***************************** METODI ASSOCIAZIONI ENTITY - TUPLE *****************************/
    
    /**
     * Associa ai campi della query i corrispondenti attributi dell'oggetto ESong.
     * @param PDOStatement $stmt da cui prelevare i campi
     * @param ESong $obj da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESong &$obj) 
    {
        $stmt->bindValue(':id_artist', $obj->getArtist()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $obj->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $obj->getGenre(), PDO::PARAM_STR);
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
        // istanzia il musicista autore dell'artista
        $musician = new EMusician();
        $musician->setId($row['id_artist']);
        $musician->setName($row['nickname']); 
        // creazione dell'oggetto Esong
        $song = new ESong(); 
        $song->setId($row['id']);
        $song->setName($row['name']);
        $song->setArtist($musician);
        $song->setGenre($row['genre']);
        //impostazione visibilita'.
        if ($row['forall']) $song->setForAll();
        elseif ($row['registered']) $song->setForRegisteredOnly();
        elseif ($row['supporters']) $song->setForSupportersOnly();
        else $song->setHidden();
        // restituisce la canzone
        return $song; 
    }      
}
    
