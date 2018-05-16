<?php
/* Smarty version 3.1.32, created on 2018-05-16 15:31:28
  from 'C:\xampp\htdocs\musicWebApp\smarty\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afc32b02bc388_20487859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c5b0e1dfdec690d91a1f976d3e13fe0f7129ff9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\musicWebApp\\smarty\\templates\\index.tpl',
      1 => 1526475807,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afc32b02bc388_20487859 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Deep Music (Worst name ever)</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php echo '<script'; ?>

	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>

	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<style>
/* Set black background image, to be moved in .css file */
body {
	background-color: black;
	background:
		url(http://s1.bwallpapers.com/wallpapers/2014/02/11/white-full-hd-desktop-wallpaper_0924518.jpg)
		no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

container {
	background-color: #f0f0f0;
}
</style>
</head>
<body>
	<?php $_smarty_tpl->assign('output',$_smarty_tpl->smarty->registered_objects['user'][0]->getType(array(),$_smarty_tpl));?>

	<nav class="navbar navbar-inverse-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Deep Music</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php if ($_smarty_tpl->tpl_vars['output']->value == "guest") {?>
					<li><a href="login.html"><span
							class="glyphicon glyphicon-log-in"></span> Log In</a></li> 
					<?php } else { ?>
					<li><a href="profile.html"><span
							class="glyphicon glyphicon-user"></span> My Account </a></li> 
				    <?php }?> 
				    <?php if ($_smarty_tpl->tpl_vars['output']->value == "musician") {?>
					<li><a href="load.html"><span
							class="glyphicon glyphicon-cd"></span> Add Song </a></li> 
					<?php }?>
				</ul>
				<form class="navbar-form navbar-right" method="post"
					action="search.php" role="search">
					<div class="form-group input-group">

						<input type="text" class="form-control" placeholder="Search..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>

			</div>
		</div>
	</nav>

	<div class="container text-center well">
		<h3>The next generation of musicians!</h3>
		<p>Are you tired of the same old songs? Do you want something new?
		</p>
		<h3>This is the place where music lives again.</h3>
		<br>
		<div class="row">
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Create your Music!</strong>
				</p>
				<br> <img
					src="http://www.chrismcintyre.ca/wp-content/uploads/2015/06/Chris-McIntyre-5930.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">

			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Share it!</strong>
				</p>
				<br> <img
					src="https://s3.amazonaws.com/musicindustryhowtoimages/wp-content/uploads/2014/04/12072723/How-To-Get-People-To-Listen-To-Your-Music.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Be a Star!</strong>
				</p>
				<br> <img
					src="https://thumbs.dreamstime.com/t/silhouettes-people-music-festival-beach-41699585.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
		</div>
	</div>

</body>
</html>
<?php }
}
