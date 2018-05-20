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
			<form action="search.php">
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="text" class="form-control" id="search" name="str" placeholder="Search...">
					</div>
					<div class="form-group col-md-3">
						<select id="inputKey" class="form-control" name="key">
							<option value="song" selected>Song</option>
							<option value="musician">Musician</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<select id="inputKey" class="form-control" name="value">
							<option value="genre" selected>Genre</option>
							<option value="name">Name</option>
						</select>
					</div>
					<button class="btn btn-primary" type="submit">Search</button>

				</div>
			</form>
		</div>
		<div class="col-sm-3">
		
		</div>
	</div>
</body>
</html>