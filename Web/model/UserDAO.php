<?php

class UserDAO{

	public $connect;

	function connectionDB($serverHost, $userHost, $passwdHost, $db){
		$this->conn = new mysqli($serverHost, $userHost, $passwdHost, $db);
		return($this->conn);
	}

	function tryConn($user, $pass){
		$this->connect = $this->connectionDB("localhost", "root", "123", "saci");
		$ctrl = $this->verifUserExists($user, $pass);
		//return($ctrl);
		return($ctrl);
	}

	function verifUserExists($user, $pass){
		$search = "SELECT usuario_passwd FROM usuario WHERE usuario_nick =";
		$search .= "'$user';";

		$result = $this->connect->query($search);
		if($result->num_rows == 1){   // verifica se encontrou algum usuário de acordo com o dado passado
			$RowsData = $result->fetch_assoc();
			if($pass == $RowsData['usuario_passwd']){  // testa a senha para ver se esta igual
				return(true);   //TUDO DEU CERTO
			}else{
				return(false);  // SENHA INVÁLIDA
			}
		}else{
			return(false);  // USUÁRIO NÃO ENCONTRADO
		}
	}
}
?>
