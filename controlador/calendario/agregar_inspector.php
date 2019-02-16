<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$nombre = $_GET['nombre'];
$rut = $_GET['rut'];
$sql = "INSERT INTO `inspector` 
(`NOMBRE_INSPECTOR`,`RUT_INSPECTOR`)
VALUES
('".$nombre."','".$rut."')";
$conexion->ejecutar_query($sql);
$datos = array();
$sql = "SELECT * FROM `inspector` WHERE `ID_INSPECTOR` =".$conexion->ultimo_id();
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_INSPECTOR'],
		"nombre"=>$inspector['NOMBRE_INSPECTOR'],
		"rut"=>$inspector['RUT_INSPECTOR']
	);
}
echo json_encode($datos);
?>