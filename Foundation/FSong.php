<?php
/**
 * @author gruppo 2
 */
class FSong {
    
    private $blob;

    /**
     * Store a ESong to database
     * @param PDO $db the database
     * @param ESong $song the song to save
     * @return bool true if loading was successful, false otherwise
     */
    static function storeSong(PDO &$db, ESong $song) : bool
    {
        $sql = "INSERT INTO song(name, artist, genre, mp3, forall, registered, supporters)
				VALUES(:name,:artist,:genre, :mp3, :forall, :registered,:supporters)";
       
        return FSong::execQuery($db, $sql, $song);
    }

    /**
     * Carica una canzone dal DBMS e la salva in un oggetto ESong.
     * @param PDO $db  l'istanza del dbms
     * @param int $id l'id della canzone
     * @return object l'oggetto ottenuto dal database
     */
    static function loadSong(PDO &$db, int $id): object
    {
        $sql1 = "select * from song where ID= " . $id . ";"; //query sql
        try {
            $stmt = $db->prepare($sql); 
            $stmt->execute(); //viene eseguita la query
            $row = $stmt->fetch(PDO::FETCH_ASSOC); //salva in un array le colonne della tupla
          
            $song = new ESong($row['name'], $row['artist'], $row['genre']); //creazione dell'oggetto Esong
            //impostazione visibilita'.
            if ($row['forall'] && $row['registered'] && $row['supporters']) 
                $song->setForAll();
            if ($row['registered'] && $row['supporters'] && ! $row['forall'])
                $song->setForRegisteredOnly();
            if ($row['supporters'] && ! $row['registered'] && ! $row['forall'])
                $song->setForSupportersOnly();
            return $song; //restituisce la canzone
        } 
        catch (PDOException $e) {
            die($e->errorInfo);
            return null; //ritorna null se ci sono errori
        }
    }
    
    static function updateSong(PDO &$db, ESong &$song){
        //TODO
    }
    
    static function removeSong(PDO &$db, int $id){
        //TODO
    }
    
    /**
     * Binds the query's values to the Esong's object attributes
     * @param PDOStatement $stmt the query statement to analyze
     * @param ESong $song the song to bind
     */
    private function bindValue(PDOStatement &$stmt, ESong &$song, &$blob){
       
        $stmt->bindValue(':name', $song->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':artist', $song->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $song->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3', $blob, PDO::PARAM_LOB);
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
            //momentaneamente il file e' una risorsa statica
            $blob=fopen($song->getFilePath(), 'rb') or die('cant open'); //si apre il file contenuto nel path.
            FSong::bindValue($stmt, $song, $blob); //si associano i valori dell'oggetto alle entry della query
            $stmt->execute(); //si esegue la query
            fclose($blob); // si chiude il file
            if($stmt->rowCount()){
                $song->setId($db->lastInsertId());
                return $db->commit();
            }   
            else 
                return !$db->rollBack();
        } catch (PDOException $e) {
                echo('Errore: '.$e->getMessage());
                return !$db->rollBack();
        }
  
    }
    
    /**
     * Cancella tutte le entry di una query. Usata a scopo di debug.
     * @param PDO $db
     */
    static function emptyTable (PDO &$db){
        $db->beginTransaction();                        //inizio transazione
        $stmt = $db->prepare("TRUNCATE TABLE song;");    //prepara lo statement
        $stmt->execute();
        $db->commit();
        
    }
	
}
    
