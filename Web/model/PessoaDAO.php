<?php
class PessoaDAO{
	// Classe que faz o acesso à tabela pessoa do Banco de Dados

	function getRePeopleByHex($hex){  // retorna o Re da pessoa a partir da tag
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$search = "SELECT pessoa_regescola FROM Pessoa WHERE pessoa_key = '".$hex."';";
		$rs = $obj->query($search);
		$RowsData = $rs->fetch_assoc();
		mysqli_close($obj);
		return($RowsData['pessoa_regescola']);
	}

	function isPeople($hex){  // verifica se a Hex(RFID) passada é uma pessoa no Banco.
		$bdConn = new ConexaoDAO();
		$conn = $bdConn->connectionDB();
		$verif = "SELECT * FROM Pessoa WHERE pessoa_key = '".$hex."'";

		$result = $conn->query($verif);
		if($result->num_rows==1){
			return(true);
		}else{
			return(false);
		}
	}
}
?>
