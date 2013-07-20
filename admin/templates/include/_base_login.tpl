{{extends file='include/_base.tpl'}}

{{block name=body}}

	{{include file="include/_menu_top.tpl"}}

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
        {{include file="include/_menu_left.tpl"}}
      </div><!--/span-->
      <div class="span9">
        {{include file="include/_msg.tpl"}}
        {{block name=body_login}}{{/block}}
      </div><!--/span-->
    </div><!--/row-->

    <hr>

  </div><!--/.fluid-container-->

{{/block}}