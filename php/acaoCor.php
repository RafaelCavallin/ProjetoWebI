<?php 
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {

	case 'insert':
			$nomeCor = $_POST['nomeCor'];

			$sql = 'INSERT INTO cores (descricao) 
				VALUES ("'. $nomeCor . '")';

				try {
					$result = executa($sql, $link_con);
				} catch (Exception $e) {
					echo 'Erro' . $e;
				}

			header('Location:../home.php?pg=cor&msg=insert');
			exit();

		break;

	case 'del':
			$idCor = $_REQUEST['id_cor'];

			$sql = 'DELETE FROM cores WHERE id_cor =' . $idCor;
			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}

			header('Location:../home.php?pg=cor&msg=del');
			exit();
		break;
	
	case 'update':
			$idCor = $_POST['idCor'];
			$novaCor = $_POST['nomeCor'];

			$sql = "UPDATE cores SET descricao = '" . $novaCor . "' WHERE id_cor = " . $idCor;

			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}
			header('Location:../home.php?pg=cor&msg=up');
			exit();
		break;
}	
?>