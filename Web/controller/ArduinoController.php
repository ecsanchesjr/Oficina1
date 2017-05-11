<?php
include("../model/HistoricoDAO.php");

// Recebe os valores de data e hora quando o acesso foi feito
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');
$time = new DateTime('now');

$peopleExists = false; // verificar se a key de pessoa existe
$inventoryExists = false; // verificar se a key de inventario existe

if(isset($_GET["keyP"])&&isset($_GET["keyI"])&&isset($_GET["ardCode"])){ // testa pra ver se o arduino enviou corretamente os dados
	$hexPessoa = $_GET["keyP"];
	$hexInventario = $_GET["keyI"];
	$codeArduino = $_GET["ardCode"];

	$conn = new mysqli("localhost", "root", "123", "saci");  // conexão ao BD

	$rs1 = $conn->query("SELECT * FROM Pessoa WHERE pessoa_key='".$hexPessoa."';");
	if($rs1->num_rows==1){  // se o retorno do select existir, então existe uma pessoa com aquela Key
		$peopleExists = true;
	}

	mysqli_close($conn);  // fecha conexão, se não fechar a próxima consulta não é feita
	$conn = new mysqli("localhost", "root", "123", "saci");

	$rs2 = $conn->query("SELECT * FROM Inventario WHERE inventario_key='".$hexInventario."';");
	if($rs2->num_rows==1){  // se o retorno do select existir, então existe um inventario com aquela Key
		$inventoryExists = true;
	}
	if($peopleExists && $inventoryExists){  // Ambas as tags existem, inicia o processo de insert/update na tabela Historico.
		// DEU TUDO CERTO
		$OpObj = new HistoricoDAO($hexPessoa, $hexInventario, $codeArduino, $date, $time);
		echo $OpObj->opFunction();
		exit;
	}else{  // Qualquer uma das tags não foi encontrada.
		echo"<PROBLEMA EM UMA DAS TAGS>";
		exit;
	}
}else{  // erro no processo de verificação de envio, algum dado não foi recebido
	echo"<Tente novamente>";
	exit;
}

?>
