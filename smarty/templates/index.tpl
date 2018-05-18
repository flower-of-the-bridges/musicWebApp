<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Welcome to Deep Music!</title>
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

	<div class="container text-center well">
		<h3>The next generation of musicians!</h3>
		<p>Are you tired of the same old songs? Do you want something new?
		</p>
		<h3>This is the place where music lives again.</h3>
		<br>
		<div class="row">
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Create your Music!</strong>
				</p>
				<br> <img
					src="http://www.chrismcintyre.ca/wp-content/uploads/2015/06/Chris-McIntyre-5930.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">

			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Share it!</strong>
				</p>
				<br> <img
					src="https://s3.amazonaws.com/musicindustryhowtoimages/wp-content/uploads/2014/04/12072723/How-To-Get-People-To-Listen-To-Your-Music.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Be a Star!</strong>
				</p>
				<br> <img
					src="https://thumbs.dreamstime.com/t/silhouettes-people-music-festival-beach-41699585.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
		</div>
	</div>

</body>
</html>
