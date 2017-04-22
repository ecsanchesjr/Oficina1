<?php
	include("../model/UserDAO.php");
	include("../index.php");
	session_start();

	$obj = tryConn($_POST['nick'], $_POST['passwd']);
	if($obj){
		header("refresh: 1; url=../view/Home.php");
	}else{
		<script>
			var errUser = echo $errUser;
			var errPass = echo $errPass;

			document.getElementById('labelUser') = errUser;
			document.getElementById('labelPass') = errPass;
		</script>
	}
?>
