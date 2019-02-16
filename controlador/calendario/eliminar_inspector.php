<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$id = $_GET['id'];
$sql = "DELETE FROM `inspector` WHERE `ID_INSPECTOR` =".$id;
$conexion->ejecutar_query($sql);
?>