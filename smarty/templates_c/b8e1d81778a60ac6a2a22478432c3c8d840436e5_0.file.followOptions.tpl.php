<?php
/* Smarty version 3.1.32, created on 2018-05-17 18:55:08
  from '/opt/lampp/htdocs/programmazione_web/smarty/templates/followOptions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdb3ec7302d7_60110385',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8e1d81778a60ac6a2a22478432c3c8d840436e5' => 
    array (
      0 => '/opt/lampp/htdocs/programmazione_web/smarty/templates/followOptions.tpl',
      1 => 1526575938,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdb3ec7302d7_60110385 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container-fluid">
					<h4>Do you like my music?</h4>
					<br></br>
					<button type="button" class="btn btn-primary">Follow</button>
					<br></br>
					<button type="button" class="btn btn-primary">Support</button>
				</div>
				<br></br> <?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value && $_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
				<p>
					<a href="#">Gestione supporti </a>
				</p>
				<?php }?>

<?php }
}
