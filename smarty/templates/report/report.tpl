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
		<!-- Informazioni Report -->	
			<h2>{$report->getTitle()} (Made by <a href="/deepmusic/user/profile/{$rId}">{$rName}</a>)</h2>
			<div class="well">
			<!-- Descrizione Report -->
				<h4 id="important">Description</h4>	
				<p>{$report->getDescription()}<p>
			</div>
			<!-- Link all'oggetto del Report-->
			{if $report->getObjectType() eq 'user'}
			<a href="/deepmusic/user/profile/{$report->getIdObject()}">Show Reported Object.</a>
			{else}
			<a href="/deepmusic/song/show/{$report->getIdObject()}">Show Reported Object.</a>
			{/if}
			<br>
			<br>
			{if !$report->isAccepted()}
			<!-- Bottone per accettare il report -->
			<a href="/deepmusic/manageReport/accept/{$report->getId()}" 
				class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Accept</a>
			{else}
			<!-- Bottone per completare il report -->
			<a href="/deepmusic/manageReport/complete/{$report->getId()}" 
				class="btn btn-primary btn-lg btn-success active" role="button" aria-pressed="true">Complete</a>
			<!-- Bottone per declinare il report -->
			<a href="/deepmusic/manageReport/decline/{$report->getId()}" 
				class="btn btn-primary btn-lg btn-danger active" role="button" aria-pressed="true">Decline</a>
			{/if}
			
		</div>
	</div>
</body>
</html>
