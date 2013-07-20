{{* Smarty *}}
{{if $smarty.session.success}}
	<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span>{{$smarty.session.success}}</span>
    </div>
{{/if}}

{{if $smarty.session.alert}}
	<div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><strong>Ops!</strong> {{$smarty.session.alert}}</span>
    </div>
{{/if}}

{{if $smarty.session.error}}
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span><strong>Ops!</strong> {{$smarty.session.error}}</span>
    </div>
{{/if}}

{{if $smarty.session.info}}
	<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span>{{$smarty.session.info}}</span>
    </div>
{{/if}}