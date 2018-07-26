<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">Space Veículos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php?pg=locacao">Locações</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php?pg=cliente">Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php?pg=filial">Filiais</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php?pg=funcionario">Funcionários</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php?pg=veiculo">Veículos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Outros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="home.php?pg=categoria">Categorias</a>
          <a class="dropdown-item" href="home.php?pg=modelo">Modelos</a>
          <a class="dropdown-item" href="home.php?pg=marca">Marcas</a>
          <a class="dropdown-item" href="home.php?pg=cor">Cores</a>
        </div>
      </li>
    </ul>
  </div>
  <div class="col-2 mr-auto">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fa fa-cog fa-lg"></i>
     </button>
     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <h6 class="dropdown-header"><?php echo $_SESSION['login']['nome']; ?></h6>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#alterarModal">Alterar senha</a>
      <a class="dropdown-item" href="login.php?acao=logout">Logout</a>
    </div>
  </div>
</div>
</nav>

<!-- Modal alterar senha -->
<div class="modal fade" id="alterarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="php/acaoFuncionario.php?acao=updateSenha" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="hidden" name="idFunc" value="<?php echo $_SESSION['login']['idUser']; ?>">
                <label class="form-control-label">Senha Atual</label>
                <input type="password" class="form-control" name="senhaAtual">
              </div>
              <div class="form-group">
                <label class="form-control-label">Nova Senha</label>
                <input type="password" class="form-control" name="novaSenha">
              </div>
              <div class="form-group">
                <label class="form-control-label">Confirmar Senha</label>
                <input type="password" class="form-control" name="confirmacaoSenha">
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Alterar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </div>
      </form>
    </div>
  </div>
</div>