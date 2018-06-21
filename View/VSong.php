<?php

require_once 'inc.php';
include_once 'View/VObject.php';

/**
 * La classe VSong si occupa dell'input-output per quanto riguarda i dati riguardanti le 
 * canzoni. Ovvero:
 * - dai dati inseriti dall'utente costruisce un oggetto ESong
 * - predispone e visualizza le varie pagine HTML per la creazione/modifica/rimozione/visualizzazione di una canzone.
 * @author gruppo2
 * @package View
 */
class VSong extends VObject
{
    
    /**
     * Costruttore che inizializza il componente view e definisce l'array contenente gli errori
     * che possono essere commessi nella form di caricamento / modifica brani
     */
    function __construct()
    {
        parent::__construct();
        // l'array è istanziato con indici i campi delle varie form, i cui valori sono di default a false (no errori)
        $this->check = array(
            'name' => true,
            'genre' => true,
            'file' => true,
            'view' => true
        );
    }

    /**
     * Funzione che crea una canzone a partire dagli input della form.
     * @return ESong
     */
    function createSong() : ESong
    {
        $song = new ESong();
        if (isset($_POST['name']) && isset($_POST['genre']) && isset($_POST['view']))
        {
            // impostazione di nome e genere
            $song->setName(ucfirst($_POST['name']));
            $song->setGenre(ucfirst($_POST['genre']));
            // impostazione visibilita canzone
            if ($_POST['view'] == 'all')
                $song->setForAll();
            if ($_POST['view'] == 'registered')
                $song->setForRegisteredOnly();
            if ($_POST['view'] == 'supporters')
                $song->setForSupportersOnly();
            if ($_POST['view'] == 'hidden')
                $song->setHidden();
        }
        if (isset($_FILES['file'])) // se il file e' stato caricato
        { 
            // si procede alla creazione dell'EMp3
            $mp3 = new EMp3();
            if($_FILES['file']['size']) // se la dimensione e' specificata 
            {
                $mp3->setMp3(file_get_contents($_FILES['file']['tmp_name']));
                $mp3->setSize($_FILES['file']['size']);
                $mp3->setType($_FILES['file']['type']);
            }
            
            $song->setMp3($mp3); // l'mp3 viene associato alla canzone
        }
           
        return $song;
    }
    
    /**
     * Mostra la pagina che consente l'inserimento di un brano da parte di un utente
     * @param EUser $user l'utente della sessione 
     * @param bool $error facoltativo, da impostare a true se l'utente ha inserito un nome di una canzone gia' inserita da lui
     */
    function showLoadForm(EUser &$user, bool $error = NULL)
    {
        if (! $error)
            $error = false;
      
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        
        $this->smarty->assign('error', $error);
        $this->smarty->assign('check', $this->check);
        
        $this->smarty->display('loadSong.tpl');
    }
    
    /**
     * Mostra la pagina che consente la modifica di un brano da parte di un utente
     * @param EUser $user l'utente della sessione
     * @param ESong $song la canzone da modificare
     * @param bool $error facoltativo, da impostare a true se l'utente ha inserito un nome di una canzone gia' inserita da lui
     */
    function showEditForm(EUser &$user, ESong &$song, bool $error = NULL)
    {
        if (! $error)
            $error = false;
            
            $this->smarty->registerObject('user', $user);
            $this->smarty->assign('song', $song);
            $checked=''; // stringa che verifica quale radio button mostrare come checked
            if($song->isForAll())
                $checked='all';
            elseif($song->isForRegisteredOnly())
                $checked='registered';
            elseif($song->isForSupportersOnly())
                $checked='supporters';
            else
                $checked='hidden';
            
            $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
            $this->smarty->assign('error', $error);
            $this->smarty->assign('check', $this->check);
            
            $this->smarty->assign('checked', $checked);
            $this->smarty->display('editSong.tpl');
    }

    /**
     * Mostra la pagina che consente la rimozione di un brano da parte di un utente
     *
     * @param EUser $user
     *            l'utente della sessione
     * @param ESong $song
     *            la canzone da rimuovere
     */
    function showRemoveForm(EUser &$user, ESong &$song)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('song', $song);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        $this->smarty->display('removeSong.tpl');
    }
    
    
    /**
     * Mostra il contenuto di una canzone.
     * @param EUser $user l'utente che sta visualizzando la pagina
     * @param ESong $song la canzone da visualizzare
     * @param bool $canSee true se l'utente puo' visualizzare la canzone, false altrimenti
     */
    function showSong(EUser &$user, ESong &$song, bool $canSee)
    {
        $this->smarty->registerObject('user', $user);
        $this->smarty->assign('song', $song);
        
        $this->smarty->assign('uType', lcfirst(substr(get_class($user), 1)));
        
        $this->smarty->assign('canSee', $canSee);
        
        $this->smarty->display('song.tpl');
        
    }
    
    /**
     * Funzione che controlla i campi della form per l'inserimento di una canzone
     * @return bool true se gli input sono corretti, false altrimenti
     */
    function validateLoad(ESong &$song) : bool
    {
        if($this->check['name']=$song->validateName() && $this->check['genre']=$song->validateGenre() && $this->check['mp3']=$song->validateMp3())
            return true;
        else 
            return false;
    }
    
    /**
     * Funzione che controlla i campi della form per la modifica di una canzone
     * @return bool true se gli input sono corretti, false altrimenti
     */
    function validateEdit(ESong &$song) : bool
    {
        if($this->check['name']=$song->validateName() && $this->check['genre']=$song->validateGenre())
        {
            return true;
        }
        else
            return false;
    }
    
    /**
     * Funzione che verifica se l'utente ha effettivamente richiesto la rimozione di una canzone 
     * @return bool true se l'utente vuole rimuovere il brano, false altrimenti
     */
    function validateRemove() : bool
    {
        if(isset($_POST['action']))
        {
            if($_POST['action']=='yes')
                return true;
            else 
                return false;
        }
        else 
            return false;
    }
}

