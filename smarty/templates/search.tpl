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
	href="/Beta/smarty/templates/style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

	{user->getType assign='uType'} 
	{user->getName assign='uName'}

	{include file="navbar.tpl"}
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			<h4>Search Results for {$key}'s {$value} {$string}: </h4>
			{if $objects!=NULL}
			<table class="table table-responsive">
				<tbody>
				{foreach $objects as $object}
					<tr>
						{if $key eq "Song"}
						<td><a href="song.php?id={$object->getId()}">{$object->getName()}</a></td>
						{elseif $key eq "Musician"}
						<td><a href="profile.php?id={$object->getId()}">{$object->getName()}</a></td>
						{/if}
						<td>{$object->getGenre()}</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
			{else}
			<p>No {$key} found for {$value} {$string} .</p> 
			{/if}

		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

