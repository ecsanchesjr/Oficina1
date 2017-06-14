<?php
include("ConexaoDAO.php");
class AutoCompleteDAO{
	public $arrayNames = array();

	function getItensName(){
		$query = "SELECT DISTINCT inventario_nome FROM Inventario";
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();
		$ResultSet = $obj->query($query);

		while($rows = $ResultSet->fetch_assoc()){
			$arrayNames[] = $rows['inventario_nome'];
		}
		return($arrayNames);
	}
}
?>
