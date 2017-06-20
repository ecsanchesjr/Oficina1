<?php
include("ConexaoDAO.php");

class AdminDAO{

	function isAdm($nick){
		$query = "SELECT * FROM Usuario ";
		$query .= "WHERE usuario_nick = '".$nick."'";
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();
		$rs = $obj->query($query) or die($obj->error."");
		$row = $rs->fetch_assoc();

		if($row['usuario_permissao'] == 1){
			return("yes");
		}else{
			return("no");
		}
	}

}
?>
