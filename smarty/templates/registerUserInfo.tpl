<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Sign Up Info</title>
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

	{user->getNickName assign='uName'}
	{user->getId assign='uId'} 


	{include file="navbar.tpl"}
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
        <div class="col-sm-7 well">
			{if $error}
			<div class="alert alert-warning">
				<strong>Warning!</strong><br>Wrong combination of user and password. <br>Please retry.
			</div>
			<div class="col-sm-7 well">
			{if $error}
			<div class="alert alert-warning">
				<strong>Warning!</strong><br>Wrong combination of user and password. <br>Please retry.
			</div>
			{/if}
			<h2>Register Info</h2>
					
					<div class="form-group">
    					<label for="exampleInputFile">Select Profile Pic: *</label>
    					<input type="file" class="form-control-file" name="file">
  					</div>
			
					<form method="post" enctype="multipart/form-data" action="editInfo">
						{if $uType!='musician'}
						<div class="form-group">
							<label for="SongName">First Name: *</label> <input type="text"
								class="form-control" firstName="firstName" {if $uInfo->getFirstName()}value="{$uInfo->getFirstName()}"{/if}
								placeholder="Enter your first name...">
						</div>
						<div class="form-group">
							<label for="SongName">Last Name: *</label> <input type="text"
								class="form-control" lastName="lastName"
								placeholder="Enter your last name...">
						</div>
						{/if}
						<div class="form-group">
							<label for="SongName">Birth Place: *</label> <input type="text"
								class="form-control" birthPlace="birthPlace"
								placeholder="Enter your birth place...">
						</div>
						<div class="form-group">
							<label for="SongName">Birth Date: *</label> <input type="text"
								class="form-control" birthDate="birthDate"
								placeholder="Enter your birth date... (dd/mm/aaaa)">
						</div>
						<div class="form-group">
							<label for="SongName">Bio : *</label> <input type="text"
								class="form-control" bio="bio"
								placeholder="Say something about yourself...">
						</div>
						
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
					</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>