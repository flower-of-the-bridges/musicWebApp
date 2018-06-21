<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Report</title>
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
			
			<h2>Report</h2>
					
			
				<form method="post" id="info" enctype="multipart/form-data" action="/deepmusic/report/make/{$id}&{$type}">
					
  					<fieldset class="form-group">
  						<legend></legend>
						
						<div class="form-group row">
							<label for="BirthDate" class="col-sm-2 col-form-label {if !$check.title} text-danger{/if}">
								Title : *
							</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="title" 
									placeholder="Enter report title...">
							</div>
							{if !$check.title}
							<div class="col-sm-3">
	        					<small id="titleHelp" class="text-danger">
	          						Only alphanumeric characters.
	        					</small>      
	     					</div>
	     					{/if}
						</div>
	
						<div class="form-group row">
							<label for="Description" class="col-sm-2 col-form-label {if !$check.description} text-danger{/if}">
								Description : *
							</label>
							<div class="col-sm-7">
								<textarea form="info" class="form-control" name="description" 
								placeholder="Why are you reporting this item?"></textarea>
							</div>
							{if !$check.description}
							<div class="col-sm-3">
	        					<small id="bioHelp" class="text-danger">
	          						No strange characters!
	        					</small>      
	     					</div>
	     					{/if}
						</div>
					</fieldset>
					
						
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
	</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>
