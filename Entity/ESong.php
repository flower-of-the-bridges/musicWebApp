<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ESong
 *
 * @author giovanni
 */
class ESong
{

    // put your code here
    private $name;

    private $artist;

    private $lenght;

    private $genre;

    private $lyrics;

    private $forAll;

    private $supportersOnly;

    private $registeredOnly;

    public function __construct(string $name, DateTime $lenght, string $genre)
    {
        $this->name = $name;
        $this->lenght = $lenght;
        $this->genre = $genre;
        $this->forAll = false;
        $this->supportersOnly = false;
        $this->registeredOnly = true;
    }

    function getText(): string
    {
        return $this->lyrics;
    }

    function setText(string $text)
    {
        $this->lyrics = $text;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getLenght(): DateTime
    {
        return $this->lenght;
    }

    function getGenre(): string
    {
        return $this->genre;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setLenght(DateTime $lenght)
    {
        $this->lenght = $lenght;
    }

    function setGenre(string $genre)
    {
        $this->genre = $genre;
    }

    function isForAll(): bool
    {
        return $this->All;
    }

    function isForSupportersOnly(): bool
    {
        return $this->supportersOnly;
    }

    function isForRegisteredOnly(): bool
    {
        return $this->registeredOnly;
    }

    function setForAll()
    {
        $this->All = true;
        $this->supportersOnly = true;
        $this->registeredOnly = true;
    }

    function setForSupportersOnly()
    {
        $this->All = false;
        $this->registeredOnly = false;
        $this->supportersOnly = true;
    }

    function setForRegisteredOnly()
    {
        $this->All = false;
        $this->supportersOnly = true;
        $this->registeredOnly = true;
    }

    function hide()
    {
        $this->All = false;
        $this->supportersOnly = false;
        $this->registeredOnly = false;
    }


    
}
