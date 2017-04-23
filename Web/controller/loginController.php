<?php
	include("../model/UserDAO.php");
	include("../index.php");
	session_start();

	$obj = tryConn($_POST['nick'], $_POST['passwd']);
	if($obj){
		echo "Ok";
		exit();
	}else{
		<script>
			var errUser = echo $errUser;
			var errPass = echo $errPass;
		</script>
		echo "Error";
		exit();
	}
?>
