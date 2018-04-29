<?php
namespace Entity;

class EObject
{
    protected $id;
    
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

