<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$id = $_GET['id'];
$sql = "DELETE FROM `actividad` WHERE `ID_ACTIVIDAD` =".$id;
$conexion->ejecutar_query($sql);
?>