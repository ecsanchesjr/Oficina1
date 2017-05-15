<?php
class InventarioDAO{
	// Classe que faz o acesso à tabela Inventario

	function getIdInventoryByHex($hex){  // retorna o Id do item no inventario a partir de sua tag
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$search = "SELECT inventario_id FROM Inventario WHERE inventario_key = '".$hex."';";
		$rs = $obj->query($search);
		$RowsData = $rs->fetch_assoc();
		mysqli_close($obj);
		return($RowsData['inventario_id']);
	}

	function isInventory($hex){  // verifica se a Tag passada é de um item no inventario
		$bdConn = new ConexaoDAO();
		$conn = $bdConn->connectionDB();
		$verif = "SELECT * FROM Inventario WHERE inventario_key = '".$hex."'";

		$result = $conn->query($verif);
		if($result->num_rows==1){
			return(true);
		}else{
			return(false);
		}
	}

}
?>
