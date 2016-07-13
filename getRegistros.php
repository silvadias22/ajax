<?php
	function conexaoPDO(){	
		#Iniciando conexão com banco de dados
		$pdo = new PDO ('mysql:host=localhost;dbname=ajaxJason','root', '');
		$pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		return $pdo;
	}

	/*
		Nessa página, será recebido a requisição enviada via metodo POST pelo ajax da index.
		Será feito o preparo do select e utilizado o valor recebido $_POST como parametro, bindando o valor recebido na variável do banco 'uf';
		Em seguida, será retornado os valores na variável $cidades via JSON.
		Veja a proxima etapa em index.php
		
	*/
	
	$pdo = conexaoPDO();
	
	$sigla = $pdo->prepare("select nome from tb_cidades where uf = :uf;");
	$sigla->bindParam(':uf', $_POST['uf']); 
	$sigla->execute();
	while($cidades = $sigla->fetchAll(PDO::FETCH_OBJ)){
		echo json_encode($cidades);
	}

?>
