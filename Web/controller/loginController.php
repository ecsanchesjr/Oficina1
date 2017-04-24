<?php
	include("../model/UserDAO.php");

	$con = new UserDAO();
	$obj = $con->tryConn($_POST['nick'], $_POST['passwd']);
	/*
	* Se objeto for falso, então ocorreu algum erro na verificação de usuário.
	*/
	if($obj){
		echo "ok";
		exit();
	}else{
		echo "error";
		exit();
	}
?>
