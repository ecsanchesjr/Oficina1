<?php
class UtilitariosDAO{
	/* Classe onde ficarão acessos ao banco em geral, coisas utilitárias ao sistema. */

	function isPeople($hex){  // verifica se a Hex(RFID) passada é uma pessoa no Banco.
		$bdConn = new UserDAO();
		$conn = $bdConn->connectionDB();
		$verif = "SELECT * FROM Pessoa WHERE pessoa_key = '".$hex."'";

		$result = $conn->query($verif);
		if($result->num_rows==1){
			return(true);
		}else{
			return(false);
		}
	}

	function isInvetory($hex){
		$bdConn = new UserDAO();
		$conn = $bdConn->connectionDB();
		$verif = "SELECT * FROM Inventory WHERE pessoa_key = '".$hex."'";

		$result = $conn->query($verif);
		if($result->num_rows==1){
			return(true);
		}else{
			return(false);
		}	
	}
}
?>
