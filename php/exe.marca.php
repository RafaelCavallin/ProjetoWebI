<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

$link = connect();
 
  $sql = 'SELECT * 
          FROM marcas';

    $resultMarcas = executa($sql, $link);
    $result = listaRegistros($resultMarcas);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
    }

    if ($_GET['acao'] == 'update') {

      $idMarcaUpdate = $_GET['id_marca'];

      $sql = 'SELECT * 
          FROM marcas
          WHERE id_marca =' .$idMarcaUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['descricao_marca'];
        }
      }
    }

?>

<h1 class="my-4 display-3"> <i class="fa fa-car text-primary"></i> Cadastro de Marcas</h1>
<form action="php/acaoMarca.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
    <div class="form-group col-6">
      <input type="hidden" name="idMarca" value="<?php echo $value['id_marca'] ?>">
      <input type="text" name="marca" class="form-control" placeholder="Name da Marca" value="<?php echo $nome ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <input type="submit" class="btn btn-success btn-block" value="Enviar">
    </div>
  </div>
</form>

<div class="row col-sm-6 mt-5">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Descrição</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_marca'] . '</td>';
          echo '<td>' . $valor['descricao_marca'] . '</td>';
          echo '<td><a href="php/acaoMarca.php?acao=del&id_mar=' . $valor['id_marca'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a> 
          
          <a class="ml-4" href="home.php?pg=marca&acao=update&id_marca=' . $valor['id_marca'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>
 
    </tbody>
  </table>
</div>