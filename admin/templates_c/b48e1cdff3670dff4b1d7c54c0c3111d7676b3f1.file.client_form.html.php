<?php /* Smarty version Smarty-3.1.1, created on 2013-07-19 21:09:19
         compiled from "./templates/client/client_form.html" */ ?>
<?php /*%%SmartyHeaderCode:189886503551e9d52f912616-92423988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b48e1cdff3670dff4b1d7c54c0c3111d7676b3f1' => 
    array (
      0 => './templates/client/client_form.html',
      1 => 1370203056,
      2 => 'file',
    ),
    '06350e0bc6d4c08c2c8027ddf6634edabe7802e8' => 
    array (
      0 => '/var/www/crlimpezas/admin/templates/include/_base_login.tpl',
      1 => 1370203056,
      2 => 'file',
    ),
    '9e14254371049bdb78e81cc6d3d1ca43c91d1d3a' => 
    array (
      0 => './templates/include/_base.tpl',
      1 => 1370203056,
      2 => 'file',
    ),
    '579069f7d409250b3bd0856dbf84bcf9e19e6922' => 
    array (
      0 => './templates/include/_menu_top.tpl',
      1 => 1370203056,
      2 => 'file',
    ),
    '77114507ddc88a7d9c11b6913359f810dbf19717' => 
    array (
      0 => './templates/include/_menu_left.tpl',
      1 => 1370203056,
      2 => 'file',
    ),
    '795765c782c639527c4f97dedf72c3faa7d0c8ab' => 
    array (
      0 => './templates/include/_msg.tpl',
      1 => 1370203056,
      2 => 'file',
    ),
    'daa06199abcab9d39c075f9f933b7217e6fbc75e' => 
    array (
      0 => 'static/js/common.js',
      1 => 1370203056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189886503551e9d52f912616-92423988',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51e9d52fb7cf7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e9d52fb7cf7')) {function content_51e9d52fb7cf7($_smarty_tpl) {?>
  <?php  $_config = new Smarty_Internal_Config("default.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("client", 'local'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_smarty_tpl->getConfigVariable('title');?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex" />
    <meta name="slurp" content="noindex" />

    <!-- Le styles -->
    
    <link href="static/css/bootstrap.css" rel="stylesheet">
    <link href="static/css/bootstrap-responsive.css" rel="stylesheet">
    
    
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons 
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./../static/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./../static/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./../static/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./../static/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="./../static/ico/favicon.png">
    
    -->
  </head>

  <body>
    

	<?php /*  Call merged included template "include/_menu_top.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("include/_menu_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '189886503551e9d52f912616-92423988');
content_51e9d52f9e488($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "include/_menu_top.tpl" */?>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
        <?php /*  Call merged included template "include/_menu_left.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("include/_menu_left.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '189886503551e9d52f912616-92423988');
content_51e9d52fa181f($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "include/_menu_left.tpl" */?>
      </div><!--/span-->
      <div class="span9">
        <?php /*  Call merged included template "include/_msg.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("include/_msg.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '189886503551e9d52f912616-92423988');
content_51e9d52fa7d00($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "include/_msg.tpl" */?>
        
	<ul class="breadcrumb">
	    <li><span class="divider">/</span></li>
	    <li><a href="<?php echo $_smarty_tpl->getConfigVariable('page');?>
">Clientes</a> <span class="divider">/</span></li>
	    <li class="active">Formulário</li>
	</ul>

	<form action="<?php echo $_smarty_tpl->getConfigVariable('page');?>
" method="POST">
		<div>
			<label>Nome</label>
			<input class="input-block-level" name="nome" type="text" placeholder="digite o nome" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->nome;?>
">
			<label>Endereço</label>
			<input class="input-block-level" name="endereco" type="text" placeholder="digite o endereço" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->endereco;?>
">
			<label>Bairro</label>
			<input class="input-block-level" name="bairro" type="text" placeholder="digite o bairro" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->bairro;?>
">
			<label>Telefone / Celular</label>
			<input class="input-block-level" name="telefone" type="text" placeholder="digite o telefone ou celular" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->telefone;?>
">
			<label>E-mail</label>
			<input class="input-block-level" name="email" type="text" placeholder="digite o e-mail" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->email;?>
">
		</div>

		<div class="form-actions">
			<input type="hidden" name="data_cadastro" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->data_cadastro;?>
">
			<input type="hidden" name="id_clientes" value="<?php echo $_smarty_tpl->tpl_vars['post']->value->id_clientes;?>
">
			<input type="hidden" name="action" value="SAVE">
			<button type="submit" class="btn btn-primary">Salvar</button>
			<button type="button" class="btn" onclick="location.href='<?php echo $_smarty_tpl->getConfigVariable('page');?>
