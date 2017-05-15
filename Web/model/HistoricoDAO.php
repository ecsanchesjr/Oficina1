<?php

class HistoricoDAO{
	// Classe que vai controlar os métodos relacionados à tabela Histórico

	function insertNewHistRow($inventario, $pessoaDevol, $pessoaEmp, $dayDate, $timeDate, $dateEmp, $sala){
		// Caso a transação seja um Empréstimo, cria uma nova linha na tabela historico
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$insert = "INSERT INTO Historico";
		$insert .= "(historico_inventario, historico_pessoa, historico_pessoadevolucao, historico_dataemprestimo, historico_datadevolucao)";
		$insert .= "VALUES('".$inventario."', '".$pessoaEmp."', '".$pessoaDevol."', '".$dateEmp."','".$dayDate." ".date_format($timeDate, 'H:i:s')."')";

		$obj->query($insert);
		mysqli_close($obj);

		$this->updateRoomInventory($inventario, $sala);
	}

	function updateRoomInventory($inventario, $sala){
		//Em toda devolução pode ocorrer de ser devolvido em uma sala diferente da "certa", para isso essa função atualiza a sala do item
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$update = "UPDATE Inventario SET inventario_sala = '".$sala."' WHERE inventario_id = '".$inventario."'";

		$obj->query($update);
		mysqli_close($obj);
	}

}
?>
