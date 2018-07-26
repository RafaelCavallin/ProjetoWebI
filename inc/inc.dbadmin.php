<?php  
function executa($sql, $link){

	try {
		$result = mysql_query($sql, $link) or die(mysql_error());
	} catch (Exception $e) {
		echo 'Erro' . $e;
	}

	return $result;
}

function numeroLinhas($result){

	$NumLinhas =  mysql_num_rows($result);

	return $NumLinhas;
}

function listaRegistros($result){

	if (numeroLinhas($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			$vet[] = $row;
		}
	}else{
		$vet[] = NULL;
	}
	return $vet;
}
?>