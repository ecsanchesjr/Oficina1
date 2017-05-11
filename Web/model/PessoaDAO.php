<?php
class PessoaDAO{
	/* Classe que faz o acesso à tabela pessoa do Banco de Dados */
	function getRePeopleByHex($hex){
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$search = "SELECT pessoa_regescola FROM Pessoa WHERE pessoa_key = '".$hex."';";
		$rs = $obj->query($search);
		$RowsData = $rs->fetch_assoc();
		mysqli_close($obj);
		return($RowsData['pessoa_regescola']);
	}
}
?>
