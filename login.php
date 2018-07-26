<?php  
session_start();

require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

$acao = $_GET['acao'];

switch ($acao) {
	case 'login':
		$user = $_POST['login'];
		$pass = md5($_POST['pass']);

		$link = connect();

		$sql = 'SELECT * FROM funcionarios WHERE login = "' . $user . '" AND senha = "'  . $pass . '"';

		$result = executa($sql, $link);

		$rsUser = listaRegistros($result);

		foreach ($rsUser as $valor) {
			$idUser = $valor['id_usuario'];
			$nomeFunc = $valor['nome'];
		}

		if (numeroLinhas($result) > 0) {
			$_SESSION['login']['idUser'] = $idUser;
			$_SESSION['login']['nome'] = $nomeFunc; 
			$_SESSION['login']['user'] = $user;
			$_SESSION['login']['pass'] = $pass;
			$_SESSION['login']['log'] = 'logado';

			header('Location: home.php');
			exit;
		}else{
			header('Location: index.php');
			exit;
		}
		break;
	
	case 'logout':
			session_destroy();
			header('Location: index.php');
		break;

	default:
		// code...
		break;
}







?>