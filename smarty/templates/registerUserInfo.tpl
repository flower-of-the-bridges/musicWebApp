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
			{/if}

			<h2>Register Info</h2>
					
			
				<form method="post" id="info" enctype="multipart/form-data" action="editInfo">
					
  					<fieldset class="form-group">
  						<legend></legend>
						{if $uType!='musician'}
							
						<div class="form-group row">
							<label for="FirstName" class="col-sm-2 col-form-label {if !$check.firstName} text-danger{/if}">
								First Name: *
							</label> 
							<div class="col-sm-7">
								<input type="text" class="form-control" name="firstName" 
								{if $uInfo->getFirstName()}
									value="{$uInfo->getFirstName()}"
								{/if}
								placeholder="Enter your first name...">
							</div>
							{if !$check.firstName}
							<div class="col-sm-3">
	        					<small id="nameHelp" class="text-danger">
	          						Must be 3-20 characters long.
	        					</small>      
	     					</div>
	     					{/if}
								
							</div>
							
							<div class="form-group row">
								<label for="LastName" class="col-sm-2 col-form-label {if !$check.lastName} text-danger{/if}">
									Last Name: *
								</label> 
								<div class="col-sm-7">
									<input type="text" class="form-control" name="lastName" 
									{if $uInfo->getLastName()}
										value="{$uInfo->getLastName()}"
									{/if}
									placeholder="Enter your last name...">
								</div>
								{if !$check.lastName}
								<div class="col-sm-3">
	        						<small id="surHelp" class="text-danger">
	          							Must be 3-20 characters long.
	        						</small>      
	     						</div>
	     						{/if}
							</div>
						
						{/if}
					
						<div class="form-group row">
							<label for="BirthPlace" class="col-sm-2 col-form-label {if !$check.birthPlace} text-danger{/if}">
								Birth Place: *
							</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="birthPlace" 
									{if $uInfo->getBirthPlace()}
										value="{$uInfo->getBirthPlace()}"
									{/if}
								placeholder="Enter your birth place...">
							</div>
							{if !$check.birthPlace}
							<div class="col-sm-3">
	        						<small id="dateHelp" class="text-danger">
	          							Must be 3-20 characters long
	        						</small>      
	     					</div>
	     					{/if}
						</div>
	
						<div class="form-group row">
							<label for="BirthDate" class="col-sm-2 col-form-label {if !$check.birthDate} text-danger{/if}">
								Birth Date: *
							</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="birthDate" 
									{if $uInfo->getBirthDate(true)}
										value="{$uInfo->getBirthDate(true)}"
									{/if}
									placeholder="Enter your birth date... (dd/mm/aaaa)">
							</div>
							{if !$check.birthDate}
							<div class="col-sm-3">
	        					<small id="dateHelp" class="text-danger">
	          						Must be in format dd/mm/yyyy.
	        					</small>      
	     					</div>
	     					{/if}
						</div>
	
						<div class="form-group row">
							<label for="Bio" class="col-sm-2 col-form-label {if !$check.bio} text-danger{/if}">
								Bio : *
							</label>
							<div class="col-sm-7">
								<textarea form="info" class="form-control" name="bio" 
								{if $uInfo->getBio()}
									value="{$uInfo->getBio()}"
								{/if}
								placeholder="Say something about yourself..."></textarea>
							</div>
							{if !$check.bio}
							<div class="col-sm-3">
	        					<small id="bioHelp" class="text-danger">
	          						No strange characters!
	        					</small>      
	     					</div>
	     					{/if}
						</div>
					</fieldset>
					<fieldset class="form-group">
  						<legend></legend>
  						<div class="form-group row">
    						<label for="exampleInputFile">Select Profile Pic: *</label>
    						<input type="file" class="form-control-file" name="file">
  						</div>
					</fieldset>
						
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
	</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>