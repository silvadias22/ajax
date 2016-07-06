<?php
	
	/*
		Nessa página, será recebido a requisição enviada via metodo POST pelo ajax da index,
		e terá o valor da variável 'registro' armazenado na variável em php $registro.
		Em seguida, será retornado os valores na variável $registro via JSON.
		
	*/


	$registro = $_POST['registro'];
	echo json_encode($registro);
?>