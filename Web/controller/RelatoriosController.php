<?php
	include("../model/RelatoriosDAO.php");
	$rel = new RelatoriosDAO();
	switch($_POST['code']){
		case 1:
			$rel->getListLoanedItems();
			break;

		case 2:
			$rel->getListHistoricDevolutionsItems();
			break;

		case 3:
			$rel->getListFrequencyItem();
			break;
		case 4:
			$rel->getListRoomsDifferent();
			break;
	}
?>
