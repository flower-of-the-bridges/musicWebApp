<!DOCTYPE html>
<html lang="en">
<head>
{user->getNickName assign='uName'}
{user->getId assign='uId'}
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Report</title>
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
		<div class="col-sm-7 well">
			
			<h2>{$report->getTitle()} (Made by <a href="/deepmusic/user/profile/{$rId}">{$rName}</a></h2>
				
			<p>{$report->getDescription()}<p>
			
			<br>
			<br>
			{if !$report->isAccepted()}
			<a href="/deepmusic/manageReport/accept/{$report->getId()}" 
				class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Accept</a>
			{else}
			<a href="/deepmusic/manageReport/complete/{$report->getId()}" 
				class="btn btn-primary btn-lg btn-success active" role="button" aria-pressed="true">Complete</a>
			<a href="/deepmusic/manageReport/decline/{$report->getId()}" 
				class="btn btn-primary btn-lg btn-danger active" role="button" aria-pressed="true">Decline</a>
			{/if}
			
		</div>
	</div>
</body>
</html>
