<?

require_once 'inc.php';
ini_set( "upload_max_filesize","120M");
// utente statico
$mus = new EMusician();
$mus->setName('Rush');
$mus->setId(22);

$song = new ESong();
if($_POST['name'] && $_POST['genre'] && $_FILES['file']['type']=='audio/mpeg'){
  $song->setArtist($mus);
  $song->setName($_POST['name']);
  $song->setGenre($_POST['genre']);
  if($_POST['view']=='forall') 
    $song->setForAll();
  if($_POST['view']=='registered')
    $song->setForRegisteredOnly();
  if($_POST['view']=='supporters')
    $song->setForSupportersOnly();
  if($mus->addSong($song))
    echo 'caricamento ok';
  else 'caricamento fallito';
}
else
  echo('caricamento fallito');
die();
?>
