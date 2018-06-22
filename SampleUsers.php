<?php
require_once 'inc.php';

class SampleUsers 
{
    static function generateUserPool(int $nUsers, int $nMusician, int $nModeratori)
    {
        $musList = array();
        
        for ($i = 0; $i < $nModeratori; $i++) {
            SampleUsers::generateModer($i);
        }
        for ($i = 0; $i < $nMusician; $i++) {
            $musList[] = SampleUsers::generateMusician($i);
        }
        for ($i = 0; $i < $nUsers; $i++) {
            SampleUsers::generateListener($i, $musList);
        }
           
    }
    
    private function generateListener(int $n,array $listaMus){
        $list=new EListener();
        
        $list->setId(0);
        $list->setNickName("listener".$n);
        $list->setPassword("listener".$n);
        $list->hashPassword();
        $list->setMail("listener".$n."@mail.ex");
        
        FPersistantManager::getInstance()->store($list);
        
        $staticInfo=new EUserInfo();
        $staticInfo->setFirstName("listener");
        $staticInfo->setLastName($n);
        $staticInfo->setBirthDate("2018-06-23");
        $staticInfo->setBirthPlace("nowhere");
        $staticInfo->setBio("this is the list. number ".$n);
        
        $list->setUserInfo($staticInfo);
        
        $staticImg=new EImg();
        $staticImg->setStatic();
        
        $list->setImage($staticImg);
        
        for ($j=0; $j<$listaMus->lenght; $j++)
        {
            if($j%2){
                $follow = new EFollower();
                $follow->setFollower($list);
                $follow->setUser($listaMus[$j]);
                
                FPersistantManager::getInstance()->store($follow);
            }else{
                $supp = new ESupporter();
                $supp->setSupport($list);
                $supp->setArtist($listaMus[$j]);
                $supp->makeExpirationDateFromPeriod(7);
                
                FPersistantManager::getInstance()->store($supp);
            }
        }
    }
    
    private function generateMusician(int $n){
        $mus=new EMusician();
        
        $mus->setId(0);
        $mus->setNickName("musician".$n);
        $mus->setPassword("musician".$n);
        $mus->hashPassword();
        $mus->setMail("musician".$n."@mail.ex");
        
        FPersistantManager::getInstance()->store($mus);

        $staticInfo=new EUserInfo();
        $staticInfo->setFirstName("musician");
        $staticInfo->setLastName($n);
        $staticInfo->setBirthDate("2018-06-23");
        $staticInfo->setBirthPlace("nowhere");
        $staticInfo->setBio("this is the mus. number ".$n);
        
        $mus->setUserInfo($staticInfo);
        
        $staticImg=new EImg();
        $staticImg->setStatic();
        
        $mus->setImage($staticImg);
        
        $mus->setSupportInfo();
        
        $staticSong = new ESong();
        $staticSong->setArtist($mus);
        $staticSong->setForAll();
        
        for ($j = 0; $j < 5; $j++)
        {
            $staticSong->setName($mus->getNickName()." Song n".$j);
            $staticSong->setGenre($j);
            
            FPersistantManager::getInstance()->store($staticSong);
            
            $staticSong->setStaticMp3();
            FPersistantManager::getInstance()->store($staticSong->getMp3());
        }
        return $mus;
    }
    
    private function generateModer(int $n){
        $mod=new EModerator();
        
        $mod->setNickName("moderatore".$n);
        $mod->setPassword("moderatore".$n);
        $mod->hashPassword();
        $mod->setMail("moderatore".$n."@mail.ex");
        
        FPersistantManager::getInstance()->store($mod);
        
        $staticInfo=new EUserInfo();
        $staticInfo->setFirstName("moderatore");
        $staticInfo->setLastName($n);
        $staticInfo->setBirthDate("2018-06-23");
        $staticInfo->setBirthPlace("nowhere");
        $staticInfo->setBio("this is the mod. number ".$n);
        
        $mod->setUserInfo($staticInfo);
        
        $staticImg=new EImg();
        $staticImg->setStatic();
        
        $mod->setImage($staticImg);
        
    }
}