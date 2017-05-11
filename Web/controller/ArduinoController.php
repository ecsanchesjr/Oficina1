<?php
include("../model/HistoricoDAO.php");

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');
$time = new DateTime('now');
/*
echo $date;
echo '<br>';
echo date_format($time,'H:i:s');
*/
$peopleExists = false; // verificar se a key de pessoa existe
$inventoryExists = false; // verificar se a key de pessoa existe

if(isset($_GET["keyP"])&&isset($_GET["keyI"])&&isset($_GET["ardCode"])){ // testa pra ver se o arduino enviou corretamente os dados
	$hexPessoa = $_GET["keyP"];
	$hexInventario = $_GET["keyI"];
	$codeArduino = $_GET["ardCode"];

	$conn = new mysqli("localhost", "root", "123", "saci");

	$rs1 = $conn->query("SELECT * FROM Pessoa WHERE pessoa_key='".$hexPessoa."';");
	if($rs1->num_rows==1){
		$peopleExists = true;
	}

	mysqli_close($conn);
	$conn = new mysqli("localhost", "root", "123", "saci");

	$rs2 = $conn->query("SELECT * FROM Inventario WHERE inventario_key='".$hexInventario."';");
	if($rs2->num_rows==1){
		$inventoryExists = true;
	}
	if($peopleExists && $inventoryExists){  // Ambas as tags existem, inicia o processo de insert/update na tabela Historico.
		// alterar isso aqui pra verificar tudo antes de dar o echo
		$OpObj = new HistoricoDAO($hexPessoa, $hexInventario, $codeArduino, $date, $time);
		echo $OpObj->opFunction();
		//echo"<DEU TUDO CERTO!>";
		exit;
	}else{  // Qualquer uma das tags não foi encontrada.
		echo"<PROBLEMA EM UMA DAS TAGS>";
		exit;
	}
}else{  // erro no processo de verificação de envio
	echo"<Tente novamente>";
	exit;
}

?>
