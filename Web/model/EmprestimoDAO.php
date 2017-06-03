<?php
class EmprestimoDAO{
	private $id;
	// Classe que controla os acessos na tabela Emprestimo

	function verifIfIsLoaned($inventario){
		// método que verifica se o item passado está emprestado, ou seja, está na tabela emprestimo
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$verif = "SELECT * FROM Emprestimo ";
		$verif .= "WHERE emprestimo_inventario = '".$inventario."';";

		$resultVerif = $obj->query($verif);

		if($resultVerif->num_rows==1){ // select encontrou algo
			mysqli_close($obj);
			$RowsData = $resultVerif->fetch_assoc();
			$this->id = $RowsData['emprestimo_id'];
			return(true);
		}else{
			return(false);
		}
	}

	function getLoanPeopleId($inventario){
		// Retorna o Id(RE) da pessoa que emprestou o item
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$get = "SELECT emprestimo_pessoa FROM Emprestimo ";
		$get .= "WHERE emprestimo_inventario = '".$inventario."';";

		$resultVerif = $obj->query($get);
		$RowsData = $resultVerif->fetch_assoc();
		return($RowsData['emprestimo_pessoa']);
	}

	function getLoanDate($inventario){
		// Retorna a data e hora do emprestimo do item
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$get = "SELECT emprestimo_data FROM Emprestimo ";
		$get .= "WHERE emprestimo_inventario = '".$inventario."';";

		$resultVerif = $obj->query($get);
		$RowsData = $resultVerif->fetch_assoc();
		return($RowsData['emprestimo_data']);
	}

	function insertNewEmpRow($inventario, $pessoa, $dayDate, $timeDate){
		// Insere uma nova Row na tabela de emprestimo
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$insert = "INSERT INTO Emprestimo ";
		$insert .= "(emprestimo_inventario, emprestimo_pessoa, emprestimo_data) VALUES";
		$insert .= "('".$inventario."', '".$pessoa."', '".$dayDate." ".date_format($timeDate, 'H:i:s')."');";

		$obj->query($insert);
		mysqli_close($obj);
	}

	function deleteEmpRow(){
		// Deleta a row da Tabela de Empresimo
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$delete = "DELETE FROM Emprestimo ";
		$delete .= "WHERE emprestimo_id = '".$this->id."';";

		$obj->query($delete);
		mysqli_close($obj);
	}
}
?>
