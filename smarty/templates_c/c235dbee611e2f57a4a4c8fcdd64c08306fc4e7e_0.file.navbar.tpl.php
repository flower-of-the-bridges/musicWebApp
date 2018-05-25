<?php
/* Smarty version 3.1.32, created on 2018-05-25 19:30:00
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/navbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b08481829b6a9_31405275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c235dbee611e2f57a4a4c8fcdd64c08306fc4e7e' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/navbar.tpl',
      1 => 1527269327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b08481829b6a9_31405275 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="navbar navbar-inverse-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index">Deep Music</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php if ($_smarty_tpl->tpl_vars['uType']->value == "guest") {?>
					<li><a href="login"><span
							class="glyphicon glyphicon-log-in"></span> Log In</a></li>
				    <?php } else { ?>
					<li><a href="profile?id=<?php echo $_smarty_tpl->tpl_vars['uId']->value;?>
"><span
							class="glyphicon glyphicon-user"></span> <?php echo $_smarty_tpl->tpl_vars['uName']->value;?>
's Account </a></li>
					<?php if ($_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
					<li><a href="load"><span
							class="glyphicon glyphicon-cd"></span> Add Song </a></li> 
					<?php }?>
					<li><a href="logout"><span
							class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
					<?php }?> 
					
				</ul>
				<form class="navbar-form navbar-right" role="search" action="search">
					<div class="form-group input-group">
						<input type="text" class="form-control" name="str"  placeholder="Search..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
				<?php if ($_smarty_tpl->tpl_vars['uType']->value != "guest") {?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="search/advanced">Advanced Search</a></li>
				</ul>
				<?php }?>
			</div>
		</div>
	</nav>
<?php }
}
