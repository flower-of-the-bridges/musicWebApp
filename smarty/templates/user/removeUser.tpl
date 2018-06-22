<!DOCTYPE html>
{user->getNickName assign='uName'}
{user->getId assign='uId'}
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Delete user {if isset($rName) && isset($rId)}{$rName}{else}{$uName}{/if}</title>
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

	<div class="container text-center well">
		<h3>Do you want to delete {if isset($rName) && isset($rId)}{$rName}{else}your{/if} profile? All your data will be erased!</h3>
		<form method="post" {if $uType eq 'moderator' && isset($rName) && isset($rId)}{if $rId!=$uId} action="/deepmusic/user/remove/{$rId}" {else} action="/deepmusic/user/remove/{$pId}"{/if}{/if}>
    		<button type="submit" class="btn btn-primary btn-lg active" name="action" value="yes">Yes</button>
    		<button type="submit" class="btn btn-primary btn-lg btn-danger active" name="action" value="no">No</button>
		</form>
	</div>

</body>
</html>
