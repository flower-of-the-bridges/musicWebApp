<?php
/* Smarty version 3.1.32, created on 2018-05-25 19:30:00
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b0848182903e0_44465373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e754dca9e678eb081aa6af2bd7cd223027f5b44d' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/index.tpl',
      1 => 1527269275,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
),false)) {
function content_5b0848182903e0_44465373 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Welcome to Deep Music!</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="smarty/templates/style.css">
<?php echo '<script'; ?>

	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>

	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</head>
<body>
	<?php $_smarty_tpl->assign('uType',$_smarty_tpl->smarty->registered_objects['user'][0]->getType(array(),$_smarty_tpl));?>
 
	<?php $_smarty_tpl->assign('uName',$_smarty_tpl->smarty->registered_objects['user'][0]->getName(array(),$_smarty_tpl));?>

	<?php $_smarty_tpl->assign('uId',$_smarty_tpl->smarty->registered_objects['user'][0]->getid(array(),$_smarty_tpl));?>


	<?php $_smarty_tpl->_subTemplateRender("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
