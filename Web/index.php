<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="pragma" content="no-cache" /> <!-- Limpar o cache quando inicia a página -->
		<title>SACI - Sistema Automatizado de Controle de Inventário</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./view/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./view/css/common.css" />
		<link rel="stylesheet" type="text/css" href="./view/css/index.css" />
	</head>

	<body>
		<div class="centerTop">
				<p  class="title high-title"> Sistema Automatizado de Controle de Inventário </p>
		</div>
		<br />

			<div class="centerFull">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-2 text" for="nick">Usuário: </label>
						<div class="col-sm-10">
							<input type="text" class="form-control inputControl" id="nick" placeholder="Entre com o usuário." required/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 text" for="pwd">Senha: </label>
						<div class="col-sm-10">
							<input type="password" class="form-control inputControl" id="pwd" placeholder="Entre com a senha." required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default myBtn">Entrar</button>
							<button type="submit" class="btn btn-default myBtn">Registrar</button>
						</div>
					</div>
				</form>
		</div>
	</body>
</html>
