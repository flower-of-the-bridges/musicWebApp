<?php
/* Smarty version 3.1.32, created on 2018-05-17 23:01:54
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/Song.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdedc2deb443_83360120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89cf0a1186254c42b2a03390e1ebb9bce2f2514d' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/Song.tpl',
      1 => 1526576504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdedc2deb443_83360120 (Smarty_Internal_Template $_smarty_tpl) {
?><h4><?php echo $_smarty_tpl->tpl_vars['song']->value->getArtist()->getName();?>
 : <?php echo $_smarty_tpl->tpl_vars['song']->value->getName();?>
 (<?php echo $_smarty_tpl->tpl_vars['song']->value->getGenre();?>
)</h4>
<audio controls="controls" autoplay="">
	<source src="<?php echo $_smarty_tpl->tpl_vars['mp3']->value->getMp3();?>
" type="<?php echo $_smarty_tpl->tpl_vars['mp3']->value->getType();?>
">
</audio><?php }
}
