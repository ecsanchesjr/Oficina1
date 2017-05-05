<?php
public $hexPessoa;
public $hexInventario;
public $codeArduino;

public $hex;

$util = new UtilitariosControllerClass();

if(isset($_GET['ardCode']) && isset($_GET['key'])){
	$codeArduino = $_GET['ardCode'];
	$hex = $_GET['key'];
	echo $util->verifHexTypes($hex, $hexPessoa);
}else{
	echo "<erro de envio>";
	exit;
}


?>
