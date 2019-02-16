<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$datos = array();
$sql = "SELECT * FROM `actividad`";
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_ACTIVIDAD'],
		"nombre"=>$inspector['NOMBRE_ACTIVIDAD']
	);
}
echo json_encode($datos);//mostrar_inspectores
?>