<?php   

require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {

	case 'insert':
		$nomeFantasia = $_POST['nomeFan'];
		$cnpj = $_POST['cnpj'];
		$end = $_POST['end'];

			$sql = 'INSERT INTO filiais (nome_fantasia, cnpj, endereco) 
					VALUES ("'. $nomeFantasia .'", "'. $cnpj .'", "'. $end .'")';


				try {
					$result = executa($sql, $link_con);
				} catch (Exception $e) {
					echo 'Erro' . $e;
				}

			header('Location:../home.php?pg=filial&msg=insert');
			exit();
		break;

	case 'del':
			$idFilDel = $_REQUEST['id_filial'];

			$sql = 'DELETE FROM filiais WHERE id_filial =' . $idFilDel;
			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}

			header('Location:../home.php?pg=filial&msg=del');
			exit();
		break;
	
	case 'update':
			$idFilial = $_POST['idFIlial'];
			$nome = $_POST['nomeFan'];
			$end = $_POST['end'];
			$cnpj = $_POST['cnpj'];

			$sql = "UPDATE filiais SET nome_fantasia = '" . $nome . "',
										cnpj = '" . $cnpj . "',
										endereco = '" . $end . "'
					 WHERE id_filial =" . $idFilial;

			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}
			header('Location:../home.php?pg=filial&msg=up');
			exit();
		break;
}
?>