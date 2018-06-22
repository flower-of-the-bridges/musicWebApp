<!DOCTYPE html>
 
{user->getNickName assign='uName'}
{user->getId assign='uId'}
 
{profile->getNickName assign='pName'}
{profile->getId assign='pId'}

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
			{include file="userInfo.tpl"}
        </div>
		<div class="col-sm-7 well">
			<table class="table table-responsive">
				<tbody>					
				{foreach $array as $report}
			
					<tr>
						<td>
							<a href="/deepmusic/report/show/{$report->getId()}">{$report->getTitle()}</a>
						</td>
						{if $accepted}
						<td>
							<a href="/deepmusic/manageReport/accept/{$report->getId()}">
							<span class="glyphicon glyphicon-pencil"></span>Accept</a>
						</td>
						{else} 
						<td>
							<a href="/deepmusic/manageReport/complete/{$report->getId()}">
							<span class="glyphicon glyphicon-pencil"></span>Complete</a>
						</td>
						<td>
							<a href="/deepmusic/manageReport/decline/{$report->getId()}">
							<span class="glyphicon glyphicon-pencil"></span>Decline</a>
						</td>
						{/if}
					</tr>
				{/foreach}
				</tbody>
			</table>
		</div>
		
		<div class="col-sm-2">
							
		</div>
		
	</div>
	
</body>
</html>
