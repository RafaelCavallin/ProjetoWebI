<?php
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {
	case 'insert':
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$cnh = $_POST['cnh'];
		$tel = $_POST['fone'];
		$email = $_POST['email'];
		$dataNasc = $_POST['dataNasc'];
		$end = $_POST['end'];
		$imgCliente = "avatar.png";
		
		//AJUSTA DATA PARA INSERIR NO BANCO YYYY-MM-DD
		$dataNascUSA = explode("/", $dataNasc);
		$dataNascBanco = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

		
		$sql = 'INSERT INTO clientes (nome, cpf, cnh, telefone, email, endereco, data_nasc, img_cliente) 
				VALUES ("'. $nome .'", "'. $cpf .'", "'. $cnh . '", "'. $tel .'", "'. $email .'", "'. $end .'", "'. $dataNascBanco .'", "'. $imgCliente . '")';


		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=cliente&msg=insert');
		exit();

	break;

	case 'del':
		$idCliDel = $_REQUEST['id_cli'];

		$sqlImg = 'SELECT img_cliente FROM clientes WHERE id_cliente = ' . $idCliDel;
		$resultImg = executa($sqlImg, $link_con);
		$resultImgLista = listaRegistros($resultImg);

		foreach ($resultImgLista as $img) {
			$deletaImg = $img['img_cliente'];
		}

		$sql = 'DELETE FROM clientes WHERE id_cliente =' . $idCliDel;
		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		if (unlink('../img/Clientes/' . $deletaImg)) {
			echo 'IMG deletada';
		}else{
			echo 'Não deletou a img';
		}

		header('Location:../home.php?pg=cliente&msg=del');
		exit();
	break;
	
	case 'update':
	  $idCliente = $_POST['idCliente'];
	  $nome = $_POST['nome'];
      $email = $_POST['email'];
      $cpf = $_POST['cpf'];
      $cnh = $_POST['cnh'];
      $tel = $_POST['fone'];
      $dataNasc = $_POST['dataNasc'];
      $end = $_POST['end'];

      //AJUSTA DATA PARA INSERIR NO BANCO YYYY-MM-DD
		$dataNascUSA = explode("/", $dataNasc);
		$dataNasc = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

      $sql = "UPDATE clientes SET nome = '" . $nome . "', 
      							  cpf = '" . $cpf . "', 
      							  cnh = '" . $cnh . "',
      							  telefone = '" . $tel . "',
      							  data_nasc = '" . $dataNasc . "',
      							  endereco = '" . $end . "',
      							  email = '" . $email . "'  
      		WHERE id_cliente = " . $idCliente;

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}
		header('Location:../home.php?pg=cliente&msg=up');
		exit();
	break;

	case 'updateAvatar':

		$idClienteAvatar = $_POST['idCliente'];

		if ($idClienteAvatar == -1) {
			header('Location:../home.php?pg=cliente');
			exit();		
		}else {
			$name = $_FILES['imgAvatar']['name'];
			$tmp_name = $_FILES['imgAvatar']['tmp_name'];
			
			$dir = '../img/Clientes/';
			$dataHora = date("YmdHis");
			$nomeImgCompleto = $dataHora.'_'.$name;

			move_uploaded_file($tmp_name, $dir.$dataHora.'_'.$name);

			$sql = "UPDATE clientes SET img_cliente = '" . $nomeImgCompleto . "'  
	      							WHERE id_cliente = " . $idClienteAvatar;

	      	try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}

			header('Location:../home.php?pg=cliente');
			exit();	
		}			
	break;	
}
?>