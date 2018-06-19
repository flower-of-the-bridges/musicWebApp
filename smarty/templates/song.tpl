<!DOCTYPE html>
<html lang="en">
<head>
{user->getNickName assign='uName'}
{user->getId assign='uId'}
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>{$song->getArtist()->getNickName()} - {$song->getName()}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="/deepmusic/smarty/templates/style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="script
	href="/deepmusic/smarty/templates/script.js">

</head>
<body>

	
	{include file="navbar.tpl"}
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			{if $canSee}
			<h4><a href="/deepmusic/user/profile/{$song->getArtist()->getId()}&song">{$song->getArtist()->getNickName()}</a> : {$song->getName()} ({$song->getGenre()})</h4>
		    <audio controls="controls" autoplay="">
				<source src="player({$song->getId()})" type="audio/mpeg">
			</audio>
			{else}
			<h4>You can't listen this song.<h4>
			{/if}
			<br>
			<br>
			{if $uId eq $song->getArtist()->getId() or $uType eq 'moderator'}
			<a href="/deepmusic/song/edit/{$song->getId()}" 
				class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Edit</a>
	
			<a href="/deepmusic/song/remove/{$song->getId()}" 
				class="btn btn-primary btn-lg btn-danger active" role="button" aria-pressed="true">Delete</a>
			{/if}
		</div>
	</div>
</body>
</html>
