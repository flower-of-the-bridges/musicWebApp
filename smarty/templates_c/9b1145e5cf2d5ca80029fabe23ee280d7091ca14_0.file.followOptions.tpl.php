<?php
/* Smarty version 3.1.32, created on 2018-05-18 00:10:40
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/followOptions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdfde0d5de98_02795725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b1145e5cf2d5ca80029fabe23ee280d7091ca14' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/followOptions.tpl',
      1 => 1526594291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdfde0d5de98_02795725 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="well">
	<h4>Do you like my music?</h4>
	<br></br>
	<button type="button" class="btn btn-primary">Follow</button>
	<br></br>
	<button type="button" class="btn btn-primary">Support</button>
	<br></br> 
	<?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value && $_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
	<p>	<a href="#">Gestione supporti </a>	</p>
	<?php }?>
</div>

<?php }
}
