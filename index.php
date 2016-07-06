<?php
	
	# Criado por - Fabrício da Silva Dias.
	# silvadias22@gmail.com
	# https://github.com/silvadias22
	# https://gist.github.com/silvadias22


	function conexaoPDO(){	
		#Iniciando conexão com banco de dados
		$pdo = new PDO ('mysql:host=localhost;dbname=ajax','root', '');
		$pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		return $pdo;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf8">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="col-md-5 col-md-offset-4" id="conteudo">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Ajax</h3>
				</div>
				<div class="panel-body">
					<form class="col-md-6" action="#" name="#" method="post">
						 <div class="form-group text-center">
							<span>Selecione o registro:</span>
							<select class="input-group form-control input-sm" id="registro" >
								<?php 
												
									// atribui as configurações de conxão com o banco na variável $pdo através da função conexaoPDO();	
									$pdo = conexaoPDO();

									// Atribui na variável $item o preparo do select.
									$item = $pdo->prepare("select Item_um from ajax;");

									// Executa a variável.
									$item->execute();

									// Inicia um laço de repetição atribuindo na variável $itens os valores contido em $item,
									// lembrando que fetch retorna a proxima linha do resultado setado.	
									while($itens = $item->fetch(PDO::FETCH_ASSOC)){
									
									// Dentro do laço de repetição, a option do select é populado linha por linha.	
								?>		
								<option  name="registro" class="registro"><?php print_r($itens['Item_um']);?></option>
								<?php };?>
							</select> 
						</div> <!-- Div Form-Group -->
					</form>
					<div class="col-md-6 text-center" id="registroShow" >
						<span>Registro Selecionado :</span>
						<table class="table table-bordered table-striped table-condensed" style="margin-top:5px;" id="tab">
							<tr class="success text-center" >
								<td  id="registroSelected"></td>
							</tr>
						</table>
					</div>	
				</div>  <!-- Panel-Body -->
			</div> <!-- Panel -->
		</div> <!-- Div Conteúdo -->
		<script src="js/jquery.min.js"></script>
		<script>
			
			//	Após o carregamento do documento, a função change é executada (Observe que o change é para o elemento)
			//	Isso significa que após o carregamento da página, o elemento selecionado será executado. 
			
			$(document).ready(function(){
				$('#registro').change();

			});
			
		
			//	Quando o elemento for alterado, o change executará o ajax,
			//	Que fará uma requisição com destino em getRegistros.php utilizando o metodo 'POST',
			//	enviando o valor armazenado na variável 'registro' (Valor selecionado no elemento #registro).
				
			$("#registro").change( function(){ 
				$.ajax({
					url: "getRegistros.php",
					dataType:"json",
					type:"post",
					data:{
						registro: $("#registro").val(),
					},
					
					//	Aqui será recebido o retorno passado via JSON pelo gerRegistros.php,
					//	em seguida, será limpado um local específico e por fim será enviado para esse local
					//	a impressão do valor recebido.
					
					success: function(data){	
						$("#registroSelected").empty();	
						$('#registroSelected').append(data).hide().fadeIn( 'fast' , 'linear' );
						$("#registroSelected").show();
					}						
				});   
			 });
		</script>
	</body>
</html>