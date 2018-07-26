<?php
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {
	case "insert":
			$marcaModelo = $_POST['marcaModelo'];
			$modelo = $_POST['modelo'];

			$sql = 'INSERT INTO modelos (id_marca, descricao) 
					VALUES ("'. $marcaModelo .'", "'. $modelo. '")';

			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			} 

			header('Location:../home.php?pg=modelo&msg=insert');
			exit();
		break;

	case "del":
			$idMol = $_REQUEST['id_mol'];

			$sql = 'DELETE FROM modelos WHERE id_modelo =' . $idMol;
			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}

			header('Location:../home.php?pg=modelo&msg=del');
			exit();
		break;
	
	case "update":
			$idModelo =  $_POST['idModelo'];
			$modelo = $_POST['modelo'];
			$idMarca = $_POST['marcaModelo'];

			$sql = "UPDATE modelos SET descricao = '" . $modelo . "', id_marca = '" . $idMarca . "' WHERE id_modelo = " . $idModelo;

			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}
			header('Location:../home.php?pg=modelo&msg=up');
			exit();
		break;
}
?>  