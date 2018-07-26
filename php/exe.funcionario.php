<?php
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

  $link = connect();

    $sql = 'SELECT id_usuario, nome, login, email 
            FROM funcionarios';

      $resultFuncionarios = executa($sql, $link);
      $result = listaRegistros($resultFuncionarios);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
      $email = '';
      $login = '';
      $dataNasc = '';
      $senha = '';
    }

    if ($_GET['acao'] == 'update') {

      $idFuncionarioUpdate = $_GET['id_usuario'];

      $sql = 'SELECT * 
          FROM funcionarios
          WHERE id_usuario =' .$idFuncionarioUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['nome'];
          $email = $value['email'];
          $login = $value['login'];
          $dataNasc = $value['data_nasc'];

            $dataNascUSA = explode("-", $dataNasc);
            $dataNasc = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

          $senha = $value['senha'];
        }
      }
    }
?>
<h1 class="my-4 display-3"> <i class="fa fa-user text-primary"></i> Cadastro de Funcionários</h1>
<form action="php/acaoFuncionario.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
	<div class="row">
        <div class="form-group col">
            <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionarioUpdate ?>">
            <input type="text" name="nome" class="form-control" placeholder="Nome" value="<?php echo $nome ?>" required>
        </div>
    	<div class="form-group col-4">
            <input type="text" name="login" class="form-control" placeholder="Login" value="<?php echo $login ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email ?>" required>
        </div>
        <div class="form-group col-4">
            <input type="password" name="senha" class="form-control" placeholder="Senha">
        </div>
        <div class="form-group col-4">
            <input type="text" name="dataNasc" class="form-control" placeholder="Data de Nascimento" data-mask="00/00/0000" value="<?php echo $dataNasc ?>" required>
        </div>
    </div>                        
    <div class="row">
        <div class="form-group col-6">
            <input type="submit" class="btn btn-success btn-block" value="Envia">
        </div>
        <div class="form-group col-6">
            <input type="reset" class="btn btn-danger btn-block" value="Cancelar">
        </div>
    </div>
</form>

<div class="row col mt-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Login</th>
          <th scope="col">Email</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>

          <?php 
            foreach ($result as $valor) {
              echo '<tr>';
              echo '<td>' . $valor['id_usuario'] . '</td>';
              echo '<td>' . $valor['nome'] . '</td>';
              echo '<td>' . $valor['login'] . '</td>';
              echo '<td>' . $valor['email'] . '</td>';
              echo '<td><a href="php/acaoFuncionario.php?acao=del&id_fun=' . $valor['id_usuario'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
              <a class="ml-4" href="home.php?pg=funcionario&acao=update&id_usuario=' . $valor['id_usuario'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
              echo '</tr>';
            }
          ?>

      </tbody>
    </table>
</div>