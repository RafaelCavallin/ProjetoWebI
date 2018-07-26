<?php
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

$link = connect();

  $sql = 'SELECT * 
          FROM cores';

    $resultCores = executa($sql, $link);
    $result = listaRegistros($resultCores);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
    }

    if ($_GET['acao'] == 'update') {

      $idCorUpdate = $_GET['id_cor'];

      $sql = 'SELECT * 
          FROM cores
          WHERE id_cor =' .$idCorUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['descricao'];
        }
      }
    }
?>

<h1 class="my-4 display-3"> <i class="fa fa-pencil text-primary"></i> Cadastro de Cores</h1>
<form class="form-inline" action="php/acaoCor.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
   <div class="form-group mr-3">
    <input type="hidden" name="idCor" value="<?php echo $value['id_cor'] ?>">
     <input type="text" name="nomeCor" class="form-control" placeholder="Nome da Cor" value="<?php echo $nome ?>" required>
   </div>
   <div class="form-group">
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
          echo '<td>' . $valor['id_cor'] . '</td>';
          echo '<td>' . $valor['descricao'] . '</td>';
          echo '<td><a href="php/acaoCor.php?acao=del&id_cor=' . $valor['id_cor'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
          <a class="ml-4" href="home.php?pg=cor&acao=update&id_cor=' . $valor['id_cor'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>