'">Cancelar</button>
		</div>
	</form>

      </div><!--/span-->
    </div><!--/row-->

    <hr>

  </div><!--/.fluid-container-->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
        <script src="static/js/jquery.js"></script>
        <script src="static/js/bootstrap-transition.js"></script>
        <script src="static/js/bootstrap-alert.js"></script>
        <script src="static/js/bootstrap-modal.js"></script>
        <script src="static/js/bootstrap-dropdown.js"></script>
        <script src="static/js/bootstrap-scrollspy.js"></script>
        <script src="static/js/bootstrap-tab.js"></script>
        <script src="static/js/bootstrap-tooltip.js"></script>
        <script src="static/js/bootstrap-popover.js"></script>
        <script src="static/js/bootstrap-button.js"></script>
        <script src="static/js/bootstrap-collapse.js"></script>
        <script src="static/js/bootstrap-carousel.js"></script>
        <script src="static/js/bootstrap-typeahead.js"></script>
        <script>
            <?php /*  Call merged included template "static/js/common.js" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('static/js/common.js', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '189886503551e9d52f912616-92423988');
content_51e9d52fb43fc($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "static/js/common.js" */?>
        </script>
        
    

  </body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.1, created on 2013-07-19 21:09:19
         compiled from "./templates/include/_menu_top.tpl" */ ?>
<?php if ($_valid && !is_callable('content_51e9d52f9e488')) {function content_51e9d52f9e488($_smarty_tpl) {?><div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">CR Admin</a>
      <div class="nav-collapse collapse">
        <p class="navbar-text pull-right">
          Olá, <?php echo $_SESSION['nome'];?>
. <a href="index.php" class="navbar-link">Clique aqui para sair</a>
        </p>
        <!--
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        -->
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div><?php }} ?><?php /* Smarty version Smarty-3.1.1, created on 2013-07-19 21:09:19
         compiled from "./templates/include/_menu_left.tpl" */ ?>
<?php if ($_valid && !is_callable('content_51e9d52fa181f')) {function content_51e9d52fa181f($_smarty_tpl) {?><div class="well sidebar-nav">
  <ul class="nav nav-list">
    <li class="nav-header">Menu</li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='client'){?>class='active'<?php }?>><a href="client.php">Clientes</a></li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='ordered'){?>class='active'<?php }?>><a href="ordered.php">Pedidos</a></li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='payment'){?>class='active'<?php }?>><a href="payment.php">Pagamentos</a></li>
    <li class="nav-header">Relatórios</li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='today'){?>class='active'<?php }?>><a href="report.php?action=today">Orçamentos de Hoje</a></li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='noresponse'){?>class='active'<?php }?>><a href="report.php?action=noresponse">Orçamentos Sem Resposta</a></li>
    <!--
    <li class="nav-header">Ajuda</li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='password'){?>class='active'<?php }?>><a href="#">Trocar Senha</a></li>
    <li <?php if ($_smarty_tpl->getConfigVariable('active')=='status'){?>class='active'<?php }?>><a href="#">Sobre Status</a></li>
    -->
  </ul>
</div><!--/.well --><?php }} ?><?php /* Smarty version Smarty-3.1.1, created on 2013-07-19 21:09:19
         compiled from "./templates/include/_msg.tpl" */ ?>
<?php if ($_valid && !is_callable('content_51e9d52fa7d00')) {function content_51e9d52fa7d00($_smarty_tpl) {?>
<?php if ($_SESSION['success']){?>
	<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><?php echo $_SESSION['success'];?>
</span>
    </div>
<?php }?>

<?php if ($_SESSION['alert']){?>
	<div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><strong>Ops!</strong> <?php echo $_SESSION['alert'];?>
</span>
    </div>
<?php }?>

<?php if ($_SESSION['error']){?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><strong>Ops!</strong> <?php echo $_SESSION['error'];?>
</span>
    </div>
<?php }?>

<?php if ($_SESSION['info']){?>
	<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><?php echo $_SESSION['info'];?>
</span>
    </div>
<?php }?><?php }} ?><?php /* Smarty version Smarty-3.1.1, created on 2013-07-19 21:09:19
         compiled from "static/js/common.js" */ ?>
<?php if ($_valid && !is_callable('content_51e9d52fb43fc')) {function content_51e9d52fb43fc($_smarty_tpl) {?>$(document).delegate('.action-form','click',function(){
	var data = $(this).parents("tr").attr("data");
	data = $.parseJSON(data);
	location.href="<?php echo $_smarty_tpl->getConfigVariable('page');?>
?action=form&id="+data.id;
});
$(document).delegate('.action-remove','click',function(){
	var data = $(this).parents("tr").attr("data");
	data = $.parseJSON(data);
	if (confirm("Deseja realmente apagar?")) {
		location.href="<?php echo $_smarty_tpl->getConfigVariable('page');?>
?action=remove&id="+data.id;
	}
});
$(document).delegate('.action-status-show','click',function(){
	var $fieldset = $(this).parents("fieldset");
	$('blockquote', $fieldset).removeClass('hidden');
	$(this).removeClass('muted');
});
$(document).delegate('.action-status-form-show','click',function(){
	$('.action-status-form').removeClass('hidden');
	$(this).addClass('disabled');
});
$(document).delegate('.action-status-form-close','click',function(){
	$('.action-status-form').addClass('hidden');
	$('.action-status-form-show').removeClass('disabled');
});
$(".container-fluid").delegate(".action-add","click",function(){
	location.href = "<?php echo $_smarty_tpl->getConfigVariable('page');?>
?action=form";
});<?php }} ?>