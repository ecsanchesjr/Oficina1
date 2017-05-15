<?php
include("../model/InventarioDAO.php");
include("../model/PessoaDAO.php");
include("../model/EmprestimoDAO.php");
include("../model/HistoricoDAO.php");

class TransacaoController{
	// Classe que controla as ações após o envio do arduino, ela irá executar as verificações para saber se é devolução ou não.
	
	private $hexPessoa;
	private $hexInventario;

	private $pessoa;
	private $inventario;
	private $codeSala; // sala_id
	private $dayDate;
	private $timeDate;
	private $pessoaEmp;
	private $dateEmp;

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

	function opFunction(){  // funcão que agrupa as ações do objeto
		$empObj = new EmprestimoDAO();
		$histObj = new HistoricoDAO();

		if($empObj->verifIfIsLoaned($this->inventario)){  // verifica se o retorno é de Emprestado ou Não
			$this->pessoaEmp = $empObj->getLoanPeopleId($this->inventario); //  retorna o RE da pessoa que emprestou
			$this->dateEmp = $empObj->getLoanDate($this->inventario); // retorna a data do Emprestimo
			$histObj->insertNewHistRow($this->inventario, $this->pessoa, $this->pessoaEmp, $this->dayDate, $this->timeDate, $this->dateEmp, $this->codeSala);  // Como existe row em emprestimo, então é uma devolução.
			$empObj->deleteEmpRow(); // deleta a ROw da tabela emprestimo
			return("<Devolucao concluida>");
		}else{
			$empObj->insertNewEmpRow($this->inventario, $this->pessoa, $this->dayDate, $this->timeDate); //Insere na tabela Emprestimo
			return("<Emprestimo concluido>");
		}
	}

}
?>
