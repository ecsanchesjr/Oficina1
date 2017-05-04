<?php
public $hexPessoa;
public $hexInventario;
public $codeArduino;

public $hex1;
public $hex2;

if(isset($_GET['ardCode']) && isset($_GET['hex1']) && isset($_GET['hex2'])){
	$codeArduino = $_GET['ardCode'];
	$hex1 = $_GET['hex1'];
	$hex2 = $_GET['hex2'];
}

$util = new UtilitariosControllerClass();

$util->verifHexTypes($hex1, $hex2, $hexPessoa, $hexInventario);


?>
