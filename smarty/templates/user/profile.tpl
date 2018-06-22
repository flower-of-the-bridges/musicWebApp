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
	href="/deepmusic/resources/css/style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

	{include file="navbar.tpl"}
	
	
	<div class="container text-center">
	
		<div class="col-sm-3">
		<!-- Informazioni utente -->
			{include file="user/userInfo.tpl"}
        </div>
			<div class="col-sm-7 well">
			<!-- Contenuto principale -->
				{if $content eq 'Song List'}
			
				<!--lista canzoni-->
				<h4 id="important">Songs List</h4>
				{include file="SongList.tpl"}
				
				{elseif $content eq 'Followers'}
				
				<!--lista folloer-->
				<h4 id="important">Follower List</h4>
				<a href="/deepmusic/user/profile/{$pId}">Back to Profile</a>
				{include file="UserList.tpl"}
				
				{elseif $content eq 'Following'}
				<!-- Lista following -->
				<h4 id="important">Following List</h4>
				<a href="/deepmusic/user/profile/{$pId}">Back to Profile</a>
				{include file="UserList.tpl"}
				
				{elseif $content eq 'Supporters'}
				<!-- Lista Supporter -->	
				<h4 id="important">Supporters List</h4>
				<a href="/deepmusic/user/profile/{$pId}">Back to Profile</a>
				{include file="UserList.tpl"}
				
				{elseif $content eq 'Supporting'}
				<!-- Lista Supporting -->
				<h4 id="important">Supporting List</h4>
				<a href="/deepmusic/user/profile/{$pId}">Back to Profile</a>
				{include file="UserList.tpl"}
				
				{elseif $content eq 'None'}
				<!-- Simple introduction-->
				<h3>Hi! I'm a {ucfirst($pType)}!</h3>
				{/if}
			</div>
		<div class="col-sm-2">
		<!-- Follow/Support Options -->
			{include file="user/followOptions.tpl"}	
			{if $uId!=$pId && $uType!='guest'}
			<div class = "well">
				<a href="/deepmusic/report/make/{$pId}&user">Report User</a>
			</div>
			{/if}		
		</div>
		
	</div>

</body>
</html>
