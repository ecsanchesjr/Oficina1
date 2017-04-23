<?php

class UserDAO(){

	public $connect;

	function connectionDB($serverHost, $userHost, $passwdHost, $db){
		$conn = new mysqli($serverHost, $userHost, $passwdHost, $db);
		if($conn->connect_errno){
			// ERRO NA CONEXÃO COM O BANCO
			return(null);
		}
		return($conn);
	}

	function tryConn($user, $pass){
		$this->connect = connectionDB("localhost", "root", "123", "saci");
		echo "UAHUHAUAHUA";
		$ctrl = verifUserExists($user, $pass);
		echo "depois da func";
		//return($ctrl);
		return($ctrl);
	}

	function verifUserExists($user, $pass){
		$search = "SELECT usuario_senha FROM usuario WHERE usuario_nick =";
		$search .= "'$user'";

		if($result = $connect->query($search)){   // verifica se encontrou algum usuário de acordo com o dado passado
			while($RowsData = $result->mysqli_fetch_array()){
				if(strcmp($pass, $RowsData['usuario_senha'])){  // testa a senha para ver se esta igual
					return(true);   //TUDO DEU CERTO
				}else{
					return(false);  // SENHA INVÁLIDA
				}
			}
		}else{
			return(false);  // USUÁRIO NÃO ENCONTRADO
		}
	}
}
?>
