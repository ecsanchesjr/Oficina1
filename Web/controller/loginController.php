<?php
	include("../model/UserDAO.php");

	session_start();
	$con = new UserDAO();
	$obj = $con->tryConn($_POST['nick'], $_POST['passwd']);
	/*
	* Se objeto for falso, então ocorreu algum erro na verificação de usuário.
	*/
	if($obj){
		$_SESSION["usuario"] = $_POST['nick'];
		$_SESSION["senha"] = $_POST['passwd'];
		$_POST['nick'] = "";
		$_POST['passwd'] = "";
		echo "ok";
		exit();
	}else{
		echo "error";
		exit();
	}
?>
