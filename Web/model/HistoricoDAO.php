<?php
include("InventarioDAO.php");
include("PessoaDAO.php");
include("UserDAO.php");
include("../controller/constant_states.php");
class HistoricoDAO{
	/* Classe que vai controlar os métodos relacionados à tabela Histórico */

	public $hexPessoa;
	public $hexInventario;

	public $pessoa;
	public $inventario;
	public $codeSala; // sala_id
	public $dayDate;
	public $timeDate;
	public $id;

	function __construct($hexP, $hexI, $codeA, $date, $time){
		$this->hexPessoa = $hexP;
		$this->hexInventario = $hexI;
		$this->codeSala = $codeA;
		$this->dayDate = $date;
		$this->timeDate = $time;

		$invObj = new InventarioDAO();
		$PeoObj = new PessoaDAO();

		// Pegar dados de item e pessoa
		$this->pessoa = $PeoObj->getRePeopleByHex($this->hexPessoa);
		$this->inventario = $invObj->getIdInventoryByHex($this->hexInventario);
	}

	function verifIfIsLoaned(){  // método que verifica se o estado no historico é de item emprestado(0), também pega o id, caso exista
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$verif = "SELECT historico_estado, historico_id FROM Historico ";
		$verif .= "WHERE historico_inventario = '".$this->inventario."' AND historico_estado = '".ESTADO_EMPRESTADO."';";

		$resultVerif = $obj->query($verif);
		if($resultVerif->num_rows==1){ // select encontrou algo
			$RowsData = $resultVerif->fetch_assoc();
			$this->id = $RowsData['historico_id'];
			mysqli_close($obj);
			return(true);
		}else{
			return(false);
		}
	}

	function insertNewHistRow(){ // Caso a transação seja um Empréstimo, cria uma nova linha na tabela historico
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$insert = "INSERT INTO Historico";
		$insert .= "(historico_inventario, historico_pessoa, historico_dataemprestimo, historico_estado)";
		$insert .= "VALUES('".$this->inventario."', '".$this->pessoa."', '".$this->dayDate." ".date_format($this->timeDate, 'H:i:s')."', '".ESTADO_EMPRESTADO."')";

		$obj->query($insert);
		mysqli_close($obj);
	}

	function updateStateHistRow(){ // Caso a transação seja de Devolução, apenas dá um Update na Row já existente
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$update = "UPDATE Historico SET historico_estado = '".ESTADO_DEVOLVIDO."', ";
		$update .= "historico_datadevolucao = '".$this->dayDate." ".date_format($this->timeDate, 'H:i:s')."' ";
		$update .= "WHERE historico_id = '".$this->id."' AND historico_inventario = '".$this->inventario."'";

		$obj->query($update);
		mysqli_close($obj);
	}

	function opFunction(){  // funcão que agrupa as ações do objeto
		if($this->verifIfIsLoaned()){  // verifica se o retorno é de Emprestado ou Não
			$this->updateStateHistRow();	// se for emprestado então chama a função de atualização de estado, vai pra devolvido
			return("<Devolucao concluida>");
		}else{
			$this->insertNewHistRow();  // se não estiver emprestado então gera uma linha, simbolizando um emprestimo
			return("<Emprestimo concluido>");
		}
	}
} // fim da classe
?>
