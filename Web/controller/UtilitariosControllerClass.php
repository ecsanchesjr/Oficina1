<?php
class UtilitariosControllerClass{
	/* Classe de utilitários ao sistema, porém sem acesso ao banco. */

	function verifHexTypes($hex, $hexPessoa){
		$util = new UtilitariosDAO();
		if($util->isPeople($hex)){
			$hexPessoa = $hex;
			return("<Prossiga>");
		}else{
			return("<Tag de Pessoa nao encontrada>");
		}
	}
}
?>
