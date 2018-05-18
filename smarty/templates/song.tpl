<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>User Profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="smarty/templates/style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	{user->getType assign='uType'} 
	{user->getName assign='uName'}

	{include file="navbar.tpl"}
	
	{profile->getType assign='pType'} 
	{profile->getName assign='pName'}

	<div class="container text-center">
		<br></br>
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well">
					<p>
						<a href="#">{profile->getName}</a>
					</p>
					<img
						src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237"
						class="img-circle" alt="Avatar" width="165" height="150">
				</div>
				{if $pType=='musician'}
				<div class="well">
					<p>
						<a href="#">Genre </a>
					</p>
					<p>

						<span class="label label-primary">Rock n Roll</span>


					</p>
				</div>
				{/if}
				<div class="well">
					<p>
						<a href="#">Info</a>
					</p>
					<p>Sono un musicista, suono e produco canzoni perche mi piace</p>
				</div>
				<button type="button" class="btn btn-primary">Follower
					(int)</button>
				<button type="button" class="btn btn-primary">Following
					(int)</button>
				<br></br> 
				{if $uName == $pName}
				<p>
					<a href="#">Modifica profilo </a>
				</p>
				{/if}
			</div>
			<div class="container text-center">

				<div class="col-sm-7 well">

					<h4>{$song->getArtist()->getName()} : {$song->getName()}
						({$song->getGenre()})</h4>
					<audio controls="controls" autoplay="">
						<source src="{$mp3->getMp3()}" type="{$mp3->getType()}">
					</audio>
				</div>
				<div class="col-sm-2 well">

					<div class="container-fluid">
						<h>Ti piace la mia musica?</h>
						<br></br>
						<button type="button" class="btn btn-primary">Seguimi</button>
						<br></br>
						<button type="button" class="btn btn-primary">Supportami</button>
					</div>
					<br></br> 
					{if $uName == $pName && $uType == "musician"}
					<p>
						<a href="#">Gestione supporti </a>
					</p>
					<br></br> 
					{/if}
				</div>
			</div>

		</div>
	</div>
</body>
</html>
