<?php
include("ConexaoDAO.php");

class LocationDAO{
	function getListBlocks(){
		$query = "SELECT bloco_id FROM Bloco";
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$rs = $obj->query($query);
		while($rows = $rs->fetch_assoc()){
			echo '<option onmousedown="bloco='.$rows['bloco_id'].'">'.$rows['bloco_id'].'</option>';
		}
	}

	function getListRoomz($bloco){
		$query = "SELECT sala_numero FROM Sala ";
		$query .= "WHERE sala_bloco = '".$bloco."';";
		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();

		$rs = $obj->query($query);
		while($rows = $rs->fetch_assoc()){
			echo "BATATA ";
			echo "<option>".$rows['sala_numero']."</option>";
		}
	}
}
?>
