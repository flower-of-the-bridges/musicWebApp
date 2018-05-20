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
	href="smarty/templates/style.css">
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
			<h2>Login</h2>
					<form class="form-horizontal" method="post" action="auth.php">
						<div class="form-group">
							<label class="control-label " for="user">User Name:</label> <input
								type="text" class="form-control" id="user"
								placeholder="Enter UserName" name="user">

						</div>
						<div class="form-group">
							<label class="control-label" for="pwd">Password:</label> <input
								type="password" class="form-control" id="pwd"
								placeholder="Enter password" name="pwd">

						</div>
						<div class="form-group">

							<div class="checkbox">
								<label><input type="checkbox" name="remember">
									Remember me</label>
							</div>

						</div>
						<div class="form-group">

							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>

		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

