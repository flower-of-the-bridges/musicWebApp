<?php
/* Smarty version 3.1.32, created on 2018-05-17 19:04:57
  from '/opt/lampp/htdocs/programmazione_web/smarty/templates/profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdb639501846_96749918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79f432099a448662d0c74cd1257603c74685bb1d' => 
    array (
      0 => '/opt/lampp/htdocs/programmazione_web/smarty/templates/profile.tpl',
      1 => 1526576651,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
    'file:userInfo.tpl' => 1,
    'file:SongList.tpl' => 1,
    'file:Song.tpl' => 1,
    'file:followOptions.tpl' => 1,
  ),
),false)) {
function content_5afdb639501846_96749918 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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


	<?php $_smarty_tpl->_subTemplateRender("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<?php $_smarty_tpl->assign('pType',$_smarty_tpl->smarty->registered_objects['profile'][0]->getType(array(),$_smarty_tpl));?>
 
	<?php $_smarty_tpl->assign('pName',$_smarty_tpl->smarty->registered_objects['profile'][0]->getName(array(),$_smarty_tpl));?>

	<div class="container text-center">
		<br></br>
		<div class="row">
			<?php $_smarty_tpl->_subTemplateRender("file:userInfo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<div class="container text-center">

				<div class="col-sm-7 well">
					<?php if ($_smarty_tpl->tpl_vars['content']->value == 'Song List') {?>
						<?php $_smarty_tpl->_subTemplateRender("file:SongList.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php } elseif ($_smarty_tpl->tpl_vars['content']->value == 'Song') {?>
						<?php $_smarty_tpl->_subTemplateRender("file:Song.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php }?>
				</div>
				<div class="col-sm-2 well">
					<?php $_smarty_tpl->_subTemplateRender("file:followOptions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>				
				</div>
			</div>

		</div>
	</div>

</body>
</html>
<?php }
}
