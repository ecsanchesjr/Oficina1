<?php
	include("../model/AutoCompleteDAO.php");

	$obj = new AutoCompleteDAO();

	echo json_encode($obj->getItensName());
?>
