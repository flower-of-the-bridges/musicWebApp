<?php

require_once 'inc.php';
include_once 'View/VObject.php';

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
    function createSong(): ESong
    {
        $song = new ESong();
        
        if (isset($_POST['name']) && isset($_POST['genre']) && isset($_POST['view']) && isset($_FILES['file']))
        {
            $song->setName($_POST['name']);
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
            
            $mp3 = new EMp3();
            
            $mp3->setMp3( file_get_contents ($_FILES['file']['tmp_name']));
            $mp3->setSize ($_FILES['file']['size']);
            $mp3->setType ($_FILES['file']['type']); 
            
            $song->setMp3($mp3);
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
        $this->smarty->display('loadSong.tpl');
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
    
}
