<?php
include("../model/ConexaoDAO.php");
include("../model/InventarioDAO.php");

$itemNome = $_POST['itemNome'];
$itemDescricao = $_POST['itemDescricao'];
$itemSala = $_POST['itemSala'];
$itemBloco = $_POST['itemBloco'];
$itemtags = strtolower($_POST['itemTags']);

$obj = new InventarioDAO();

$obj->insertInventory($itemNome, $itemDescricao, $itemSala, $itemBloco, $itemTags);
?>
