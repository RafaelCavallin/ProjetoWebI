<?php  
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");


$link = connect();

  $sql = 'SELECT * 
          FROM clientes';

    $resultClientes = executa($sql, $link);
    $result = listaRegistros($resultClientes);

    // VERIFICA SE É UMA INSERÇÃO OU UPDATE
    
    if (!isset($_GET['acao'])) {
      $_GET['acao'] = "insert";
      $idClienteUpdate = -1;
      $nome = '';
      $email = '';
      $cpf = '';
      $cnh = '';
      $tel = '';
      $dataNasc = '';
      $end = '';
      $imgAvatar = "img/Clientes/avatar.png";
    }

    if ($_GET['acao'] == 'update') {

      $idClienteUpdate = $_GET['id_cliente'];

      $sql = 'SELECT * 
          FROM clientes
          WHERE id_cliente =' .$idClienteUpdate;

      $resultUpdate = executa($sql, $link);
      $retornoUpdateSql = listaRegistros($resultUpdate);
      
      if (numeroLinhas($resultUpdate) > 0) {
        foreach ($retornoUpdateSql as $value) {
          $nome = $value['nome'];
          $email = $value['email'];
          $cpf = $value['cpf'];
          $cnh = $value['cnh'];
          $tel = $value['telefone'];
          $dataNasc = $value['data_nasc'];

          $dataNascUSA = explode("-", $dataNasc);
          $dataNasc = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

          $end = $value['endereco'];
          $imgAvatar = "img/Clientes/" . $value['img_cliente'];
        }
      }
    }

?>


<div class="row mb-1 mt-4">
  <div class="col-md-10">
    <h1 class="my-4 display-3"> <i class="fa fa-users text-primary"></i> Cadastro de Clientes</h1>
  </div>
  <div class="col-md-2 col-sm-2">
    <a href="#"  data-toggle="modal" data-target="#AvatarModal">
      <img src="<?php echo $imgAvatar ?>" class="rounded-circle float-left img-fluid">
    </a>
  </div> 
</div>
<form action="php/acaoCliente.php?acao=<?php echo  $_GET['acao'] ?>" method="POST">
  <div class="row">
    <div class="form-group col">
      <input type="hidden" name="idCliente" value="<?php echo $value['id_cliente'] ?>">
      <input type="text" name="nome" class="form-control" placeholder="Nome" value="<?php echo $nome ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <input type="text" name="cpf" class="form-control" placeholder="CPF" data-mask="000.000.000-00" value="<?php echo $cpf ?>" required>
    </div>
    <div class="form-group col-4">
      <input type="text" name="cnh" class="form-control" placeholder="CNH" data-mask="00000000000" value="<?php echo $cnh ?>" required>
    </div>
    <div class="form-group col-4">
      <input type="text" name="fone" class="form-control" placeholder="Telefone" data-mask="(00)00000-0000" value="<?php echo $tel ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email ?>" required>
    </div>
    <div class="form-group col-6">
      <input type="text" name="dataNasc" class="form-control" placeholder="Data de Nascimento" data-mask="00/00/0000" value="<?php echo $dataNasc ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col">
      <input type="text" name="end" class="form-control" placeholder="Endereço" value="<?php echo $end ?>">
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
        <th scope="col">CPF</th>
        <th scope="col">CNH</th>
        <th scope="col">Fone</th>
        <th scope="col">Email</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        foreach ($result as $valor) {
          echo '<tr>';
          echo '<td>' . $valor['id_cliente'] . '</td>';
          echo '<td>' . $valor['nome'] . '</td>';
          echo '<td>' . $valor['cpf'] . '</td>';
          echo '<td>' . $valor['cnh'] . '</td>';
          echo '<td>' . $valor['telefone'] . '</td>';
          echo '<td>' . $valor['email'] . '</td>';
          echo '<td><a href="php/acaoCliente.php?acao=del&id_cli=' . $valor['id_cliente'] . '"><i class="fa fa-trash fa-2x text-danger"></i></a>
          <a class="ml-4" href="home.php?pg=cliente&acao=update&id_cliente=' . $valor['id_cliente'] . '"><i class="fa fa-pencil fa-2x text-info"></i></a></td>';
          echo '</tr>';
        }
      ?>

    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="AvatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Imagem do Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="php/acaoCliente.php?acao=updateAvatar" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group col-12">
          <input type="hidden" name="idCliente" value="<?php echo $idClienteUpdate ?>">
          <input type="file" name="imgAvatar" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Enviar">
      </div>
      </form>
    </div>
  </div>
</div>
