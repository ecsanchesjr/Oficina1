<?php
class ConexaoDAO{
	private $conn;
	
	function connectionDB(){
		$this->conn = new mysqli("localhost", "root", "123", "saci");
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query('SET character_set_connection=utf8');
		$this->conn->query('SET character_set_client=utf8');
		$this->conn->query('SET character_set_results=utf8');
		return($this->conn);
	}
}
?>
