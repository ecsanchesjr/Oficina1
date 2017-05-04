<?php
class UtilitariosControllerClass{
	/* Classe de utilitários ao sistema, porém sem acesso ao banco. */

	function verifHexTypes($hex1, $hex2, $hexPessoa, $hexInventario){
		$util = new UtilitariosDAO();
		if($util->isPeople($hex1)){
			$hexPessoa = $hex1;
			$hexInventario = $hex2;
		}else{
			$hexPessoa = $hex2;
			$hexInventario = $hex1;
		}
	}
}
?>
