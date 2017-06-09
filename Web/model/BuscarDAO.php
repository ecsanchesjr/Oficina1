<?php
include("ConexaoDAO.php");

class BuscarDAO{
	public $item;

	function __construct($search){
		$this->item = $search;
	}

	function getItemLocationByName(){
		// Retorna a quantidade de itens por sala em relação ao nome pesquisado.
		$query = "SELECT inventario_nome, inventario_sala, count(*) as ItensSala, sala_numero, sala_bloco ";
		$query .= "FROM Inventario, Sala ";
		$query .= "WHERE inventario_sala = sala_id AND inventario_nome LIKE '%".$this->item."%' ";
		$query .= "GROUP BY inventario_nome,inventario_sala";

		$conn = new ConexaoDAO();
		$obj = $conn->connectionDB();
		$rs = $obj->query($query);

		if(mysqli_num_rows($rs)!=0){
			echo '<thead>
						<tr>
							<th class="styleBasic">Nome do Item</th>
							<th class="styleBasic">Disponível (Total)</th>
							<th class="styleBasic">Número da Sala</th>
							<th class="styleBasic">Bloco</th>
						</tr>
					</thead>
					<tbody>';
		}else{
			echo '<p style="font-size: 15px">
				Nenhum item com este nome foi encontrado.
			</p>';
		}

		while($rows = $rs->fetch_assoc()){
			$query1 = "SELECT count(*) as ItemEmp ";
			$query1 .= "FROM Emprestimo, Sala, Inventario ";
			$query1 .= "WHERE inventario_sala = sala_id ";
			$query1 .= "AND emprestimo_inventario = inventario_id ";
			$query1 .= "AND inventario_nome = '".$rows['inventario_nome']."' ";
			$query1 .= "AND inventario_sala = '".$rows['inventario_sala']."'";

			$obj1 = $conn->connectionDB();
			$rs1 = $obj1->query($query1);
			$rows1 = $rs1->fetch_assoc();

			$total = $rows['ItensSala'];
			$disp = $total - $rows1['ItemEmp'];

			echo "<tr>
						<td>".$rows['inventario_nome']."</td>
						<td>".$disp." (".$total.")"."</td>
						<td>".$rows['sala_numero']."</td>
						<td>".$rows['sala_bloco']."</td>
					</tr>";
					mysqli_close($obj1);
		}
		echo "</tbody>";
		mysqli_close($obj);
	}
}

?>
