<?php
	include("../model/BuscarDAO.php");

	$field = $_POST['txtSearch'];

	if(!$field){
		echo "vazio";
	}else{
		$search = new BuscarDAO($field);
		echo $search->getItemLocationByName();
	}
?>
