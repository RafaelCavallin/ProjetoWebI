<?php
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {

	case 'insert':
		$marca = $_POST['marca'];

		$sql = 'INSERT INTO marcas (descricao_marca) 
				VALUES ("'. $marca. '")';

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=marca&msg=insert');
		exit();
	break;

	case 'del':
		$idMarcaDel = $_REQUEST['id_mar'];
		$sql = 'DELETE FROM marcas WHERE id_marca =' . $idMarcaDel;
		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=marca&msg=del');
		exit();
	break;
	
	case 'update':
		$idMarca = $_POST['idMarca'];
		$novaMarca = $_POST['marca'];

		$sql = "UPDATE marcas SET descricao_marca = '" . $novaMarca . "' WHERE id_marca = " . $idMarca;

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}
		header('Location:../home.php?pg=marca&msg=up');
		exit();
	break;
}


?> 