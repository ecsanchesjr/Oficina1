<?php
include("ConexaoDAO.php");

class RelatoriosDAO{

		function getListLoanedItems(){
			//Irá retornar os dados de todos os empréstimos atuais
			$query = "SELECT i.inventario_nome, s.sala_numero, s.sala_bloco, e.emprestimo_data, p.pessoa_nome ";
			$query .= "FROM Emprestimo e, Inventario i, Pessoa p, Sala s";
			$query .= " WHERE e.emprestimo_inventario = i.inventario_id AND e.emprestimo_pessoa = p.pessoa_regescola ";
			$query .= "AND i.inventario_sala = s.sala_id";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$RS = $obj->query($query);

			echo '<thead>
		            <tr>
		               <th class="cel-width">Nome do Item</th>
		               <th class="cel-width">Sala Atual</th>
		               <th class="cel-width">Bloco Atual</th>
		               <th class="cel-width">Data de Empréstimo</th>
		               <th class="cel-width">Pessoa que Emprestou</th>
		            </tr>
        			</thead>
					<tbody>';

			while($RowsData = $RS->fetch_assoc()){
				echo "<tr>
		               <td>".$RowsData['inventario_nome']."</td>
		               <td>".$RowsData['sala_numero']."</td>
		               <td>".$RowsData['sala_bloco']."</td>
		               <td>".date('d/m/Y H:i:s', strtotime($RowsData['emprestimo_data']))."</td>
							<td>".$RowsData['pessoa_nome']."</td>
            		</tr>";
			}
			echo "</tbody>";
			mysqli_close($obj);
		}

		function getListHistoricDevolutionsItems(){
			//Irá retornar os dados de historico de devoluções
			$query = "SELECT i.inventario_nome, s.sala_numero, s.sala_bloco, h.historico_dataemprestimo, h.historico_datadevolucao, p.pessoa_nome ";
			$query .= "FROM Inventario i, Historico h, Pessoa p, Sala s ";
			$query .= "WHERE i.inventario_id = h.historico_inventario AND h.historico_pessoa = p.pessoa_regescola AND i.inventario_sala = s.sala_id";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$RS = $obj->query($query) or die($obj->error."");

			echo '<thead>
		            <tr>
		               <th class="cel-width">Nome do Item</th>
		               <th class="cel-width">Sala Atual</th>
		               <th class="cel-width">Bloco Atual</th>
		               <th class="cel-width">Data de Empréstimo</th>
							<th class="cel-width">Pessoa que Emprestou</th>
		               <th class="cel-width">Data de Devolução</th>
							<th class="cel-width">Pessoa que Devolveu</th>
		            </tr>
        			</thead>
					<tbody>';

			while($RowsData = $RS->fetch_assoc()){
				$query2 = "SELECT p.pessoa_nome ";
				$query2 .= "FROM Historico h, Pessoa p ";
				$query2 .= "WHERE h.historico_pessoadevolucao = p.pessoa_regescola";

				$obj2 = $conn->connectionDB();
				$result2 = $obj2->query($query2) or die($obj2->error."");
				$data2 = $result2->fetch_assoc();

				echo "<tr>
		               <td>".$RowsData['inventario_nome']."</td>
		               <td>".$RowsData['sala_numero']."</td>
		               <td>".$RowsData['sala_bloco']."</td>
		               <td>".date('d/m/Y H:i:s', strtotime($RowsData['historico_dataemprestimo']))."</td>
							<td>".$RowsData['pessoa_nome']."</td>
							<td>".date('d/m/Y H:i:s', strtotime($RowsData['historico_datadevolucao']))."</td>
							<td>".$data2['pessoa_nome']."</td>
            		</tr>";

				mysqli_close($obj2);
			}
			echo "</tbody>";
			mysqli_close($obj);
		}

