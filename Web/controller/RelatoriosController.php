<?php
	include("../model/RelatoriosDAO.php");
	switch($_POST['code']){
		case 1:
			//Chamar relatórios DAO
			break;

		case 2:

			break;

		case 3:

			break;
		case 4:
			$rel = new RelatoriosDAO();
			$rel->getListRoomsDifferent();
			break;
	}
?>
