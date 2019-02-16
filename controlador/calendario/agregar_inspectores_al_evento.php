<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$inspectores_evento = $_POST['inspectores_evento'];
$actividades_evento = $_POST['actividades_evento'];
$id_calendario = $_POST['id'];


$sql_eliminar = "DELETE FROM `turnos_inspectores` WHERE `ID_CALENDARIO`=".$id_calendario;
$conexion->ejecutar_query($sql_eliminar);
for($x=0;$x<count($inspectores_evento);$x++){
	$id_inspector = $inspectores_evento[$x]['id'];
	$conductor = $inspectores_evento[$x]['conductor'];
	$sql = "INSERT INTO `turnos_inspectores`
	(`ID_CALENDARIO`,`ID_INSPECTOR`,`ES_CHOFER`)
	VALUES
	('".$id_calendario."','".$id_inspector."','".$conductor."')";
	$conexion->ejecutar_query($sql);
}


$sql_eliminar = "DELETE FROM `actividades_del_evento` WHERE `ID_CALENDARIO`=".$id_calendario;
$conexion->ejecutar_query($sql_eliminar);
for($x=0;$x<count($actividades_evento);$x++){
	$id_actividad = $actividades_evento[$x]['id'];
	$sql = "INSERT INTO `actividades_del_evento`
	(`ID_CALENDARIO`,`ID_ACTIVIDAD`)
	VALUES
	('".$id_calendario."','".$id_actividad."')";
	$conexion->ejecutar_query($sql);
}
?>