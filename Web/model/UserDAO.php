<?php

class UserDAO{

	public $connect;

	function connectionDB(){
		$this->conn = new mysqli("localhost", "root", "123", "saci");
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query('SET character_set_connection=utf8');
		$this->conn->query('SET character_set_client=utf8');
		$this->conn->query('SET character_set_results=utf8');
		return($this->conn);
	}

	function tryConn($user, $pass){
		$this->connect = $this->connectionDB();
		$ctrl = $this->verifUserExists($user, $pass);
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

	function searchNameUser($nick){
		$this->connect = $this->connectionDB();

		$search = "SELECT p.pessoa_nome FROM Pessoa p, Usuario u WHERE u.usuario_nick = ";
		$search .= "'$nick' AND u.usuario_regescola = p.pessoa_regescola;";
		$result = $this->connect->query($search);

		$RowsData = $result->fetch_assoc();
		return($RowsData['pessoa_nome']);
	}

	function searchReUser($nick){
		$this->connect = $this->connectionDB();

		$search = "SELECT p.pessoa_regescola FROM Pessoa p, Usuario u WHERE u.usuario_nick = ";
		$search .= "'$nick' AND u.usuario_regescola = p.pessoa_regescola;";
		$result = $this->connect->query($search);

		$RowsData = $result->fetch_assoc();
		return($RowsData['pessoa_regescola']);
	}
}
?>
