<!DOCTYPE html>
 
{user->getNickName assign='uName'}
{user->getId assign='uId'}
 
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Reports Hub</title>
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

        </div>
		<div class="col-sm-7 well">
			<h2>{if $assigned}Assigned{else}Unassigned{/if} Report Hub</h2>
			{if $assigned}
			<!-- Link ai report non assegnati al moderatore -->
			<a href="/deepmusic/manageReport/show">Switch to Unassigned Reports.</a>
			{else}
			<!-- Link ai report assegnati al moderatore -->
			<a href="/deepmusic/manageReport/show/assigned">Switch to Assigned Reports.</a>
			{/if}
			<hr>
			{if $array}
			<table class="table table-responsive">
			<!-- Table dei report -->
				<tbody>					
				{foreach $array as $report}
					<tr>
						<!-- Titolo del report (con link verso il report) -->
						<td>
							<a href="/deepmusic/report/show/{$report->getId()}">{$report->getTitle()}</a>
						</td>
						{if !$assigned}
						<td>
						<!-- Link per accettare il report -->
							<a href="/deepmusic/manageReport/accept/{$report->getId()}">
							<span class="glyphicon glyphicon-plus"></span> Accept</a>
						</td>
						{else} 
						<td>
						<!-- Link per completare il report-->
							<a href="/deepmusic/manageReport/complete/{$report->getId()}">
							<span class="glyphicon glyphicon-ok"></span> Complete</a>
						</td>
						<td>
						<!-- Link per respingere il report -->
							<a href="/deepmusic/manageReport/decline/{$report->getId()}">
							<span class="glyphicon glyphicon-remove"></span> Decline</a>
						</td>
						{/if}
					</tr>
				{/foreach}
				</tbody>
			</table>
			{else}
			<!-- Messaggio se non ci sono report -->
			{if $assigned}
			<p> You don't have any report assigned...don't be lazy and get one!</p>
			{else}
			<p>You're lucky! There are no reports submitted!</p>
			{/if}
			{/if}
		</div>
		
		<div class="col-sm-2">
							
		</div>
		
	</div>
	
</body>
</html>
