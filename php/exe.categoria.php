<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");


$link = connect();

  $sql = 'SELECT * 
          FROM categorias';

    $resultCategorias = executa($sql, $link);
    $result = listaRegistros($resultCategorias);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
    }

    if ($_GET['acao'] == 'update') {

      $idCategoriaUpdate = $_GET['id_categoria'];

      $sql = 'SELECT * 
          FROM categorias
          WHERE id_categoria =' .$idCategoriaUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['descricao'];
        }
      }
    }
?>

<h1 class="my-4 display-3"> <i class="fa fa-adn text-primary"></i> Cadastro de Categorias</h1>
<form action="php/acaoCategoria.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
   <div class="form-group col-6">
    <input type="hidden" name="idCategoria" value="<?php echo $value['id_categoria'] ?>">
    <input type="text" name="categoria" class="form-control" value="<?php echo $nome ?>" placeholder="Categoria" required>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-success btn-block" value="Cadastrar">
  </div>
</div>
</form>

<div class="row col-sm-8 mt-5">
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
          echo '<td>' . $valor['id_categoria'] . '</td>';
          echo '<td>' . $valor['descricao'] . '</td>';
          echo '<td><a href="php/acaoCategoria.php?acao=del&id_cat=' . $valor['id_categoria'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
            <a class="ml-4" href="home.php?pg=categoria&acao=update&id_categoria=' . $valor['id_categoria'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>