<div class="pagination pagination-centered" style="">
  <ul>
    {{assign var=page value=$search_page}}
    <li class="prev {{if $search_page eq 1}}disabled{{/if}}">
    	<a href="{{#page#}}?page={{math equation="total - 1" total=$search_page}}&{{$search_more}}">Anterior</a>
    </li>
    <li class="{{if $search_total eq 0}}disabled{{/if}}">
    	<a href="#">
    		{{math equation="page + 1 - 1" page=$page assign="page"}}
    		P&aacute;gina {{$page}} de {{if $search_total eq 0}}1{{else}}{{$search_total}}{{/if}}
    	</a>
    </li>
    <li class="next {{if $search_page ge $search_total}}disabled{{/if}}">
    	<a href="{{#page#}}?page={{math equation="total + 1" total=$search_page}}&{{$search_more}}">Pr&oacute;ximo</a>
    </li>
  </ul>
</div>