<?php

require 'inc.php';

$p = FPersistantManager::getInstance(); //creo istanza del manager di connessione al dbms

$mus = new EMusician();
$mus->setId(22);
$mus->setName('Rush');
if(FPersistantManager::getInstance()->store($mus))
    echo 'caricamento ok';
else echo 'caricamento fallito';

//prima insert
$s = new ESong();
$s->setName("2112");
$s->setArtist($mus);
$s->setGenre('Rock');
$s->setForAll();

if ($mus->addSong($s)) { echo($s); }

//seconda insert
$s = new ESong();
$s->setName("Tom Sawyer");
$s->setArtist($mus);
$s->setGenre('Rock');
$s->setForRegisteredOnly();

if ($mus->addSong($s)) { echo($s); }

//terza insert
$s = new ESong();
$s->setName("YXZ");
$s->setArtist($mus);
$s->setGenre('Rock');
$s->setForSupportersOnly();

if ($mus->addSong($s)) { echo($s); }

$p->closeDBConnection();			 //end PDO connection instance

?>
