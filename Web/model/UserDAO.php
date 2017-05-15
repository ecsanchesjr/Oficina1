<?php
include("ConexaoDAO.php");

class UserDAO{
	// Classe que controla a usuario e o login do mesmo
	public $connect;

	function tryConn($user, $pass){
		// Inicia a conexão do Usuário no sistema
		$obj = new ConexaoDAO();
		$this->connect = $obj->connectionDB();
		$ctrl = $this->verifUserExists($user, $pass);
		return($ctrl);
	}


	function verifUserExists($user, $pass){
		// Verifica se o usuário existe no banco
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

	function getNameUser($nick){
		// Retorna o nome do usuário conectado
		$obj = new ConexaoDAO();
		$this->connect = $obj->connectionDB();

		$search = "SELECT p.pessoa_nome FROM Pessoa p, Usuario u WHERE u.usuario_nick = ";
		$search .= "'$nick' AND u.usuario_regescola = p.pessoa_regescola;";
		$result = $this->connect->query($search);

		$RowsData = $result->fetch_assoc();
		return($RowsData['pessoa_nome']);
	}

	function getReUser($nick){
		// Retorna o RE do usuário conectado
		$obj = new ConexaoDAO();
		$this->connect = $obj->connectionDB();

		$search = "SELECT p.pessoa_regescola FROM Pessoa p, Usuario u WHERE u.usuario_nick = ";
		$search .= "'$nick' AND u.usuario_regescola = p.pessoa_regescola;";
		$result = $this->connect->query($search);

		$RowsData = $result->fetch_assoc();
		return($RowsData['pessoa_regescola']);
	}
}
?>
