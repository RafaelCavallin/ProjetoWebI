<?php 
require_once("../inc/inc.dbadmin.php");
require_once("../inc/inc.conexao.php");

$link_con = connect();

$acao = $_GET['acao'];

switch ($acao) {

	//AÇÃO INSERIR CATEGORIA
	case "insert":
		$nomeCat = $_POST['categoria'];

		$sql = 'INSERT INTO categorias (descricao) 
				VALUES ("'. $nomeCat . '")';

		try {
			$result = executa($sql, $link_con);

		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=categoria&msg=insert');
		exit();
	break;
	
	//AÇÃO DELETAR CATEGORIA
	case "del":
		$idCatDel = $_REQUEST['id_cat'];

		$sql = 'DELETE FROM categorias WHERE id_categoria =' . $idCatDel;
		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=categoria&msg=del');
		exit();
	break;

	case 'update':
		$idUpdate = $_POST['idCategoria'];
		$novaCat = $_POST['categoria'];

		$sql = "UPDATE categorias SET descricao = '" . $novaCat . "' WHERE id_categoria = " . $idUpdate;

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}
		header('Location:../home.php?pg=categoria&msg=up');
		exit();


	break;
} 
?>