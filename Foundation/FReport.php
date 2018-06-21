<?php

class FReport
{
    
    static function storeReport () : string
    {
        return "INSERT INTO report(id_moderatore, title, description, id_segnalatore, id_object, object_type)
                VALUES (:id_moderatore, :title, :description, :id_segnalatore, :id_object, :object_type);";
    }
    
    static function updateReport () : string
    {
        return "UPDATE report
                SET id_moderatore = :id_moderatore,
                    title = :title,
                    description = :description,
                    id_segnalatore = :id_segnalatore,
                    id_object = :id_object,
                    object_type = :object_type
                WHERE id = :id;";
    }
    
    static function loadReport () : string
    {
        return "SELECT *
                FROM report
                WHERE id = :id;";
    }
    
    static function removeReport () : string
    {
        return "DELETE
                FROM report
                WHERE id = :id;";
    }
       
    static function loadReportByIdMod() : string
    {
        return "SELECT *
                FROM report
                WHERE id_moderatore = :id_moderatore;";
    }
    
    static function bindValues(PDOStatement &$stmt, EReport &$rep)
    {       
        if($rep->getIdModeratore())
            $stmt->bindValue(':id_moderatore', $rep->getIdModeratore(), PDO::PARAM_INT);
        else 
            $stmt->bindValue(':id_moderatore', 'NULL');
        
        $stmt->bindValue(':title', $rep->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $rep->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':id_segnalatore', $rep->getIdSegnalatore(), PDO::PARAM_INT);
        $stmt->bindValue(':id_object', $rep->getIdObject(), PDO::PARAM_INT);
        $stmt->bindValue(':object_type', $rep->getObjectType(), PDO::PARAM_STR);
    }
    
    static function createObjectFromRow($row) : EReport
    {
        $rep = new EReport();
        $rep->setId($row['id']);
        $rep->setIdModeratore($row['id_moderatore']);
        $rep->setTitle($row['title']);
        $rep->setDescription($row['description']);
        $rep->setIdSegnalatore($row['id_segnalatore']);
        $rep->setIdObject($row['id_object']);
        $rep->setObjectType($row['object_type']);
        
        
        return $rep;
    }
    
}