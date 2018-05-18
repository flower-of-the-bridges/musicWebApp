<?php
/* Smarty version 3.1.32, created on 2018-05-17 18:55:08
  from '/opt/lampp/htdocs/programmazione_web/smarty/templates/pageContent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdb3ec7181e3_11368252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5144d86778efbb88f9a5d104fe854f7e6e5bf005' => 
    array (
      0 => '/opt/lampp/htdocs/programmazione_web/smarty/templates/pageContent.tpl',
      1 => 1526575097,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdb3ec7181e3_11368252 (Smarty_Internal_Template $_smarty_tpl) {
?>

					<h4 id="important">Songs List</h4>
					<table class="table table-responsive">
						<tbody>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['songs']->value, 'song');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['song']->value) {
?>
							<tr>
								<td><a href="download.php?id=<?php echo $_smarty_tpl->tpl_vars['song']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['song']->value->getName();?>
</a></td>
								<td><?php echo $_smarty_tpl->tpl_vars['song']->value->getGenre();?>
</td> 
								<?php if ($_smarty_tpl->tpl_vars['pName']->value == $_smarty_tpl->tpl_vars['uName']->value) {?>
								<td><a href="#"><span
										class="glyphicon glyphicon-pencil"></span> Edit Song </a></td> 
							    <?php }?>
							</tr>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</tbody>
					</table>
		
<?php }
}
