<?php
include("../model/ConexaoDAO.php");
include("../model/InventarioDAO.php");

$itemNome = ucwords($_POST['itemNome']);
$itemDescricao = ucfirst($_POST['itemDescricao']);;
$itemSala = $_POST['itemSala'];
$itemBloco = $_POST['itemBloco'];
$itemTags = json_decode($_POST['itemTag'], true);

$obj = new InventarioDAO();

$obj->insertInventory($itemNome, $itemDescricao, $itemSala, $itemBloco, $itemTags);
?>
