<?php
namespace Entity;

/**
 * La classe EObject caratterizza un oggetto Entity a partire dal suo Id.
 * @author gruppo2
 *
 */
class EObject
{
    protected $id; //l'id dell'oggetto
    
    /**
     *
     * @param int $id
     */
    protected function __construct(int $id=null){
        $this->id=$id;
    }
    
    /**
     * @return int l'identifier dell'oggetto
     */
    public function getId() : int
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    
    
}

