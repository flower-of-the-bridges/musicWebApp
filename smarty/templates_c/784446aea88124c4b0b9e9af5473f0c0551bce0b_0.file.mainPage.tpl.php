<?php
/* Smarty version 3.1.32, created on 2018-05-17 18:35:51
  from '/opt/lampp/htdocs/programmazione_web/smarty/templates/mainPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afdaf67cc33c5_03066044',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '784446aea88124c4b0b9e9af5473f0c0551bce0b' => 
    array (
      0 => '/opt/lampp/htdocs/programmazione_web/smarty/templates/mainPage.tpl',
      1 => 1526574902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afdaf67cc33c5_03066044 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container text-center">
		<br></br>
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well" >
					<p id="important">
						<?php echo $_smarty_tpl->smarty->registered_objects['profile'][0]->getName(array(),$_smarty_tpl);?>

					</p>
					<img
						src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237"
						class="img-circle" alt="Avatar" width="165" height="150">
				</div>
				<?php if ($_smarty_tpl->tpl_vars['pType']->value == 'musician') {?>
				<div class="well">
					<p id="important">
						Genre 
					</p>
					<p>
						<span class="label label-primary">Rock n Roll</span>
					</p>
				</div>
				<?php }?>
				<div class="well">
					<p id="important">
						Info
					</p>
					<p>Sono un musicista, suono e produco canzoni perche mi piace</p>
				</div>
				<button type="button" class="btn btn-primary">Follower
					</button>
				<button type="button" class="btn btn-primary">Following
					</button>
				<br></br> 
				<?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value) {?>
				<p>
					<a href="#">Modifica profilo </a>
				</p>
				<?php }?>
			</div>
			<div class="container text-center">

				<div class="col-sm-7 well">

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
				</div>
				<div class="col-sm-2 well">

					<div class="container-fluid">
						<h4>Do you like my music?</h4>
						<br></br>
						<button type="button" class="btn btn-primary">Follow</button>
						<br></br>
						<button type="button" class="btn btn-primary">Support</button>
					</div>
					<br></br> 
					<?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value && $_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
					<p>
						<a href="#">Gestione supporti </a>
					</p>
					<?php }?>
				</div>
			</div>

		</div>
	</div>
<?php }
}
