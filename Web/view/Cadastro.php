<!DOCTYPE html>
<html>
<head>
	<title>SACI - Cadastro de Usuário</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/cadastro.css" />
</head>
<body>
	<p class="title giant-title titleAlign textCenter">
		Portal de Cadastro de Usuários
	</p>

	<!--- fazer uma função pra atualizar apenas a area após verificar se o RE existe --->

	<div class="center tamControl">
		<form onsubmit="verifIfReExists();return false;" id="target" class="form-horizontal">
			<div class="form-group ">
				<label class="control-label col-sm-2 text" for="re" >Informe seu Registro Escolar:</label>
				<div class="col-sm-10 control">
					<input type="numeric" class="form-control inputControl input" id="re" placeholder="Entre com o registro escolar." pattern="[0-9]*" required/>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
