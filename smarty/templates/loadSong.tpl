<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Add Song</title>
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
				<strong>Warning!</strong><br> <br>Please retry.
			</div>
			{/if}
			<h2>Load Song</h2>
					<form method="post" enctype="multipart/form-data" action="/deepmusic/song/load">
						<div class="form-group">
							<label for="SongName">Name: *</label> <input type="text"
								class="form-control" name="name"
								placeholder="Enter Song's Name...">
						</div>
						<div class="form-group">
							<label for="SongGenre">Genre: *</label> <input type="text"
								class="form-control" name="genre"
								placeholder="Enter Song's Genre...">
						</div>
						 <div class="form-group">
    						<label for="exampleInputFile">File input: *</label>
    						<input type="file" class="form-control-file" name="file">
  						</div>
						<fieldset class="form-group">
							<legend>View Options:</legend>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="all" checked>
									For All.
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="registered">
									DeepMusic's users only. 
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="supporters">
									Supporters only. 
								</label>
							</div>
							
  							
						</fieldset>
						<button type="submit" class="btn btn-primary">Load Song!</button>
					</form>


		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

