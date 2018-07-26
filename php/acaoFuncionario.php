<?php  
session_start();
require_once("../inc/inc.conexao.php");
require_once("../inc/inc.dbadmin.php");

$link_con = connect();

$acao = $_REQUEST['acao'];

switch ($acao) {

	case 'insert':
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$dataNasc = $_POST['dataNasc'];
			
			//AJUSTA DATA PARA INSERIR NO BANCO YYYY-MM-DD
			$dataNascUSA = explode("/", $dataNasc);
			$dataNascBanco = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

				$sql = 'INSERT INTO funcionarios (nome, login, email, senha, data_nasc) 
						VALUES ("'. $nome .'", "'. $login .'", "'. $email .'", "'. $senha .'", "'. $dataNascBanco . '")';

				try {
					$result = executa($sql, $link_con);
				} catch (Exception $e) {
					echo 'Erro' . $e;
				}

			header('Location:../home.php?pg=funcionario&msg=insert');
			exit();
		break;
	
	case 'del':

			$idFunDel = $_REQUEST['id_fun'];
			$sql = 'DELETE FROM funcionarios WHERE id_usuario =' . $idFunDel;
			try {
				$result = executa($sql, $link_con);
			} catch (Exception $e) {
				echo 'Erro' . $e;
			}

			header('Location:../home.php?pg=funcionario&msg=del');
			exit();

		break;

	case 'update':
		$idFunc = $_POST['idFuncionario'];
		$nomeFunc = $_POST['nome'];
		$loginFunc = $_POST['login'];
		$emailFunc = $_POST['email'];
		#$senhaFunc = $_POST['senha'];
		$dataNascFunc = $_POST['dataNasc'];

		//AJUSTA DATA PARA INSERIR NO BANCO YYYY-MM-DD
		$dataNascUSA = explode("/", $dataNascFunc);
		$dataNascFunc = $dataNascUSA[2] ."-". $dataNascUSA[1] ."-". $dataNascUSA[0];

		#senha = '" . $senhaFunc . "',
		$sql = "UPDATE funcionarios SET nome = '" . $nomeFunc . "',
									login = '" . $loginFunc . "',
									email = '" . $emailFunc . "',
									data_nasc = '" . $dataNascFunc . "'
				 WHERE id_usuario =" . $idFunc;

		try {
			$result = executa($sql, $link_con);
		} catch (Exception $e) {
			echo 'Erro' . $e;
		}
		header('Location:../home.php?pg=funcionario&msg=up');
		exit();
	break;

	case 'updateSenha':
		$idFunc = $_POST['idFunc'];
		$senhaAtual =  md5($_POST['senhaAtual']);
		$novaSenha =  md5($_POST['novaSenha']);
		$confirmacaoSenha =  md5($_POST['confirmacaoSenha']);

		if (empty($_POST['novaSenha']) || empty($_POST['confirmacaoSenha']) || empty($_POST['senhaAtual'])) {
			header('Location:../home.php?msg=ptc');
			exit();
		}else{
			if ($novaSenha != $confirmacaoSenha) {
				header('Location:../home.php?msg=spi');
				exit();
			}else{
				if ($senhaAtual == $_SESSION['login']['pass']) {
					
					$sqlUpdateSenha = "UPDATE funcionarios SET 
					senha = '" . $novaSenha . "'
					WHERE id_usuario =" . $idFunc;

					try {
						$resUpdateSenha = executa($sqlUpdateSenha, $link_con);
					} catch (Exception $e) {
						echo 'Erro' . $e;
					}

					header('Location:../home.php?msg=up');
					exit();

				}else{
					header('Location:../home.php?msg=sti');
					exit();
				}
			}
		}

	break;
}
?>