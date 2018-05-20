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
		<div class="col-sm-3">
			{include file="userInfo.tpl"}
        </div>
			<div class="col-sm-7 well">
				{if $content eq 'Song List'}
					{include file="SongList.tpl"}
				{elseif $content eq 'Song'}
					{include file="Song.tpl"}
				{/if}
			</div>
		<div class="col-sm-2">
			{include file="followOptions.tpl"}				
		</div>
		
	</div>
	
</body>
</html>
