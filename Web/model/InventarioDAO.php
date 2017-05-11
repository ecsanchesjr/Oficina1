<?php
class InventarioDAO{
	/* Classe que faz o acesso à tabela Inventario */
	function getIdInventoryByHex($hex){
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$search = "SELECT inventario_id FROM Inventario WHERE inventario_key = '".$hex."';";
		$rs = $obj->query($search);
		$RowsData = $rs->fetch_assoc();
		mysqli_close($obj);
		return($RowsData['inventario_id']);
	}
}
?>
