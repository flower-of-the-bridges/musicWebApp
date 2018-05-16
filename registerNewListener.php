<?php
echo "tipe your nick name: ";
$handle = fopen ("php://stdin","r");
$nick = trim(fgets($handle));
echo "tipe your pwd: ";
$handle = fopen ("php://stdin","r");
$pwd = trim(fgets($handle));



//$list = new EListener($id = null, $nick, null, null