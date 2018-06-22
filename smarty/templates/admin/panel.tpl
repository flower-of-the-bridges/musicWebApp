<!DOCTYPE html>
<html lang="en">
<head>
{user->getNickName assign='uName'}
{user->getId assign='uId'}
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Panel</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="/deepmusic/resources/css/style.css">
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
		<div class="col-sm-7 ">
			<div class="well">
			
			
			<h4>DB Admin Panel<h4>
			
			<br>
			<br>
			
			<a href="/deepmusic/admin/signup" 
				class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Sign Up</a>
	
			<a href="/deepmusic/admin/updateSupporter" 
				class="btn btn-primary btn-lg btn-active active" role="button" aria-pressed="true">Update Supporters</a>
			
			</div>
			<div class = "well">
				<a href="/deepmusic/admin/logout">Log Out</a>
			</div>
			
		</div>
		
			
	</div>
</body>
</html>
