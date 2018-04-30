<?php

/**
 * La classe FMusician consente di prelevare tramite i suoi metodi statici le informazioni
 * di un musicista: tali informazioni possono essere relative all'utente che sta visitando 
 * il sito oppure di un musicista di cui l'utente vuole ottenere informazioni. 
 * @author gruppo 2
 */
 
class FMusician{

    static function storeMusician(PDO &$db, EMusician &$musician) : bool {
        //TODO
    }
    
    static function updateMusician(PDO &$db, EMusician &$musician) : bool{
        //TODO
    }
    
    static function loadMusician(PDO &$db, int $id) : EMusician{
        //TODO
    }
    
    static function removeMusician(PDO &$db, int $id) : bool {
        //TODO
    }
}
