<?php
include("ConexaoDAO.php");

class RelatoriosDAO{

		function getListLoanedItems(){
			//Irá retornar os dados de todos os empréstimos atuais
			$query = "SELECT i.inventario_nome, i.inventario_sala, e.emprestimo_data, p.pessoa_nome FROM Emprestimo e, Inventario i, Pessoa p";
			$query .= " WHERE e.emprestimo_inventario = i.inventario_id AND e.emprestimo_pessoa = p.pessoa_regescola"

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();

			$RS = $obj->query($query);
			while($row = $RS->fetch_assoc()){

			}
		}

		function getListHistoricDevolutionsItems(){
			//Irá retornar os dados de historico de devoluções
			$query = "SELECT i.inventario_nome, i.inventario_sala, h.historico_dataemprestimo, h.historico_datadevolucao, p.pessoa_nome ";
			$query .= "FROM Inventario i, Historico h, Pessoa p ";
			$query .= "WHERE i.inventario_id = h.historico_inventario AND h.historico_pessoa = p.pessoa_regescola";

			$conn = new ConexaoDAO();
			$obj = $conn->connectionDB();

			$RS = $obj->query($query);
			while($row = $RS->fetch_assoc()){

			}
		}

		
}
?>
