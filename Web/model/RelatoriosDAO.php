<?php
include("ConexaoDAO.php");

class RelatoriosDAO{

		function getListLoanedItems(){
			//Irá retornar os dados de todos os empréstimos atuais
			$query = "SELECT i.inventario_nome, i.inventario_sala, e.emprestimo_data, p.pessoa_nome FROM Emprestimo e, Inventario i, Pessoa p";
			$query .= " WHERE e.emprestimo_inventario = i.inventario_id AND e.emprestimo_pessoa = p.pessoa_regescola";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();

			$RS = $obj->query($query);
			while($row = $RS->fetch_assoc()){

			}
			mysqli_close($obj);
		}

		function getListHistoricDevolutionsItems(){
			//Irá retornar os dados de historico de devoluções
			//SELECT i.inventario_nome, i.inventario_sala, h.historico_dataemprestimo, h.historico_datadevolucao, p.pessoa_nome, p.pessoa_nome FROM Inventario i, Historico h, Pessoa p WHERE i.inventario_id = h.historico_inventario AND h.historico_pessoa = p.pessoa_regescola AND h.historico_pessoadevolucao = p.pessoa_regescola

			$query = "SELECT i.inventario_nome, i.inventario_sala, h.historico_dataemprestimo, h.historico_datadevolucao, p.pessoa_nome ";
			$query .= "FROM Inventario i, Historico h, Pessoa p ";
			$query .= "WHERE i.inventario_id = h.historico_inventario AND h.historico_pessoa = p.pessoa_regescola";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();

			$RS = $obj->query($query);
			while($row = $RS->fetch_assoc()){

			}
			mysqli_close($obj);
		}

		function getListFrequencyItem(){
			//Irá retornar uma lista com a frequencia de empréstimo de cada item
			$query .= "SELECT i.inventario_nome, count(h.historico_id) ";
			$query .= "FROM Historico h ";
			$query .= "JOIN Inventario i ON h.historico_inventario = i.inventario_id ";
			$query .= "GROUP BY i.inventario_nome";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$RS = $obj->query($query1);
			mysqli_close($obj);

			$data = $RS->fetch_assoc();

		}

		function getListRoomsDifferent(){
			//Irá retornar a lista de itens que estão em salas diferentes das salas de origem
			$query = "SELECT inventario_id, inventario_nome, sala_numero, sala_bloco";
			$query .= "FROM Inventario, Sala";
			$query .= "WHERE inventario_sala = sala_id AND inventario_sala != inventario_salaorigem";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$ResultSet = $obj->query($query);

			echo "<thead>
		            <tr>
		                <th>Nome do Item</th>
		                <th>Sala Atual</th>
		                <th>Bloco Atual</th>
		                <th>Sala de Origem</th>
		                <th>Bloco de Origem</th>
		            </tr>
        			</thead>
					<tbody>";

			//fazer um while dando echo em cada iteração
			while($RowsData = $ResultSet->fetch_assoc()){
				$newQuery = "SELECT s.sala_numero, s.sala_bloco";
				$newQuery .= "FROM Inventario i, Sala s";
				$newQuery .= "WHERE i.inventario_salaorigem = s.sala_id AND i.inventario_id = '".$RowsData['inventario_id']."' ";

				$obj2 = $conn->connectionDB();
				$result2 = $obj2->query($newQuery);
				$data2 = $result2->fetch_assoc();

				echo "<tr>
		               <td>".$RowsData['i.inventario_nome']."</td>
		               <td>".$RowsData['s.sala_numero']."</td>
		               <td>".$RowsData['s.sala_bloco']."</td>
		               <td>".$data2['s.sala_numero']."</td>
							<td>".$data2['s.sala_bloco']."</td>
            		</tr>";
				mysqli_close($obj2);
			}
			echo "</tbody>";

		}



}
?>