		function getListFrequencyItem(){
			// Retorna a frequencia de emprestimo de cada item
			$qtdTotal = $this->getTotalFreqAbs();
			$queryInv = "SELECT DISTINCT inventario_nome FROM Inventario";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$rs = $obj->query($queryInv);

			echo '<thead>
						<tr>
							<th class="cel-width">Nome do Item</th>
							<th class="cel-width">Qtd de Empréstimos</th>
							<th class="cel-width">Frequência Relativa(%)</th>
						</tr>
					</thead>
					<tbody>';

			while($row = $rs->fetch_assoc()){
				$count = 0;
				$queryHist = "SELECT historico_id ";
				$queryHist .= "FROM Historico, Inventario ";
				$queryHist .= "WHERE inventario_id = historico_inventario AND inventario_nome = '".$row['inventario_nome']."'";

				$objH = $conn->connectionDB();
				$rs1 = $objH->query($queryHist);
				$count += mysqli_num_rows($rs1);

				$queryEmp = "SELECT emprestimo_id ";
				$queryEmp .= "FROM Emprestimo, Inventario ";
				$queryEmp .= "WHERE emprestimo_inventario = inventario_id AND inventario_nome = '".$row['inventario_nome']."'";

				$objE = $conn->connectionDB();
				$rs2 = $objE->query($queryEmp);
				$count += mysqli_num_rows($rs2);

				mysqli_free_result($rs1);
				mysqli_free_result($rs2);
				mysqli_close($objH);
				mysqli_close($objE);

				$freqRel = $count/$qtdTotal * 100;

				echo "<tr>
							<td>".ucwords($row['inventario_nome'])."</td>
							<td>".$count."</td>
							<td>".$freqRel."</td>
						</tr>";
			}
			echo "</tbody>";
			mysqli_close($obj);
		}

		function getTotalFreqAbs(){
			// Retorna o total de emprestimos geral já feitos
			$query = "SELECT count(*) + ";
			$query .= "(SELECT count(*) FROM Emprestimo) ";
			$query .= "FROM Historico";

			$conn = new ConexaoDAO();
			$objSum = $conn->connectionDB();
			$rs = $objSum->query($query);
			$data = $rs->fetch_assoc();

			foreach($data as $key => $val){
					return($val);
			}
		}

		function getListRoomsDifferent(){
			//Irá retornar a lista de itens que estão em salas diferentes das salas de origem
			$query = "SELECT inventario_id, inventario_nome, sala_numero, sala_bloco";
			$query .= " FROM Inventario, Sala";
			$query .= " WHERE inventario_sala != inventario_salaorigem AND sala_id = inventario_sala";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();
			$ResultSet = $obj->query($query);

			echo '<thead>
		            <tr>
		                <th class="cel-width">Nome do Item</th>
		                <th class="cel-width">Sala Atual</th>
		                <th class="cel-width">Bloco Atual</th>
		                <th class="cel-width">Sala de Origem</th>
		                <th class="cel-width">Bloco de Origem</th>
		            </tr>
        			</thead>
					<tbody>';

			//fazer um while dando echo em cada iteração
			while($RowsData = $ResultSet->fetch_assoc()){
				$newQuery = "SELECT s.sala_numero, s.sala_bloco";
				$newQuery .= " FROM Inventario i, Sala s";
				$newQuery .= " WHERE i.inventario_salaorigem = s.sala_id AND i.inventario_id = '".$RowsData['inventario_id']."' ";

				$obj2 = $conn->connectionDB();
				$result2 = $obj2->query($newQuery);
				$data2 = $result2->fetch_assoc();

				echo "<tr>
		               <td>".$RowsData['inventario_nome']."</td>
		               <td>".$RowsData['sala_numero']."</td>
		               <td>".$RowsData['sala_bloco']."</td>
		               <td>".$data2['sala_numero']."</td>
							<td>".$data2['sala_bloco']."</td>
            		</tr>";
				mysqli_close($obj2);
			}
			echo "</tbody>";
		}
}
?>
