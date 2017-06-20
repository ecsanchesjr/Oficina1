<?php
include("../model/AdminDAO.php");
session_start();

$nick = $_SESSION["usuario"];

$obj = new AdminDAO();

echo $obj->isAdm($nick);
?>
