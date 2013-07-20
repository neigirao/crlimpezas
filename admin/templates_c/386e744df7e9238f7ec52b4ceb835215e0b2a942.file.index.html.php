<?php /* Smarty version Smarty-3.1.1, created on 2013-06-02 17:03:07
         compiled from "./templates/index.html" */ ?>
<?php /*%%SmartyHeaderCode:102472998951aba4fb976814-19714545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '386e744df7e9238f7ec52b4ceb835215e0b2a942' => 
    array (
      0 => './templates/index.html',
      1 => 1370203056,
      2 => 'file',
    ),
    '9e14254371049bdb78e81cc6d3d1ca43c91d1d3a' => 
    array (
      0 => './templates/include/_base.tpl',
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
  'nocache_hash' => '102472998951aba4fb976814-19714545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51aba4fbab42c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51aba4fbab42c')) {function content_51aba4fbab42c($_smarty_tpl) {?>
  <?php  $_config = new Smarty_Internal_Config("default.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

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
    
   <link href="./static/css/bootstrap.css" rel="stylesheet">
   <link href="./static/css/bootstrap-responsive.css" rel="stylesheet">
   <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons 
    
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./static/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./static/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./static/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="./static/ico/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="./static/ico/favicon.png">

    -->
  </head>

  <body>
    
    <div class="container">

      <form class="form-signin" action="/report" method="post">
        <h2 class="form-signin-heading">Acesso</h2>
        <div class="area-alert"></div>
        <input type="text" class="input-block-level" placeholder="usuário" name="usuario">
        <input type="password" class="input-block-level" placeholder="senha" name="senha">

        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="./static/js/jquery.js"></script>
    <script src="./static/js/bootstrap-transition.js"></script>
    <script src="./static/js/bootstrap-alert.js"></script>
    <script src="./static/js/bootstrap-modal.js"></script>
    <script src="./static/js/bootstrap-dropdown.js"></script>
    <script src="./static/js/bootstrap-scrollspy.js"></script>
    <script src="./static/js/bootstrap-tab.js"></script>
    <script src="./static/js/bootstrap-tooltip.js"></script>
    <script src="./static/js/bootstrap-popover.js"></script>
    <script src="./static/js/bootstrap-button.js"></script>
    <script src="./static/js/bootstrap-collapse.js"></script>
    <script src="./static/js/bootstrap-carousel.js"></script>
    <script src="./static/js/bootstrap-typeahead.js"></script>
    <script src="./static/js/common.js"></script>

    
  <script>
    var $form_login = $(".form-signin");
    var msg_alert = [
      '<div class="alert">',
        '<button type="button" class="close" data-dismiss="alert">&times;</button>',
        '{MSG}',
      '</div>'
    ].join('');

    show_message_error = function(msg){
      $(".btn-primary", $form_login).removeClass("disabled");
      var html = msg_alert.replace("{MSG}", msg);
      $(".area-alert", $form_login).append(html);
    }

    $(".form-signin").submit(function(){
      $(".alert").remove();
      var $self = $(this);
      var data_login = $form_login.serialize();
      if (!$(".btn-primary", $self).hasClass("disabled")){
        $(".btn-primary", $self).addClass("disabled");
        $.ajax({
          type: "POST",
          url: "index.php",
          data: "action=login&" + data_login,
          timeout: 4000,
          success: function(response){
            var data = jQuery.parseJSON(response);
            if(data.message === "AUTHENTICATED"){
              location.href = "report.php";
            }else if(data.message === "NOT_FOUND"){
              show_message_error("usuário não encontrado");
            }else if(data.message === "PASSWORD_INVALID"){
              show_message_error("senha inválida");
            }else {
              show_message_error("entre em contato com o ADM");
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            var data = jQuery.parseJSON(jqXHR.responseText);
            show_message_error(data.errorMsg);
          }
        });
      }
      return false;
    });

        
  </script>


  </body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.1, created on 2013-06-02 17:03:07
         compiled from "static/js/common.js" */ ?>
<?php if ($_valid && !is_callable('content_51aba4fba3522')) {function content_51aba4fba3522($_smarty_tpl) {?>$(document).delegate('.action-form','click',function(){
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