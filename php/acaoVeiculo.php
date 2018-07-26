<?php  
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {
	case "insert":
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$cor = $_POST['cor'];
			$ano = $_POST['ano'];
			$placa = $_POST['placa'];
			$categoria = $_POST['categoria'];
			$filial = $_POST['filial'];

			$sql = 'INSERT INTO veiculos (id_marca, id_modelo, id_cor, placa, ano, id_filial, id_categoria) 
					VALUES ("'. $marca .'", "'. $modelo .'", "'. $cor .'", "'. $placa .'", "'. $ano . '", "'. $filial .'", "'.$categoria .'")';

				try {
					$result = executa($sql, $link_con);
				} catch (Exception $e) {
					echo 'Erro' . $e;
				}

			header('Location:../home.php?pg=veiculo&msg=insert');
			exit();
		break;

		case "del":
				$idVei = $_REQUEST['id_vei'];
				
				$sql = 'DELETE FROM veiculos WHERE id_veiculo =' . $idVei;

				try {
					$result = executa($sql, $link_con);
				} catch (Exception $e) {
					echo 'Erro' . $e;
				}

				header('Location:../home.php?pg=veiculo&msg=del');
				exit();
			break;
	
	case 'update':
		$idVeiculo = $_POST['idVeiculo'];
		$idMarca = $_POST['marca'];
		$idModelo = $_POST['modelo'];
		$idCor = $_POST['cor'];
		$ano = $_POST['ano'];
		$placa = $_POST['placa'];
		$idCategoria = $_POST['categoria'];
		$idFilial = $_POST['filial'];

		$sql = "UPDATE veiculos SET id_marca = '" . $idMarca . "', 
								   id_modelo = '" . $idModelo . "', 
								   id_cor = '" . $idCor .  "' , 
								   placa = '" . $placa .  "' , 
								   ano = '" . $ano .  "' , 
								   id_filial = '" . $idFilial .  "' , 
								   id_categoria = '" . $idCategoria .  "' 
				WHERE id_veiculo =" . $idVeiculo;

			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}
			header('Location:../home.php?pg=veiculo&msg=up');
			exit();
		break;
}
?> 