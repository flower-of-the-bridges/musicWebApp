<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Support Informations</title>
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
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			<h2>Support Informations</h2>
			{if $success}
			<div class="alert alert-success">
				<strong>Great!</strong><br><p>The support info have been updated!</p>
			</div>
			{/if}
			<form method="post" action="edit">
			<div class="col-sm-4">
				<label for="contribute">Contribute</label> 
				<select name="contribute" id="contribute" class="form-control">
					<option value="{$supInfo::CONT_BASE}" {if $supInfo->getContribute() eq $supInfo::CONT_BASE}selected{/if}>$1</option>
					<option value="{$supInfo::CONT_MIDDLE}" {if $supInfo->getContribute() eq $supInfo::CONT_MIDDLE}selected{/if}>$5</option>
					<option value="{$supInfo::CONT_TOP}" {if $supInfo->getContribute() eq $supInfo::CONT_TOP}selected{/if}>$10</option>
				</select>
			</div>
			<div class="col-sm-4">
				<label for="inputState">Period</label> 
				<select name="period" id="inputState" class="form-control">
					<option value="{$supInfo::TIME_BASE}" {if $supInfo->getPeriod() eq $supInfo::TIME_BASE}selected{/if}>weekly</option>
					<option value="{$supInfo::TIME_MIDDLE}" {if $supInfo->getPeriod() eq $supInfo::TIME_MIDDLE}selected{/if}>monthly</option>
					<option value="{$supInfo::TIME_TOP}" {if $supInfo->getPeriod() eq $supInfo::TIME_TOP}selected{/if}>annual</option>
				</select>
			</div>
			<div class="col-sm-4">
				<label for="inputState">Confirm Changes</label>
				<button type="submit" id="inputState" class="btn btn-primary">Submit</button>
			</div>


			</form>
			<br></br>
			<br>
	
			<h4 id="important">Supporters</h4>
			{if $supporters}
			<table class="table table-responsive">
				<tbody>					
				{foreach $supporters as $user}
					<tr>
					
						<td><a href="/deepmusic/user/profile/{$user->getId()}">{$user->getNickName()}</a></td>
						<td>{substr(get_class($user),1)}</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
			{else}
			<p>We are sorry, nobody is supporting you!</p>
			{/if}

		</div>
		<div class="col-sm-3">
		
		</div>
	</div>
</body>
</html>

