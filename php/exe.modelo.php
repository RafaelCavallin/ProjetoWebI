<?php 
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");
    
$link = connect();

if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $nome = '';
    }

    if ($_GET['acao'] == 'update') {

      $idModeloUpdate = $_GET['id_modelo'];

      $sql = 'SELECT * 
          FROM modelos
          WHERE id_modelo =' .$idModeloUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['descricao'];
          $idUpdate = $value['id_marca'];
        }
      }
    }
?>

<h1 class="my-4 display-3"> <i class="fa fa-car text-primary"></i> Cadastro de Modelos</h1>
<form action="php/acaoModelo.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
    <div class="form-group col-3">
      <input type="hidden" name="idModelo" value="<?php echo $value['id_modelo'] ?>">
      <select class="form-control" name="marcaModelo" id="marca" required>
          <?php 
            if ($_GET['acao'] == 'update') {

              $sql = 'SELECT * 
                      FROM marcas
                      WHERE id_marca ='. $idUpdate;

              $resultConsId = executa($sql, $link);
              $retornoConsID = listaRegistros($resultConsId);

              if (numeroLinhas($resultConsId) > 0) {
                foreach ($retornoConsID as $value) {
                  $desc = $value['descricao_marca'];
                  $id = $value['id_marca'];
                }
              }

              echo '<option value="'.$id . '">'. $desc .'</option>';
            }

              echo '<option value="">Selecione a Marca</option>';
              $sql = 'SELECT * 
                  FROM marcas';

                  $resultMarcas = executa($sql, $link);
                  $result = listaRegistros($resultMarcas);

                foreach ($result as $valor) {
                  echo '<option value="'. $valor['id_marca'] . '">' . $valor['descricao_marca'] .'</option>';
                }
          ?>
      </select>
    </div>
    <div class="form-group col-3">
      <input type="text" name="modelo" class="form-control" placeholder="Nome do Modelo" value="<?php echo $nome ?>" required>
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
        <th scope="col">Marca</th>
        <th scope="col">Modelo</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        $sql = 'SELECT Marca.descricao_marca, Modelo.descricao, Modelo.id_modelo 
                FROM modelos AS Modelo
                INNER JOIN marcas AS Marca
                ON (Marca.id_marca = Modelo.id_marca)';

          $resultModelos = executa($sql, $link);
          $result = listaRegistros($resultModelos);

        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_modelo'] . '</td>';
          echo '<td>' . $valor['descricao_marca'] . '</td>';
          echo '<td>' . $valor['descricao'] . '</td>';
          echo '<td><a href="php/acaoModelo.php?acao=del&id_mol=' . $valor['id_modelo'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
            <a class="ml-4" href="home.php?pg=modelo&acao=update&id_modelo=' . $valor['id_modelo'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>