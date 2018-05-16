<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>User Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>    
    /* Set black background image, to be moved in .css file */
   body {
    background-color: black;
    background: url(http://s1.bwallpapers.com/wallpapers/2014/02/11/white-full-hd-desktop-wallpaper_0924518.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
   }
  </style>
</head>
<body>
{user->getType assign='uType'}
{user->getName assign='uName'}
<nav class="navbar navbar-inverse-dark">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.html">Deep Music</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        {if $uType == "guest"}
	<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
        {else}
        <li><a href="profile.html"><span class="glyphicon glyphicon-user"></span> {$uName}'s Account </a></li>
        {/if} 
        {if $uType == "musician"}
        <li><a href="load.html"><span class="glyphicon glyphicon-cd"></span> Add Song </a></li>
        {/if}
      </ul>
      <form class="navbar-form navbar-right" method="post" action="search.php" role="search" >    
        <div class="form-group input-group">
          
          <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" >
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
    
    </div>
  </div>
</nav>
{profile->getType assign='pType'}
{profile->getName assign='pName'}
<div class="container text-center">    
     <br></br>
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#">{profile->getName}</a></p>
        <img src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237" class="img-circle" alt="Avatar" width="165" height="150">
      </div>
      {if $pType=='musician'}
      <div class="well">
        <p><a href="#">Genre </a></p>
        <p>
          
          <span class="label label-primary">Rock n Roll</span>
          
           
        </p>
      </div>
      {/if}
      <div class="well">
        <p><a href="#">Info</a></p>
        <p>Sono un musicista, suono e produco canzoni perche mi piace</p>
      </div>
      <button type="button" class="btn btn-primary">Follower (int)</button>
      <button type="button" class="btn btn-primary">Following (int)</button>
      <br></br>
      {if $uName == $pName}
      <p><a href="#">Modifica profilo </a></p>
      {/if}
    </div>
    <div class="container text-center">  
   
    <div class="col-sm-7 well">
      
      <h4>Songs List</h4>
     <table class="table table-responsive">
    <tbody>
      {foreach $songs as $song}
      <tr>
        <td><a href="download.php?id={$song->getId()}">{$song->getName()}</a></td>
        <td>{$song->getGenre()}</td>
        {if $pName==$uName}
        <td><a href="#"><span class="glyphicon glyphicon-pencil"></span> Edit Song </a></td>
        {/if}
      </tr>
     {/foreach}
    </tbody>
  </table>         
  </div>
<div class="col-sm-2 well">
      
      <div class="container-fluid">
	<h>Ti piace la mia musica?</h>
        <br></br>
        <button type="button" class="btn btn-primary">Seguimi</button> 
	<br></br> 
        <button type="button" class="btn btn-primary">Supportami</button>  
      </div>            
      <br></br>
      {if $uName == $pName && $uType == "musician"}
      <p><a href="#">Gestione supporti </a></p>
      <br></br>
      {/if}
    </div>
</div>







</div>
</div>
</body>
</html>
