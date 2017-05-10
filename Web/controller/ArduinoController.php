<?php
$peopleExists = false;
$inventoryExists =false;

$conn = new mysqli("localhost", "root", "123", "saci");

if(isset($_GET["keyP"])&&isset($_GET["keyI"])&&isset($_GET["ardCode"])){
	$hexPessoa = $_GET["keyP"];
	$hexInventario = $_GET["keyI"];
	$codeArduino = $_GET["ardCode"];

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
	if($peopleExists && $inventoryExists){
		echo"<DEU TUDO CERTO!>";
		exit;
	}else{
		echo"<PROBLEMA EM UMA DAS TAGS>";
		exit;
	}
}else{
	echo"<Tente novamente>";
	exit;
}

?>
