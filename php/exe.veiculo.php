<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

$link = connect();

if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $marca = '';
      $modelo = '';
      $cor = '';
      $ano = '';
      $placa = '';
      $categoria = '';
      $filial = '';
    }

    if ($_GET['acao'] == 'update') {

      $idVeiculoUpdate = $_GET['id_veiculo'];

      $sql = 'SELECT * 
          FROM veiculos
          WHERE id_veiculo =' .$idVeiculoUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $idUpdate = $value['id_veiculo'];
          $idMarca = $value['id_marca'];
          $idModelo = $value['id_modelo'];
          $idCor = $value['id_cor'];
          $ano = $value['ano'];
          $placa = $value['placa'];
          $idCategoria = $value['id_categoria'];
          $idFilial = $value['id_filial'];
        }
      }
    }
?>
<!-- FORM DE CADASTRO DE USUÁRIO --> 
<h1 class="my-4 display-3"> <i class="fa fa-car text-primary"></i> Cadastro de Veículos</h1>
<form action="php/acaoVeiculo.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
    <div class="form-group col-4">
      <input type="hidden" name="idVeiculo" value="<?php echo $idVeiculoUpdate ?>">
      <select class="form-control" name="marca" id="marca" required>
          <?php 
            if ($_GET['acao'] == 'update') {

              $sql = 'SELECT * 
                      FROM marcas
                      WHERE id_marca ='. $idMarca;

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
    <div class="form-group col-4">
      <select class="form-control" name="modelo" id="modelo" required>
        <?php 
        if ($_GET['acao'] == 'update') {

          $sql = 'SELECT * 
                  FROM modelos
                  WHERE id_modelo ='. $idModelo;

          $resultConsId = executa($sql, $link);
          $retornoConsID = listaRegistros($resultConsId);

          if (numeroLinhas($resultConsId) > 0) {
            foreach ($retornoConsID as $value) {
              $desc = $value['descricao'];
              $id = $value['id_modelo'];
            }
          }
          echo '<option value="'.$id . '">'. $desc .'</option>';
        } 

        echo '<option value="">Selecione o Modelo</option>';

        $sql = 'SELECT * 
        FROM modelos';

        $resultModelos = executa($sql, $link);
        $result = listaRegistros($resultModelos);

        foreach ($result as $valor) {
          echo '<option value="'. $valor['id_modelo'] . '">' . $valor['descricao'] .'</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group col-4">
      <select class="form-control" name="cor" id="cor" required>
        <?php  
          if ($_GET['acao'] == 'update') {

          $sql = 'SELECT * 
                  FROM cores
                  WHERE id_cor ='. $idCor;

          $resultConsId = executa($sql, $link);
          $retornoConsID = listaRegistros($resultConsId);

          if (numeroLinhas($resultConsId) > 0) {
            foreach ($retornoConsID as $value) {
              $desc = $value['descricao'];
              $id = $value['id_cor'];
            }
          }
          echo '<option value="'.$id . '">'. $desc .'</option>';
        } 

        echo '<option value="">Selecione a Cor</option>';

          $sql = 'SELECT * 
                  FROM cores';

            $resultCores = executa($sql, $link);
            $result = listaRegistros($resultCores);

          foreach ($result as $valor) {
            echo '<option value="'. $valor['id_cor'] . '">' . $valor['descricao'] .'</option>';
          }
        ?>
      </select>
    </div>
  </div>  
  <div class="row">
    <div class="form-group col-4">
      <input type="text" name="ano" class="form-control" placeholder="Ano" data-mask="0000" value="<?php echo $ano ?>" required>
    </div>
    <div class="form-group col-4">
      <input type="text" name="placa" class="form-control" placeholder="Placa" data-mask="AAA-0000" value="<?php echo $placa ?>" required>
    </div>
    <div class="form-group col-4">
      <select class="form-control" name="categoria" id="categoria" required>
        <?php  
        if ($_GET['acao'] == 'update') {

          $sql = 'SELECT * 
                  FROM categorias
                  WHERE id_categoria ='. $idCategoria;

          $resultConsId = executa($sql, $link);
          $retornoConsID = listaRegistros($resultConsId);

          if (numeroLinhas($resultConsId) > 0) {
            foreach ($retornoConsID as $value) {
              $descCat = $value['descricao'];
              $id = $value['id_categoria'];
            }
          }
          echo '<option value="'.$id . '">'. $descCat .'</option>';
        } 

        echo '<option value="">Selecione a Categoria</option>';

        $sql = 'SELECT * 
                FROM categorias';

        $resultCategorias = executa($sql, $link);
        $result = listaRegistros($resultCategorias);

        foreach ($result as $valor) {
          echo '<option value="'. $valor['id_categoria'] . '">' . $valor['descricao'] .'</option>';
        }
        ?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <select class="form-control" name="filial" id="filial" required>
        <?php  
          if ($_GET['acao'] == 'update') {

          $sql = 'SELECT * 
                  FROM filiais
                  WHERE id_filial ='. $idFilial;

          $resultConsId = executa($sql, $link);
          $retornoConsID = listaRegistros($resultConsId);

          if (numeroLinhas($resultConsId) > 0) {
            foreach ($retornoConsID as $value) {
              $desc = $value['nome_fantasia'];
              $id = $value['id_filial'];
            }
          }
          echo '<option value="'.$id . '">'. $desc .'</option>';
        }

        echo '<option value="">Selecione a Filial</option>';

          $sql = 'SELECT * 
                  FROM filiais';

            $resultFiliais = executa($sql, $link);
            $result = listaRegistros($resultFiliais);

          foreach ($result as $valor) {
            echo '<option value="'. $valor['id_filial'] . '">' . $valor['nome_fantasia'] .'</option>';
          }
        ?>
      </select>
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
        <th scope="col">Marca</th>
        <th scope="col">Modelo</th>
        <th scope="col">Cor</th>
        <th scope="col">Placa</th>
        <th scope="col">Ano</th>
        <th scope="col">Filial</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        $sql = 'SELECT * 
                FROM veiculos';

          $result = executa($sql, $link);
          $result = listaRegistros($result);


        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_veiculo'] . '</td>';
          echo '<td>' . $valor['id_marca'] . '</td>';
          echo '<td>' . $valor['id_modelo'] . '</td>';
          echo '<td>' . $valor['id_cor'] . '</td>';
          echo '<td>' . $valor['placa'] . '</td>';
          echo '<td>' . $valor['ano'] . '</td>';
          echo '<td>' . $valor['id_filial'] . '</td>';
          echo '<td><a href="php/acaoVeiculo.php?acao=del&id_vei=' . $valor['id_veiculo'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
          <a class="ml-4" href="home.php?pg=veiculo&acao=update&id_veiculo=' . $valor['id_veiculo'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>