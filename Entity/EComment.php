<?php
/**
 * @author gruppo 2
 */
class EComment {
    
    private $songId;
    
    private $user;
    
    private $comment;
    
    function __construct(int $songId, string $user, string $comment){
        $this->songId=$songId;
        $this->user=$user;
        $this->comment=$comment;
    }
    
    /**
     * @return mixed
     */
    public function getSongId() : int
    {
        return $this->songId;
    }

    /**
     * @return mixed
     */
    public function getUser() : string
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getComment() : string
    {
        return $this->comment;
    }

    /**
     * @param mixed $songId
     */
    public function setSongId(int $songId)
    {
        $this->songId = $songId;
    }

    /**
     * @param mixed $user
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $comment
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    
    
}
