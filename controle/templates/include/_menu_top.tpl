<div class="navbar navbar-inverse navbar-fixed-top">
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
          Olá, {{$smarty.session.nome}}. <a href="index.php" class="navbar-link">Clique aqui para sair</a>
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
</div>