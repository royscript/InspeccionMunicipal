<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$nombre = $_GET['nombre'];
$sql = "INSERT INTO `actividad` 
(`NOMBRE_ACTIVIDAD`)
VALUES
('".$nombre."')";
$conexion->ejecutar_query($sql);
$datos = array();
$sql = "SELECT * FROM `actividad` WHERE `ID_ACTIVIDAD` =".$conexion->ultimo_id();
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_ACTIVIDAD'],
		"nombre"=>$inspector['NOMBRE_ACTIVIDAD']
	);
}
echo json_encode($datos);
?>