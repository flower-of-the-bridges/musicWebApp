<?php

class FUserInfo
{
    
    static function storeUserInfo() : string
    {
        return "INSERT INTO user_info(id, first_name, last_name, birth_place, birth_date, bio, genre)
                VALUES (:id, :first_name, :last_name, :birth_place, :birth_date, :bio, :genre);";
    }
    
    static function updateUserInfo() : string
    {
        return "UPDATE user_info
                SET id = :id, 
                    first_name = :first_name,
                    last_name = :last_name,
                    birth_place = :birth_place, 
                    birth_date = :birth_date, 
                    bio = :bio,   
                    genre = :genre
                WHERE id = :id;";
    }
    
    static function loadUserInfo() : string
    {
        return "SELECT *
                FROM user_info
                WHERE id = :id;";
    }
    
    static function searchUserByGenre() : string
    {
        return "SELECT id
                FROM usersInfo
                WHERE LOCATE( :Genre , genre) > 0;";
    }
    
    static function bindValues(PDOStatement &$stmt, EUserInfo &$userInfo)
    {
        if($userInfo->getId()!=NULL){
            $stmt->bindValue(':id', $userInfo->getId(), PDO::PARAM_STR);
        }
        if($userInfo->getFirstName()!=NULL){
            $stmt->bindValue(':first_name', $userInfo->getFirstName(), PDO::PARAM_STR);
        }    
        if($userInfo->getLastName()!=NULL){
            $stmt->bindValue(':last_name', $userInfo->getLastName(), PDO::PARAM_STR);
        }
        if($userInfo->getBirthPlace()!=NULL){
            $stmt->bindValue(':birth_place', $userInfo->getBirthPlace(), PDO::PARAM_STR);
        }
        if($userInfo->getBirthDate()!=NULL){
            $stmt->bindValue(':birth_date', $userInfo->getBirthDate(), PDO::PARAM_STR);
        }
        if($userInfo->getBio()!=NULL){
            $stmt->bindValue(':bio', $userInfo->getBio(), PDO::PARAM_STR);
        }
        if($userInfo->getGenre()!=NULL){
            $stmt->bindValue(':genre', $userInfo->getGenre(), PDO::PARAM_STR);
        }
            
    }
    
    static function createObjectFromRow($row) : EUserInfo
    {
        $user = new EUserInfo();
        
        $user->setId($row['id']);
        $user->setFirstName($row['first_name']);
        $user->setLastName($row['last_name']);
        $user->setBirthPlace($row['birth_place']);
        $user->setBirthDate($row['birth_date']);
        $user->setBio($row['bio']);
        $user->setGenre($row['genre']);
        
        return $user;
    }
    
}

