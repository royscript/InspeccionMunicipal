<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$nombre = $_GET['nombre'];
$sql = "INSERT INTO `sector` 
(`NOMBRE_SECTOR`)
VALUES
('".$nombre."')";
$conexion->ejecutar_query($sql);
$datos = array();
$sql = "SELECT * FROM `sector` WHERE `ID_SECTOR` =".$conexion->ultimo_id();
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_SECTOR'],
		"nombre"=>$inspector['NOMBRE_SECTOR']
	);
}
echo json_encode($datos);
?>