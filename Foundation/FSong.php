<?php
/**
 * @author gruppo 2
 */
class FSong {
    
    private $blob; //momentaneamente utilizzato per upload statico di mp3

    /**
     * Salva una ESong nel database
     * @param PDO $db la connessione verso il dbms
     * @param ESong $song da salvare
     * @return bool corrispondente all'esito dell'operazione
     */
    static function storeSong(PDO &$db, ESong $song) : bool
    {
        $sql = "INSERT INTO song(id_artist, name, genre, mp3, forall, registered, supporters)
				VALUES(:id_artist,:name,:genre, :mp3, :forall, :registered,:supporters)";
       
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            //momentaneamente il file e' una risorsa statica
            $blob=fopen($song->getFilePath(), 'rb') or die('cant open');    //si apre il file contenuto nel path.
            
            FSong::bindValues($stmt, $song, $blob);    //si associano i valori dell'oggetto alle entry della query
            
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
     * Associa ai campi della query i corrispondenti attributi dell'oggetto ESong.
     * @param PDOStatement $stmt da cui prelevare i campi
     * @param ESong $song da cui prelevare gli attributi
     */
    private function bindValues(PDOStatement &$stmt, ESong &$song, &$blob)
    {
        $stmt->bindValue(':id_artist', $song->getArtist()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $song->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':genre', $song->getGenre(), PDO::PARAM_STR);
        $stmt->bindValue(':mp3', $blob, PDO::PARAM_LOB);
        $stmt->bindValue(':forall', (int) $song->isForAll(), PDO::PARAM_INT);
        $stmt->bindValue(':registered', (int) $song->isForRegisteredOnly(), PDO::PARAM_INT);
        $stmt->bindValue(':supporters', (int) $song->isForSupportersOnly(), PDO::PARAM_INT);
    }
	
    
    /**
     * Carica una canzone dal database e la salva in un oggetto ESong.
     * @param PDO $db  la connessione verso il dbms
     * @param int $id l'id della canzone
     * @return object l'oggetto ottenuto dal database
     */
    static function loadSong(PDO &$db, int $id)
    {
        $sql = "select * from song where ID= " . $id . ";"; //query sql
        try {
            
            $stmt = $db->prepare($sql);
            
            $stmt->execute();  //viene eseguita la query
            
            //salva in un array la tupla prelevata. Gli indici corrispondono ai nomi delle colonne nel db.
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
            
            $song = new ESong($row ['id_song'], new EMusician($row['id_artist'],null,null,null,null), $row['name'], $row['genre']); //creazione dell'oggetto Esong
            
            //impostazione visibilita'.
            if ($row['forall']) $song->setForAll(); 
            elseif ($row['registered']) $song->setForRegisteredOnly();
            elseif ($row['supporters']) $song->setForSupportersOnly();
            else $song->setHidden();
            
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
    static function updateSong(PDO &$db, ESong &$song)
    {
        $sql = "UPDATE song SET name=?, id_artist=?, genre=?, forall=?, registered=?, supporters=? WHERE id_song=?";
        
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
                        
            $stmt->execute([
                $song->getName(), $song->getArtist()->getId(), $song->getGenre(), (int) $song->isForAll(),
                (int) $song->isForRegisteredOnly(), (int) $song->isForSupportersOnly(), $song->getId()
            ]);   ////si associano i valori dell'oggetto alle entry della query e si esegue la query
                        
            if($stmt->rowCount())
            {
                return $db->commit();
            } 
            else 
            {
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
     * Elimina una canzone dal db .
     * @param PDO $db la connessione al dbms 
     * @param int $id la canzone da eliminare
     */
    static function removeSong(PDO &$db, int $id) : bool
    {  
        $sql =" delete  from song where ID= :id ;"; //query sql
        try {
            
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return (bool) $stmt->rowCount();
            
            
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }      
    }
    
}
    
