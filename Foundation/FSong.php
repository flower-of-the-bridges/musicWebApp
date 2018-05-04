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
       
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            //momentaneamente il file e' una risorsa statica
            $blob=fopen($song->getFilePath(), 'rb') or die('cant open');    //si apre il file contenuto nel path.
            
            FSong::bindValue($stmt, $song, $blob);    //si associano i valori dell'oggetto alle entry della query
            
            $stmt->execute();   //si esegue la query
            
            fclose($blob);      // si chiude il file
            
            if($stmt->rowCount())
            {
                
                $song->setId( $db->lastInsertId() );
                
                return $db->commit();
            } else {
                $db->rollBack();
                
                return false;
            }
        } catch (PDOException $e) {
           
            echo('Errore: '.$e->getMessage());
            
            $db->rollBack();
            
            return false;
        }
    }
    
    /**
     * Binds the query's values to the Esong's object attributes
     * @param PDOStatement $stmt the query statement to analyze
     * @param ESong $song the song to bind
     */
    private function bindValue(PDOStatement &$stmt, ESong &$song, &$blob)
    {
       
        $stmt->bindValue(':name', $song->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':artist', $song->getArtist(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $song->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3', $blob, PDO::PARAM_LOB);
        $stmt->bindValue(':forall', (int) $song->isForAll(), PDO::PARAM_INT);
        $stmt->bindValue(':registered', (int) $song->isForRegisteredOnly(), PDO::PARAM_INT);
        $stmt->bindValue(':supporters', (int) $song->isForSupportersOnly(), PDO::PARAM_INT);
    
    }
	
    
    /**
     * Carica una canzone dal DBMS e la salva in un oggetto ESong.
     * @param PDO $db  l'istanza del dbms
     * @param int $id l'id della canzone
     * @return object l'oggetto ottenuto dal database
     */
    static function loadSong(PDO &$db, int $id)
    {
        $sql = "select * from song where ID= " . $id . ";"; //query sql
        try {
            
            $stmt = $db->prepare($sql);
            
            $stmt->execute();                                               //viene eseguita la query
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);                          //salva in un array le colonne della tupla
            
            $song = new ESong($row ['ID'], $row['name'], $row['artist'], $row['genre']); //creazione dell'oggetto Esong
            
            //impostazione visibilita'.
            if ($row['forall']) {
                
                $song->setForAll();
                if ($row['registered'] && ! $row['forall']) {
                    
                    $song->setForRegisteredOnly();
                    if ($row['supporters'] && ! $row['registered'] && ! $row['forall']) {
                        
                        $song->setForSupportersOnly();
                        
                       
                    }
                }
	    }
            return $song; //ritorna la canzone
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return null; //ritorna null se ci sono errori
        }
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
    
    /**
     * Aggiorna i dati di una canzone     
     * @param PDO $db, ESONG $song
     */
    static function updateSong(PDO &$db, ESong &$song){
        //TODO
    }
    
    /**
     * Elimina tuttio ciò che è associato alla canzone
     * @param PDO $db, int $id
     */
    static function removeSong(PDO &$db, int $id) : bool
    {
        
        
        $sql =" delete  from song where ID= :id ;"; //query sql
        try {
            
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
            
            
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }
            
           
    }
    
}
    
