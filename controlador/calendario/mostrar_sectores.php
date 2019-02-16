<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$datos = array();
$sql = "SELECT * FROM `sector`";
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_SECTOR'],
		"nombre"=>$inspector['NOMBRE_SECTOR']
	);
}
echo json_encode($datos);//mostrar_inspectores
?>