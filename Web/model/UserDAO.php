<?php

class UserDAO(){

	public $connect;

	function connectionDB($serverHost, $userHost, $passwdHost, $db){
		$conn = new mysqli($serverHost, $userHost, $passwdHost, $db);
		if($conn->connect_errno){
			<script>alert("Erro na conexão com o banco.");</script>
			return(null);
		}
		return($conn);
	}

	function tryConn($user, $pass){
		$this->connect = connectionDB("localhost", "root", "123", "saci");
		$ctrl = verifUserExists($user, $pass);
		return($ctrl);
	}

	function verifUserExists($user, $pass){
		$errUser=0;
		$errPass=0;
		$search = "SELECT usuario_senha IN usuario WHERE usuario_nick =";
		$search .= "'$user'";

		if($result = $connect->query($search)){
			while($RowsData = $result->mysqli_fetch_array()){
				if(strcmp($pass, $RowsData['usuario_senha'])){
					return(true);
				}else{
					$errPass="Senha inválida.";
					return(false);
				}
			}
		}else{
			$errUser="Usuário não encontrado.";
			return(false);
		}
	}
}
?>
