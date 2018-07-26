<?php
	
	function connect(){
		define ("HOST", "localhost");
		define ("USER", "root");
		define ("PASS", "");
		define ("BASE", "db_veiculos");

		$link = mysql_connect(HOST, USER, PASS) or die("Conexão falhou!");

		mysql_select_db(BASE, $link) or die("Erro ao conectar com a base"); 

		return $link;
	}

?>