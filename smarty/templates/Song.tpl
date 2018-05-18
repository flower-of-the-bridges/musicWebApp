<h4>{$song->getArtist()->getName()} : {$song->getName()} ({$song->getGenre()})</h4>
<audio controls="controls" autoplay="">
	<source src="{$mp3->getMp3()}" type="{$mp3->getType()}">
</audio>