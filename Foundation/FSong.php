<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FSong
 *
 * @author giovanni
 */
class FSong {

    static function storeSong(mysqli &$db, ESong $song)
    {
        $sql = "INSERT INTO `song`(`name`, `artist`, `genre`, `forall`, `registered`, `supporters`) VALUES ";
        $sql.= "('" . $song->getName() . "','" . $song->getArtist() . "','" .
                      $song->getGenre() . "'," . (int) $song->isForAll() . "," . 
                      (int) $song->isForRegisteredOnly() . "," . 
                      (int) $song->isForSupportersOnly() . ");";
        if (! $result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
            return false;
        }
        else 
            return true;
    }
}
    
