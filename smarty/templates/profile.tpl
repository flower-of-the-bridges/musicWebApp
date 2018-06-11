<!DOCTYPE html>
 
{user->getNickName assign='uName'}
{user->getId assign='uId'}
 
{profile->getNickName assign='pName'}
{profile->getId assign='pId'}

<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>{$pName}'s Profile</title>
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

</head>
<body>


	{include file="navbar.tpl"}
	
	
	<div class="container text-center">
		<div class="col-sm-3">
			{include file="userInfo.tpl"}
        </div>
			<div class="col-sm-7 well">
				{if $content eq 'Song List'}
					{include file="SongList.tpl"}
				{elseif $content eq 'None'}
				<h3>No content available</h3>
				{/if}
			</div>
		<div class="col-sm-2">
			{include file="followOptions.tpl"}				
		</div>
		
	</div>
	
</body>
</html>
