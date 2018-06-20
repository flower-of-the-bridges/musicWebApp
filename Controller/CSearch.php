<?php

/**
 * La classe CSearch implementa la funzionalità di 'Ricerca'. 
 * @author gruppo2
 * @package Controller
 */
class CSearch
{
    /** Chiave di default: Ricerca di canzoni */
    const KEY_DEFAULT = 'Song';
    /** Chiave avanzata: Ricerca di utenti */
    const KEY_ADVANCED = 'User';
    /** Valore base: Ricerca per genere */
    const VALUE_DEFAULT = 'Genre';
    /** Valore avanzato: Ricerca per nome */
    const VALUE_ADVANCED = 'Name';
    
    static function simple($params)
    {
        var_dump($params);
        /*
        $vSearch = new VSearch();
        $user = CSession::getUserFromSession();
        
        
        $string = $vSearch->getSearchValue();
        
        if($string && $vSearch->validateSearch())
        { // se l'utente ha inviato tramite GET un valore, si cerca nel DB
            $objects = FPersistantManager::getInstance()->search(CSearch::KEY_DEFAULT, CSearch::VALUE_DEFAULT, $string);
            $vSearch->showSimpleSearchResult($user, $objects, CSearch::KEY_DEFAULT, CSearch::VALUE_DEFAULT);
        }
        else
            header('Location: /deepmusic/index');
        */
    }
    
    static function advanced($params = NULL)
    {
        
    }
 
}

