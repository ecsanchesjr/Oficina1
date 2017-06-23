<?php
include("../model/LocationDAO.php");

$obj = new LocationDAO();

if($_POST['operation'] == 1){ // Busca no banco os blocos
	$obj->getListBlocks();
}else{
	$obj->getListRoomz($_POST['bloco']);
}
?>
