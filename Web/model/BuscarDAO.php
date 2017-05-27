<?php
include("ConexaoDAO.php");

class BuscarDAO{
	public $item;

	function __construct($search){
		$this->item = $search;
	}

	function getItemLocationByName(){
		// select count(*), inventario_sala from inventario where inventario_nome LIKE '%martelo%' group by inventario_sala
		// SELECT sala_numero, sala_bloco FROM Sala, Inventario WHERE inventario_sala = sala_id

		$query = "SELECT count(*), sala.sala  FROM Inventario, Sala ";
		$query .= "WHERE inventario_nome LIKE '%".$this->item."%' GROUP BY inventario_sala";

		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();
		$rs = $obj->query($query);

		$RowsData = $rs->fetch_assoc();
		mysqli_close($obj);

		return($RowsData['count(*)']);
	}
}

?>
