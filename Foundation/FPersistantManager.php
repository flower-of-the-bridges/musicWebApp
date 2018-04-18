<?php
    
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
     
/**
 * Description of FPersistantManager
 * This foundation class provides a unique access to the Mysql DBMS, its aim is 
 * to use the static methods of all the other foundation classes in order to 
 * gather the information required by the upper layers.
 * @author giovanni
 */

require_once 'config.inc.php';

class FPersistantManager {
    
    private static $instance = null; // the unique instance of the class
    private $db; // mysqli's database

    private function __construct()
    {
        
        $db = new mysqli($address, $user, $pass, $database);
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
    }

    private function __clone()
    {
        // evita la clonazione dell'oggetto
    }

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }
    
    public function load($className){
        $result;
        switch($className){
            case('E'.$className=='EMusician'):
                $result=FMusician::getMusician($db, $name);
                break;
            case('E'.$className=='EListener'):
                $result;
                break;
            default:
                break;
        }
        return $result;        
    }
    
    public function store($obj){
        $result;
        switch($obj){
            case(is_a($object, EMusician::class)):
                $result=FMusician::getMusician($db, $name);
                break;
            case(is_a($object, EMusician::class)):
                break;
            default:
                break;
        }
        
        return $result;        
    }
}

