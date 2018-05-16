<?php
/* Smarty version 3.1.32, created on 2018-05-15 23:58:31
  from '/opt/lampp/htdocs/DeepMusic/smarty/templates/song.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afb5807725c57_14505034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55d05f0f35452883e901b9543edb1ccd1b20946e' => 
    array (
      0 => '/opt/lampp/htdocs/DeepMusic/smarty/templates/song.tpl',
      1 => 1526421502,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afb5807725c57_14505034 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>User Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
  <style>    
    /* Set black background image, to be moved in .css file */
   body {
    background-color: black;
    background: url(http://s1.bwallpapers.com/wallpapers/2014/02/11/white-full-hd-desktop-wallpaper_0924518.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
   }
  </style>
</head>
<body>
<?php $_smarty_tpl->assign('uType',$_smarty_tpl->smarty->registered_objects['user'][0]->getType(array(),$_smarty_tpl));?>

<?php $_smarty_tpl->assign('uName',$_smarty_tpl->smarty->registered_objects['user'][0]->getName(array(),$_smarty_tpl));?>

<nav class="navbar navbar-inverse-dark">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.html">Deep Music</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <?php if ($_smarty_tpl->tpl_vars['uType']->value == "guest") {?>
	<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
        <?php } else { ?>
        <li><a href="profile.html"><span class="glyphicon glyphicon-user"></span> <?php echo $_smarty_tpl->tpl_vars['uName']->value;?>
's Account </a></li>
        <?php }?> 
        <?php if ($_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
        <li><a href="load.html"><span class="glyphicon glyphicon-cd"></span> Add Song </a></li>
        <?php }?>
      </ul>
      <form class="navbar-form navbar-right" method="post" action="search.php" role="search" >    
        <div class="form-group input-group">
          
          <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" >
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
    
    </div>
  </div>
</nav>
<?php $_smarty_tpl->assign('pType',$_smarty_tpl->smarty->registered_objects['profile'][0]->getType(array(),$_smarty_tpl));?>

<?php $_smarty_tpl->assign('pName',$_smarty_tpl->smarty->registered_objects['profile'][0]->getName(array(),$_smarty_tpl));?>

<div class="container text-center">    
     <br></br>
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#"><?php echo $_smarty_tpl->smarty->registered_objects['profile'][0]->getName(array(),$_smarty_tpl);?>
</a></p>
        <img src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237" class="img-circle" alt="Avatar" width="165" height="150">
      </div>
      <?php if ($_smarty_tpl->tpl_vars['pType']->value == 'musician') {?>
      <div class="well">
        <p><a href="#">Genre </a></p>
        <p>
          
          <span class="label label-primary">Rock n Roll</span>
          
           
        </p>
      </div>
      <?php }?>
      <div class="well">
        <p><a href="#">Info</a></p>
        <p>Sono un musicista, suono e produco canzoni perche mi piace</p>
      </div>
      <button type="button" class="btn btn-primary">Follower (int)</button>
      <button type="button" class="btn btn-primary">Following (int)</button>
      <br></br>
      <?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value) {?>
      <p><a href="#">Modifica profilo </a></p>
      <?php }?>
    </div>
    <div class="container text-center">  
   
    <div class="col-sm-7 well">
      
      <h4><?php echo $_smarty_tpl->tpl_vars['song']->value->getArtist()->getName();?>
 : <?php echo $_smarty_tpl->tpl_vars['song']->value->getName();?>
 (<?php echo $_smarty_tpl->tpl_vars['song']->value->getGenre();?>
)</h4>
      <audio controls="controls" autoplay="">
        <source src="<?php echo $_smarty_tpl->tpl_vars['mp3']->value->getMp3();?>
" type="<?php echo $_smarty_tpl->tpl_vars['mp3']->value->getType();?>
">
      </audio>
  </div>
<div class="col-sm-2 well">
      
      <div class="container-fluid">
	<h>Ti piace la mia musica?</h>
        <br></br>
        <button type="button" class="btn btn-primary">Seguimi</button> 
	<br></br> 
        <button type="button" class="btn btn-primary">Supportami</button>  
      </div>            
      <br></br>
      <?php if ($_smarty_tpl->tpl_vars['uName']->value == $_smarty_tpl->tpl_vars['pName']->value && $_smarty_tpl->tpl_vars['uType']->value == "musician") {?>
      <p><a href="#">Gestione supporti </a></p>
      <br></br>
      <?php }?>
    </div>
</div>







</div>
</div>
</body>
</html>
<?php }
}
