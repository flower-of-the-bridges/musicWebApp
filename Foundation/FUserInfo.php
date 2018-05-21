<?php



class FUserInfo
{
    
    static function searchUserByGenre() : string
    {
        return "SELECT id
                FROM usersInfo
                WHERE LOCATE( :Genre , genre) > 0;";
    }
    
    static function bindValues(PDOStatement &$stmt, EUserInfo &$userInfo)
    {
        if($userInfo->getGenre()!=NULL)
            $stmt->bindValue(':genre', $userInfo->getGenre(), PDO::PARAM_STR);
            
    }
    
}

