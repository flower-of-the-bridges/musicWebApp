<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Support {$musician->getNickName()}</title>
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

	{user->getNickName assign='uName'}
	{user->getId assign='uId'}

	{include file="navbar.tpl"}

	<div class="container text-center well">
		<h3>Do you want to support {$musician->getNickName()}?</h3>
		<ul>
  			<li>Contribute : {$supInfo->getContribute()}</li>
  			<li>Days : {$supInfo->getPeriod()}</li>
		</ul>
		<form method="post" action="/deepmusic/supporter/support/{$musician->getId()}">
    		<button type="submit" class="btn btn-primary btn-lg active" name="action" value="yes">Yes</button>
    		<button type="submit" class="btn btn-primary btn-lg btn-danger active" name="action" value="no">No</button>
		</form>
		<p>When the support's period expires, a message will be sent to your e-mail.</p>
	</div>

</body>
</html>
