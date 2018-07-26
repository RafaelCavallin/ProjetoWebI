<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");


$link = connect();

  $sql = 'SELECT id_filial, nome_fantasia, cnpj 
          FROM filiais';

    $resultFiliais = executa($sql, $link);
    $result = listaRegistros($resultFiliais);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
      $cnpj = '';
      $end = '';
    }

    if ($_GET['acao'] == 'update') {

      $idFilialUpdate = $_GET['id_filial'];

      $sql = 'SELECT * 
          FROM filiais
          WHERE id_filial =' .$idFilialUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['nome_fantasia'];
          $cnpj = $value['cnpj'];
          $end = $value['endereco'];
        }
      }
    }
?>

<h1 class="my-4 display-3"> <i class="fa fa-building text-primary"></i> Cadastro de Filiais</h1>
<form action="php/acaoFilial.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
   <div class="form-group col">
    <input type="hidden" name="idFIlial" value="<?php echo $value['id_filial'] ?>">
    <input type="text" name="nomeFan" class="form-control" placeholder="Nome Fantasia" value="<?php echo $nome ?>" required>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" data-mask="00.000.000/0000-00" value="<?php echo $cnpj ?>" required>
  </div>
  <div class="form-group col-6">
    <input type="text" name="end" class="form-control" placeholder="Endereço" value="<?php echo $end ?>" required>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-success btn-block" value="Enviar">
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
        <th scope="col">CNPJ</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_filial'] . '</td>';
          echo '<td>' . $valor['nome_fantasia'] . '</td>';
          echo '<td>' . $valor['cnpj'] . '</td>';
          echo '<td><a href="php/acaoFilial.php?acao=del&id_filial=' . $valor['id_filial'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
          <a class="ml-4" href="home.php?pg=filial&acao=update&id_filial=' . $valor['id_filial'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>