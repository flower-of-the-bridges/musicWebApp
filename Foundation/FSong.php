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
     * @param ESong $song da salvare
     * @return bool corrispondente all'esito dell'operazione
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
     * @return object l'oggetto ottenuto dal database
     */
    static function loadSong( ) : string
    {
        return "select * from song where ID= :id ;"; //query sql
    }
    
    /**
     * Aggiorna i dati di una canzone
     * @param PDO $db, ESONG $song
     */
    static function updateSong() : string
    {
        $sql = "UPDATE song
                SET name= :name, artist= :artist, genre= :genre, forall= :forall, registered= :registered, supporters= :supporters
                WHERE ID= :id";
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
    
/***************************** METODI ASSOCIAZIONI ENTITY - TUPLE *****************************/
    
    /**
     * Associa ai campi della query i corrispondenti attributi dell'oggetto ESong.
     * @param PDOStatement $stmt da cui prelevare i campi
     * @param ESong $obj da cui prelevare gli attributi
     */
    static function bindValues(PDOStatement &$stmt, ESong &$obj) {
        //momentaneamente il file e' una risorsa statica
        $blob=fopen($obj->getFilePath(), 'rb') or die('cant open');    //si apre il file contenuto nel path.
        $stmt->bindValue(':name', $obj->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':artist', $obj->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $obj->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3', $obj, PDO::PARAM_LOB);
        $stmt->bindValue(':forall', (int) $obj->isForAll(), PDO::PARAM_INT);
        $stmt->bindValue(':registered', (int) $obj->isForRegisteredOnly(), PDO::PARAM_INT);
        $stmt->bindValue(':supporters', (int) $obj->isForSupportersOnly(), PDO::PARAM_INT);
        fclose($blob);      // si chiude il file
    }
    
    static function createObjectFromRow(ESong &$obj, $row){
        $obj = new ESong($row ['id_song'], $row['name'], new EMusician($row['id_artist']), $row['genre']); //creazione dell'oggetto Esong
        
        //impostazione visibilita'.
        if ($rows['forall']) $obj->setForAll();
        elseif ($rows['registered']) $obj->setForRegisteredOnly();
        elseif ($rows['supporters']) $obj->setForSupportersOnly();
        else $obj->setHidden();
        break;
    }
    
    /**
     * Cancella tutte le entry di una query. Usata a scopo di debug.
     * @param PDO $db
     */
    static function emptyTable (PDO &$db){
        
        $db->beginTransaction();                         //inizio transazione
        
        $stmt = $db->prepare("TRUNCATE TABLE song;");    //prepara lo statement
        
        $stmt->execute();
        
        $db->commit();
        
    }
    
     
}
    
