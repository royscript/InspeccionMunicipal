<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$datos = array();
if($_GET['modificar']=='SI'){
	$sql = "SELECT * FROM `grupo`";
}else{//Restringir para que vea solo su grupo y los sin grupo
	$sql = "SELECT * FROM `grupo` WHERE `ID_GRUPO` LIKE '".$_GET['grupo']."' OR `NOMBRE_GRUPO` LIKE '%SIN%'";
}
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos[] = array(
		"id"=>$inspector['ID_GRUPO'],
		"nombre"=>$inspector['NOMBRE_GRUPO']
	);
}
echo json_encode($datos);//mostrar_inspectores
?>