<?php
header('Content-Type: application/json');
include_once("../modelo/conexion.php");
$accion = $_GET['accion'];
$conexion = new Database();
if($accion=='mostrar_cuestionario'){
	$datos = array();
	$sql = "SELECT * 
			FROM  `preguntas_checklist`
			WHERE `ID_OPERATIVO` =".$_GET['id_operativo'];
	$registros = $conexion->listar($sql);
	foreach($registros as $inspector){
		$datos[] = array(
			"ID_PREGUNTAS_CHECKLIST"=>$inspector['ID_PREGUNTAS_CHECKLIST'],
			"ID_OPERATIVO"=>$inspector['ID_OPERATIVO'],
			"CONTENIDO_PREGUNTAS_CHECKLIST"=>$inspector['CONTENIDO_PREGUNTAS_CHECKLIST'],
			"REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST"=>$inspector['REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST']
		);
	}
	echo json_encode($datos);//mostrar_inspectores
}else if($accion=='buscar_empresa'){
	$rut = $_GET['rut'];
	$datos = array();
	$sql = "SELECT * 
			FROM  `empresas_a_intervenir`
			WHERE `RUT_EMPRESAS_A_INTERVENIR` LIKE '".$rut."'";
	$registros = $conexion->listar($sql);
	foreach($registros as $inspector){
		$datos[] = array(
			"ID"=>$inspector['ID_EMPRESAS_A_INTERVENIR'],
			"NOMBRE"=>$inspector['NOMBRE_EMPRESAS_A_INTERVENIR'],
			"NOMBRE_FANTASIA"=>'',
			"NOMBRE_ADMINISTRADOR"=>$inspector['NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR']
		);
	}
	echo json_encode($datos);//mostrar_inspectores
}else if($accion=='autocompletar_rut_empresa'){
	$rut = $_GET['rut'];
	$conexion = new Database();
	$sql = "SELECT * 
			FROM  `empresas_a_intervenir`
			WHERE `RUT_EMPRESAS_A_INTERVENIR` LIKE '".$rut."'";
	$registros = $conexion->listar($sql);
	$datos = array();
	foreach($registros as $datos_sql){
		$datos[] = array("label"=>$datos_sql['NOMBRE_MARCA']);
	}
	echo json_encode($datos);	
}
?>