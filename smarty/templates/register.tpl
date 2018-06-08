<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Log In</title>
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

	{include file="navbar.tpl"}
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			{if $error}
			<div class="alert alert-warning">
				<strong>Warning!</strong><br>Wrong combination of user and password. <br>Please retry.
			</div>
			{/if}
			<h2>Register</h2>
					<form method="post" enctype="multipart/form-data" action="signup">
						<div class="form-group">
							<label for="SongName">User Name: *</label> <input type="text"
								class="form-control" name="name"
								placeholder="Enter username...">
						</div>
						<div class="form-group">
							<label for="SongName">Password: *</label> <input type="password"
								class="form-control" name="pwd"
								placeholder="Enter password...">
						</div>
						<div class="form-group">
							<label for="SongName">Mail: *</label> <input type="text"
								class="form-control" name="mail"
								placeholder="Enter mail...">
						</div>

						<fieldset class="form-group">
							<legend>User Type:</legend>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="type" value="listener" checked>
									Listener
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="type" value="musician">
									Musician
								</label>
							</div>
						</fieldset>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

