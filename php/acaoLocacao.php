<?php

require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {
	case "insert":
		$cliente = $_POST['cliente'];
		$veiculo = $_POST['modelo'];
		$func = $_POST['func']; 
		$dataRet = $_POST['dataRet'];
		$dataEnt = $_POST['dataEnt'];

			//AJUSTA DATA PARA INSERIR NO BANCO YYYY-MM-DD
		$dataRetUSA = explode("/", $dataRet);
		$dataRetBanco = $dataRetUSA[2] ."-". $dataRetUSA[1] ."-". $dataRetUSA[0];

		$dataNascEntUSA = explode("/", $dataRet);
		$dataEntBanco = $dataNascEntUSA[2] ."-". $dataNascEntUSA[1] ."-". $dataNascEntUSA[0];	
		
		$sql = 'INSERT INTO locacoes (id_cliente, id_veiculo, id_funcionario, data_retirada, data_entrega) 
		VALUES ("'. $cliente .'", "'. $veiculo .'", "'. $func .'", "'. $dataRetBanco .'", "'. $dataEntBanco . '")';

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=locacao&msg=insert');
		exit();
	break;

	case "del":
		$idLocacao = $_REQUEST['id_loc'];

		$sql = 'DELETE FROM locacoes WHERE id_locacao =' . $idLocacao;

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}

		header('Location:../home.php?pg=locacao&msg=del');
		exit();
	break;
	
	case 'update':

	break;
}	
?> 