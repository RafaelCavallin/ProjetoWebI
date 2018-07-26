<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

$link = connect(); 

  // RETORNA ID E NOME DOS CLIENTES
    $sqlClientes = 'SELECT id_cliente, nome 
                    FROM clientes';

      $result = executa($sqlClientes, $link);
      $resultClientes = listaRegistros($result);

    //RETORNA ID E DESCRICAO DAS MARCAS
    $sqlMarcas = 'SELECT id_marca, descricao_marca
                  FROM marcas';

      $result = executa($sqlMarcas, $link);
      $resultMarcas = listaRegistros($result);

    //RETORNA ID E DESCRICAO DAS MARCAS
    $sqlModelos = 'SELECT id_modelo, descricao
                  FROM modelos';

      $result = executa($sqlModelos, $link);
      $resultModelos = listaRegistros($result);

    //RETORNA ID E NOME DO FUNCIONARIO
    $sqlFuncionarios = 'SELECT id_usuario, nome
                  FROM funcionarios';

      $result = executa($sqlFuncionarios, $link);
      $resultFuncionarios = listaRegistros($result);


?>

<h1 class="my-4 display-3"> <i class="fa fa-user text-primary"></i> Locações de Veículos</h1>
<form action="php/acaoLocacao.php?acao=insert" method="POST">
	<div class="row">
    <div class="form-group col-4">
      <select class="form-control" name="cliente" id="cliente" required>
        <option value="">Selecione o Cliente</option>

        <?php  
          foreach ($resultClientes as $valor) {
            echo '<option value="'. $valor['id_cliente'] . '">' . $valor['nome'] .'</option>';
          }
        ?>

      </select>
    </div>
    <div class="form-group col-4">
      <select class="form-control" name="marca" id="marca" required>
        <option value="">Selecione a Marca</option>

        <?php  
          foreach ($resultMarcas as $valor) {
            echo '<option value="'. $valor['id_marca'] . '">' . $valor['descricao_marca'] .'</option>';
          }
        ?>

      </select>
    </div>
    <div class="form-group col-4">
      <select class="form-control" name="modelo" id="modelo" required>
        <option value="">Selecione o Modelo</option>

        <?php  
          foreach ($resultModelos as $valor) {
            echo '<option value="'. $valor['id_modelo'] . '">' . $valor['descricao'] .'</option>';
          }
        ?>

      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <select class="form-control" name="func" required>
        <option value="">Selecione o Funcionário</option>

        <?php  
          foreach ($resultFuncionarios as $valor) {
            echo '<option value="'. $valor['id_usuario'] . '">' . $valor['nome'] .'</option>';
          }
        ?>

      </select>
    </div>
    <div class="form-group col-4">
      <input type="text" name="dataRet" class="form-control" placeholder="Data de Retirada" data-mask="00/00/0000" required>
    </div>
    <div class="form-group col-4">
      <input type="text" name="dataEnt" class="form-control" placeholder="Data de Entrega" data-mask="00/00/0000" required>
    </div>
  </div>                        
  <div class="row">
    <div class="form-group col-6">
      <input type="submit" class="btn btn-success btn-block" value="Cadastrar">
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
        <th scope="col">Cliente</th>
        <th scope="col">Veículo</th>
        <th scope="col">Funcionário</th>
        <th scope="col">Retirada</th>
        <th scope="col">Devolução</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        $sql ='SELECT * 
                FROM locacoes';

          $result = executa($sql, $link);
          $result = listaRegistros($result);


        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_locacao'] . '</td>';
          echo '<td>' . $valor['id_cliente'] . '</td>';
          echo '<td>' . $valor['id_veiculo'] . '</td>';
          echo '<td>' . $valor['id_funcionario'] . '</td>';
          echo '<td>' . $valor['data_retirada'] . '</td>';
          echo '<td>' . $valor['data_entrega'] . '</td>';
          echo '<td><a href="php/acaoLocacao.php?acao=del&id_loc=' . $valor['id_locacao'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a><a class="ml-4" href="home.php?pg=locacao&acao=update&id_filial=' . $valor['id_locacao'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>