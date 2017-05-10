<?php
class HistoricoDAO{
	/* Classe que vai controlar os métodos relacionados à tabela Histórico */
	date_default_timezone_set ("America/Sao_Paulo");

	public $hexPessoa;
	public $hexInventario;
	public $codeArduino;

	function __construct($hexP, $hexI, $codeA){
		$this->hexPessoa = $hexP;
		$this->hexInventario = $hexI;
		$this->codeArduino = $codeA;
	}

	function verifState(){
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$verif = "SELECT h.historico_estado FROM Historico h, Inventario i"
		$verif .= "WHERE h.historico_inventario = i.inventario_id AND i.inventario_key ='"$this->hexInventario"';";

		$resultVerif = $obj->query($verif);
		if($resultVerif->num_rows==1){ // select encontrou algo
			$RowsData = $resultVerif->fetch_assoc();

			if($RowsData['historico_inventario'] == ESTADO_EMPRESTADO){
				return(ESTADO_EMPRESTADO);
			}else{
				return(ESTADO_DEVOLVIDO);
			}
		}
	}

	function createNewLoan($hex){
		$conn = new UserDAO();
		$obj = $conn->connectionDB();

		$hue = "INSERT INTO Departamento(departamento_sigla, departamento_nome) VALUES('BATATA', 'DUNHA123');";

		$obj->query($hue);
		return("<Executou>");
	}

}
?>
