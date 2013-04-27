{{block name=config}}
  {{config_load file="default.conf" section="setup"}}
{{/block}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{#title#}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex" />
    <meta name="slurp" content="noindex" />

    <!-- Le styles -->
    {{block name=css_base}}
    <link href="static/css/bootstrap.css" rel="stylesheet">
    <link href="static/css/bootstrap-responsive.css" rel="stylesheet">
    {{/block}}
    {{block name=css}}{{/block}}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{block name=js_top}}{{/block}}

    <!-- Fav and touch icons 
    {{block name=ico}}
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./../static/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./../static/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./../static/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./../static/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="./../static/ico/favicon.png">
    {{/block}}
    -->
  </head>

  <body>
    {{block name=body}}{{/block}}

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{block name=js_base}}
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
            {{include file='static/js/common.js'}}
        </script>
        
    {{/block}}
    {{block name=js}}{{/block}}

  </body>
</html>
