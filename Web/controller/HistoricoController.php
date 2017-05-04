<?php

public $hexPessoa = $_GET['hexP'];
public $hexInventario = $_GET['hexI'];
public $codeArduino = $_GET['codeA'];

$histDAO = new HistoricoDAO($hexPessoa, $hexInventario, $codeArduino);

if($histDAO->verifState() == ESTADO_EMPRESTADO){  // será então uma devolução
	
}else{ // será então um empréstimo

}
?>
