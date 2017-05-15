<?php
include("../model/ConexaoDAO.php");
include("TransacaoController.php");

// Recebe os valores de data e hora quando o acesso foi feito
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');
$time = new DateTime('now');

$peopleExists = false; // verificar se a key de pessoa existe
$inventoryExists = false; // verificar se a key de inventario existe

$peopleObj = new PessoaDAO();
$invObj = new InventarioDAO();

if(isset($_GET["keyP"])&&isset($_GET["keyI"])&&isset($_GET["ardCode"])){ // testa pra ver se o arduino enviou corretamente os dados
	$hexPessoa = $_GET["keyP"];
	$hexInventario = $_GET["keyI"];
	$codeArduino = $_GET["ardCode"];

	if($peopleObj->isPeople($hexPessoa)){
		$peopleExists = true;
		if($invObj->isInventory($hexInventario)){
			$inventoryExists = true;
		}
	}else if($invObj->isInventory($hexPessoa)){
		if($peopleObj->isPeople($hexInventario)){
			$temp = $hexPessoa;
			$hexPessoa = $hexInventario;
			$hexInventario = $temp;
			$inventoryExists = true;
			$peopleExists = true;
		}
	}

	if($peopleExists && $inventoryExists){  // Ambas as tags existem, inicia o processo de insert/update na tabela Historico.
		// DEU TUDO CERTO
		$OpObj = new TransacaoController($hexPessoa, $hexInventario, $codeArduino, $date, $time);
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
