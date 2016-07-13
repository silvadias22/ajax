<?php
	# Criado por - Fabrício da Silva Dias.
	# silvadias22@gmail.com
	# https://github.com/silvadias22
	# https://gist.github.com/silvadias22

	include ('getRegistros.php');
?>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="col-md-5 col-md-offset-4" id="conteudo">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Ajax - Demonstração</h3>
				</div>
				<div class="panel-body">
					<form class="col-md-6" action="#" name="#" method="post">
						 <div class="form-group text-center">
							<span>Selecione um Estado:</span>
							<select class="input-group form-control input-sm" id="estados" >
								<?php 
												
									// atribui as configurações de conxão com o banco na variável $pdo através da função conexaoPDO();	
									$pdo = conexaoPDO();

									// Atribui na variável $estado o preparo do select.
									$estado = $pdo->prepare("select uf from tb_estados;");

									// Executa a variável.
									$estado->execute();

									// Inicia um laço de repetição atribuindo na variável $estados os valores contido em $estado,
									// lembrando que fetch retorna a proxima linha do resultado setado.	
									while($estados = $estado->fetch(PDO::FETCH_ASSOC)){
									
									// Dentro do laço de repetição, a option do select é populado linha por linha.	
								?>		
								<option  name="estado" class="estado"><?php echo $estados['uf'];?></option>
								<?php };?>
							</select> 
						</div> <!-- Div Form-Group -->
					</form>
					<div class="col-md-6 text-center" id="registroShow" >
						<span>Selecione uma cidade:</span>
						<select class="input-group form-control input-sm" id="cidade" >
						</select>
					</div>	
				</div>  <!-- Panel-Body -->
			</div> <!-- Panel -->
		</div> <!-- Div Conteúdo -->	
		<script src="js/jquery.min.js"></script>
		<script>
			
			//	Após o carregamento do documento, a função change é executada (Observe que o change é para o elemento)
			//	Isso significa que após o carregamento da página, o elemento selecionado será executado. 
						
			$(document).ready(function(){
				$('#estados').change();
			});
			
			//	Quando o elemento for alterado, o change executará o ajax,
			//	Que fará uma requisição com destino em getRegistros.php utilizando o metodo 'POST',
			//	enviando o valor armazenado na varável 'uf' (Valor selecionado no elemento #estados).
			//  Veja a continuação em getRegistros.php. 
				
			$("#estados").change( function(){ 
				$.ajax({
					type:"POST",
					dataType: "json",
					url:"getRegistros.php",
					data:{
						uf : $("#estados").val()
					},
					
					
					
					beforeSend: function(){	
						$("#registroSelected").empty();
						$("#cidade").empty();
					},

					//	Aqui será recebido o retorno passado via JSON pelo getRegistros.php,
					//	em seguida, será limpado um local específico e por fim será enviado para esse local(elemento 'Select')
					//	uma option sob iteração do loop fazendo com que seja populado cada linha com o nome dos valores recebido.
				
					success: function(data){	
						$.each(data, function(key, value){
							//console.log(value);
							$("#cidade").append("<option >"+value.nome+"</option>");
						});	
					}						
				});   
			 });
		</script>
	</body>
</html>
