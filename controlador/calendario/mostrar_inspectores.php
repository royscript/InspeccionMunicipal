<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$datos = array();
$sql = "SELECT * FROM `inspector`";
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_INSPECTOR'],
		"nombre"=>$inspector['NOMBRE_INSPECTOR'],
		"rut"=>$inspector['RUT_INSPECTOR']
	);
}
echo json_encode($datos);//mostrar_inspectores
?>