<?php
/* Smarty version 3.1.32, created on 2018-05-20 19:16:17
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/userInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b01ad61031ac1_49611635',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ee1a1088f1ac92e51d05fae0674249478c4aab3' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/userInfo.tpl',
      1 => 1526726365,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b01ad61031ac1_49611635 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="well">				
	<p id="important"><?php echo $_smarty_tpl->smarty->registered_objects['profile'][0]->getName(array(),$_smarty_tpl);?>
</p>
	<img	src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237"
					class="img-circle" alt="Avatar" width="165" height="150">
</div>
<?php if ($_smarty_tpl->tpl_vars['pType']->value == 'musician') {?>
<div class="well">
	<p id="important">Genre</p>
	<p>	<span class="label label-primary"><?php echo $_smarty_tpl->smarty->registered_objects['profile'][0]->getGenre(array(),$_smarty_tpl);?>
</span> </p>
</div>
<?php }?>
<div class="well">
	<p id="important">Info</p>
	<p>Sono un musicista, suono e produco canzoni perche mi piace</p>
</div>
<div class="well">
	<button type="button" class="btn btn-primary">Follower</button>
	<button type="button" class="btn btn-primary">Following</button>
	<br></br> 
	<?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value) {?>
	<p> <a href="#">Modifica profilo </a> </p>
	<?php }?>
</div>
<?php }
}
