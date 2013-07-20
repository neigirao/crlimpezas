<div class="well sidebar-nav">
  <ul class="nav nav-list">
    <li class="nav-header">Menu</li>
    <li {{if #active# eq 'client'}}class='active'{{/if}}><a href="client.php">Clientes</a></li>
    <li {{if #active# eq 'ordered'}}class='active'{{/if}}><a href="ordered.php">Pedidos</a></li>
    <li {{if #active# eq 'payment'}}class='active'{{/if}}><a href="payment.php">Pagamentos</a></li>
    <li class="nav-header">Relatórios</li>
    <li {{if #active# eq 'today'}}class='active'{{/if}}><a href="report.php?action=today">Orçamentos de Hoje</a></li>
    <li {{if #active# eq 'noresponse'}}class='active'{{/if}}><a href="report.php?action=noresponse">Orçamentos Sem Resposta</a></li>
    <!--
    <li class="nav-header">Ajuda</li>
    <li {{if #active# eq 'password'}}class='active'{{/if}}><a href="#">Trocar Senha</a></li>
    <li {{if #active# eq 'status'}}class='active'{{/if}}><a href="#">Sobre Status</a></li>
    -->
  </ul>
</div><!--/.well -->