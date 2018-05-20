<?php


class EComment extends EObject
{
    
    private $songId; //l'id della canzone commentata
    
    private $user; // l'utente che ha commentato
    
    private $comment; //il commento
    
    function __construct(int $id=null, int $songId=null, string $user=null, string $comment=null){
        parent::__construct($id);
        $this->songId=$songId;
        $this->user=$user;
        $this->comment=$comment;
    }
    
    /**
     * @return int l'id della canzone del commento
     */
    public function getSongId() : int
    {
        return $this->songId;
    }
    
    /**
     * @return string l'utente che ha effettuato il commento
     */
    public function getUser() : string
    {
        return $this->user;
    }
    
    /**
     * @return string il commento
     */
    public function getComment() : string
    {
        return $this->comment;
    }
    
    /**
     * @param int $songId l'id della canzone commentata
     */
    public function setSongId(int $songId)
    {
        $this->songId = $songId;
    }
    
    /**
     * @param string $user l'utente che ha commentato
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }
    
    /**
     * @param string $comment il commento
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }
  
}
