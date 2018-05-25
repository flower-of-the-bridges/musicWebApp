<?php
/* Smarty version 3.1.32, created on 2018-05-17 19:04:57
  from '/opt/lampp/htdocs/programmazione_web/smarty/templates/SongList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdb639514c29_07038082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed57f88fcd12d41e6bc273312359568c2d5a178f' => 
    array (
      0 => '/opt/lampp/htdocs/programmazione_web/smarty/templates/SongList.tpl',
      1 => 1526576691,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdb639514c29_07038082 (Smarty_Internal_Template $_smarty_tpl) {
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
								<td><a href="song.php?id=<?php echo $_smarty_tpl->tpl_vars['song']->value->getId();?>
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
