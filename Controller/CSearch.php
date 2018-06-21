<?php

/**
 * La classe CSearch implementa la funzionalità di 'Ricerca'. Al suo interno presenta inoltre delle 
 * costanti che definiscono chiavi (ovvero risorse da ricercare) e valori (ovvero indici rispetto a cui cercare)
 * di default e avanzati.
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
    
    /**
     * Questo metodo implementa il caso d'uso 'Ricerca Semplice' e fornisce una ricerca delle
     * canzoni rispetto al genere musicale. Tale ricerca puo' essere effettuata da qualunque tipologia
     * di utente.
     */
    static function simple()
    {
        $vSearch = new VSearch();
        $user = CSession::getUserFromSession();
        
        
        $string = $vSearch->getSearchValue();
        
        if($string /*&& $vSearch->validateSearch()*/)
        { // se l'utente ha inviato tramite GET un valore, si cerca nel DB
            $objects = FPersistantManager::getInstance()->search(CSearch::KEY_DEFAULT, CSearch::VALUE_DEFAULT, $string);
            $vSearch->showSearchResult($user, $objects, CSearch::KEY_DEFAULT, CSearch::VALUE_DEFAULT, $string);
        }
        else
            header('Location: /deepmusic/index');
        
    }
    
    /**
     * Questo metodo implementa il caso d'uso 'Ricerca Avanzata'. Un utente puo' infatti ricercare
     * canzoni o utenti in base al nome o al genere musicale. Questo tipo di ricerca e' possibile
     * solo per gli utenti che sono registrati.
     */
    static function advanced()
    {
        $vSearch = new VSearch();
        $user = CSession::getUserFromSession();
        
        if (get_class($user) != EGuest::class) // se l'utente non e' guest...
        { // si ricava la stringa inserita dall'utente per la ricerca
            $string = $vSearch->getSearchValue();
            
            if ($string) // se la stringa e' stata inserita
            { // si ricavano chiave e valore di ricerca scelti dall'utente
                list($key, $value)=$vSearch->getKeyAndValue();
                // se le chiavi corrispondono alle costanti...
                if(($key == CSearch::KEY_DEFAULT || $key == CSearch::KEY_ADVANCED) && ($value == CSearch::VALUE_DEFAULT || $value == CSearch::VALUE_ADVANCED))
                { // si prelevano gli oggetti
                    $objects = FPersistantManager::getInstance()->search($key, $value, $string);
                    $vSearch->showSearchResult($user, $objects, $key, $value, $string);
                }
                else //...altrimenti si mostra un errore
                    $vSearch->showErrorPage($user, 'Seems like key and value are not corrected...');
            } 
            else // se una stringa non e' inserita, l'utente viene reindirizzato alla pagina della ricerca avanzata
            {
                $vSearch->showAdvancedSearch($user);
            }
        }
        else // se l'utente e' guest, viene reindirizzato ad una pagina di errore
            $vSearch->showErrorPage($user, 'You must be logged to use advanced search functionalities!');
    }
    
 
}

