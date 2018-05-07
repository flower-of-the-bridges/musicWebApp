<?php

/**
 * @author gruppo 2
 */
class FListener {
    
    /**
     * Aggiunge un utente Listener al database
     * @param PDO $db la connessione al dbms
     * @param EListener $listener l'utente Listener da salvare
     * @return bool l'esito dell'operazione
     */
    static function storeListener(PDO &$db, EListener &$listener) : bool{
        $sql = "INSERT INTO user(name, birth_date)
				VALUES(:name, :birthdate, );";
        
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            FListener::bindValues($stmt, $listener);    //si associano i valori dell'oggetto alle entry della query
            
            $stmt->execute();   //si esegue la query
            
            if($stmt->rowCount())
            {
                
                $listener->setId( $db->lastInsertId() );
                
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
     * Rimuove un utente Listener dal database.
     * @param int $id dell'utente Listener da eliminare
     * @return bool l'esito dell'operazione
     */
    static function removeListener(int $id) : bool {
        
        $sql =" delete  from user where ID= :id ;"; //query sql
        try {
            
            $stmt = $db->prepare($sql); //a partire dalla stringa sql viene creato uno statement
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT); //si associa l'id al campo della query
            $stmt->execute(); //esegue lo statement
            //ritorna true se il numero di tuple eliminate è 1, false altrimenti
            return (bool) $stmt->rowCount();
           
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return FALSE; //ritorna false se ci sono errori
        }      
    }
    
    static function updateListener(PDO &$db, EListener &$listener) : bool{
        $sql = "UPDATE user SET name=?, password=?, email=?, birthDate=? WHERE ID=?";
        
        $db->beginTransaction(); //inizio della transazione
        
        $stmt = $db->prepare($sql);
        
        //si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try {
            
            //si associano i valori dell'oggetto alle entry della query e si esegue la query
            $stmt->execute([
                $listener->getName(), $listener->getPassword(), $listener->getEmail(), $listener->getBirthDate()
            ]);
            
            if($stmt->rowCount()) //se la tupla e' alterata...
            {
                return $db->commit(); //...ritorna il risultato del commit
            } 
            else //altrimenti l'update non ha avuto successo...
            {
                $db->rollBack();
                
                return false; //...annulla la transazione e ritorna false
            }
        } catch (PDOException $e) {
            
            echo('Errore: '.$e->getMessage());
            
            $db->rollBack();
            
            return false;
        }
    }
    
    static function loadListener(int $id) : EListener{
        $sql = "select * from listener where id= " . $id . ";"; //query sql
        try {
            
            $stmt = $db->prepare($sql);
            
            $stmt->execute();                                               //viene eseguita la query
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);                          //salva in un array le colonne della tupla
            
            $listener = new EListener($row['id'], $row['nickame'], null, $row['birth_date']); //creazione dell'oggetto Esong
            
            return $listener; //ritorna la canzone
        }
        catch (PDOException $e) {
            die($e->errorInfo);
            return null; //ritorna null se ci sono errori
        }
    }
    
    /**
     * Associa ai campi della query i corrispondenti valori dell'oggetto
     * @param PDOStatement $stmt lo statement contenente i campi da riempire
     * @param EListener $listener contenente i valori da associare alla query
     */
    private function bindValues(PDOStatement &$stmt, EListener &$listener)
    {
        $stmt->bindValue(':name', $listener->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':birthDate', $listener->getBirthDate(), PDO::PARAM_STR);
    }
}
