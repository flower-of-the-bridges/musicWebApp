<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Edit {$song->getArtist()->getNickName()} - {$song->getName()}</title>
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
			{if $error}
			<div class="alert alert-warning">
				<strong>Warning!</strong><br> <br>Please retry.
			</div>
			{/if}
			<h2>Edit Song</h2>
					<form method="post" enctype="multipart/form-data" action="/deepmusic/song/edit/{$song->getId()}">
						<fieldset class="form-group">
							<legend></legend>
							<div class="form-group row">
      							<label for="SongName" class="col-sm-2 col-form-label {if !$check.name} text-danger{/if}">Name: *</label>
      							<div class="col-sm-7">
        							<input type="text" class="form-control is-invalid" id="SongName" name="name" value="{$song->getName()}" placeholder="Insert song's name...">
      							</div>
      							{if ! $check.name}
      							<div class="col-sm-3">
        							<small id="nameHelp" class="text-danger">
          							Must be 3-20 characters long.
        						</small>      
     							</div>
     							{/if}
    						</div>
							<div class="form-group row">
      							<label for="SongGenre" class="col-sm-2 col-form-label {if !$check.genre} text-danger{/if}">Genre: *</label>
      							<div class="col-sm-7">
        							<input type="text" class="form-control is-invalid" id="SongGenre" name="genre" value ="{$song->getGenre()}" placeholder="Insert song's genre...">
      							</div>
      							{if ! $check.genre}
      							<div class="col-sm-3">
        							<small id="genreHelp" class="text-danger">
          								Must be 3-20 characters long.
        							</small>      
     							</div>
     							{/if}
    						</div>
						</fieldset>
						<fieldset class="form-group">
							<legend></legend>
							<h4 id="important">View Options:</h4>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="all" {if $checked eq 'all'}checked{/if}>
									For All.
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="registered" {if $checked eq 'registered'}checked{/if}>
									DeepMusic's users only. 
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="supporters" {if $checked eq 'supporters'}checked{/if}>
									Supporters only. 
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label"> <input type="radio"
									class="form-check-input" name="view" value="hidden" {if $checked eq 'hidden'}checked{/if}>
									Only you can see it.
								</label>
							</div>
						</fieldset>
						<button type="submit" class="btn btn-primary">Edit Song!</button>
					</form>


		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

