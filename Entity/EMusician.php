<?php

require_once 'inc.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EMusician
 *
 * @author giovanni
 */
class EMusician extends EUser{
    
    private $songs; //list of songs made by the musician 
    private $genre; //music genre adopted by the musician
    
    /**
     * 
     * @param string $user
     * @param DateTime $birthDate
     */
    public function __construct(string $user, DateTime $birthDate) {
        
        parent::__construct($user, $birthDate);
        $this->songs =array();
    }
    
    public function addSong(Esong $song){
        $this->songs[]=$song;
    }
    
    public function removeSong(int $pos){
        unset($this->songs[$pos]);
    }
    
    public function songsNumber(){
        return (int) count($this->songs);
    }
    
    /**
     * Overrided method from the parent class.
     * @param $birthDate DateTime value
     */
    public function setBirthDate($birthDate) {
        parent::setBirthDate($birthDate);
    }
    /**
     * Overrided method from the parent class.
     * @return DateTime representing the birth date of the musician.
     */
    public function getBirthDate() {
        return parent::getBirthDate();
    }

    public function getName() : string{
        parent::getName();
    }

    public function setName(string $name){
        parent::setName($name);
    }

}
