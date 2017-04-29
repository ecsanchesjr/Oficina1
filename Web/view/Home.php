<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SACI - Área de usuários</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/home.css" />
		</head>
	<body>
		<p class="title giant-title titleAlign textCenter">
			Seja Bem-Vindo ao Portal do SACI
		</p>
		<div class="infoGroup boxInfos">
			<?php
				session_start();
				include("../model/UserDAO.php");
				$obj = new UserDAO();
				$nick = $_SESSION["usuario"];
				echo '<p class="textInfos textCenter">'.$obj->searchNameUser($nick).'</p>';

				$nick = $_SESSION["usuario"];
				echo '<p class="textInfos textCenter">'.$obj->searchReUser($nick).'</p>';
			?>
		</div>
	</body>
</html>
