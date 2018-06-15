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
        $stmt->bindValue(':id', $userInfo->getId(), PDO::PARAM_INT);
        
        if($userInfo->getFirstName())
        {
            $stmt->bindValue(':first_name', $userInfo->getFirstName(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':first_name', 'NULL', PDO::PARAM_STR);
        
        if($userInfo->getLastName())
        {
            $stmt->bindValue(':last_name', $userInfo->getLastName(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':last_name', 'NULL', PDO::PARAM_STR);
        
        if($userInfo->getBirthPlace())
        {
            $stmt->bindValue(':birth_place', $userInfo->getBirthPlace(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':birth_place', 'NULL', PDO::PARAM_STR);
        
        if($userInfo->getBirthDate())
        {
            $stmt->bindValue(':birth_date', $userInfo->getBirthDate(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':birth_date', 'NULL', PDO::PARAM_STR);
        
        if($userInfo->getBio())
        {
            $stmt->bindValue(':bio', $userInfo->getBio(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':bio', 'NULL', PDO::PARAM_STR);
        
        if($userInfo->getGenre())
        {
            $stmt->bindValue(':genre', $userInfo->getGenre(), PDO::PARAM_STR);
        }
        else
            $stmt->bindValue(':genre', 'NULL', PDO::PARAM_STR);
            
    }
    
    static function createObjectFromRow($row) : EUserInfo
    {
        $user = new EUserInfo();
        
        $user->setId($row['id']);
        
        if($row['first_name']!='NULL')
            $user->setFirstName($row['first_name']);
        if($row['last_name']!='NULL')
            $user->setLastName($row['last_name']);
        if($row['birth_place']!='NULL')
            $user->setBirthPlace($row['birth_place']);
        if($row['birth_date']!='NULL')
            $user->setBirthDate($row['birth_date']);
        if($row['bio']!='NULL')
            $user->setBio($row['bio']);
        if($row['genre']!='NULL')
            $user->setGenre($row['genre']);
        
        return $user;
    }
    
}

