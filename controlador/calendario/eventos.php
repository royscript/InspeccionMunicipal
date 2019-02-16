<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
date_default_timezone_set('America/Santiago');//or change to whatever timezone you want
if (!isset($_GET['mes']) || !isset($_GET['ano'])) {
	die("Please provide a date range.");
}

$mes = $_GET['mes'];
$ano = $_GET['ano'];
$id_grupo = $_GET['id'];
//echo json_encode($data);
if($id_grupo==''){
}else{
	$id_grupo = ' AND C.`ID_GRUPO`='.$id_grupo;
}
$datos = array();
$sql = "SELECT  C.`ID_CALENDARIO`,
				C.`FECHA_INICIO`,
				C.`FECHA_FINAL`,
				C.`HORA_INICIO`,
				C.`HORA_FINAL`,
				C.`CANTIDAD_INSPECTORES`,
				S.`NOMBRE_SECTOR`,
				C.`COLOR_DE_FONDO`,
				C.`COLOR_DE_BORDE`,
				C.`COLOR_DE_TEXTO`,
				G.`NOMBRE_GRUPO`
		FROM `calendario` C
		INNER JOIN `sector` S
		ON(C.ID_SECTOR=S.ID_SECTOR)
		INNER JOIN `grupo` G
		ON(C.`ID_GRUPO`=G.`ID_GRUPO`)
		WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
		".$id_grupo."
		AND(
			DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
			OR DATE_FORMAT(C.`FECHA_FINAL`, '%m') LIKE '".$mes."'
		)
		";
$registros = $conexion->listar($sql);
foreach($registros as $evento){
	//Datos Actividades
	$sql_actividades = "SELECT A.`NOMBRE_ACTIVIDAD` AS NOMBRE_ACTIVIDAD,
	                           A.`ID_ACTIVIDAD` AS ID_ACTIVIDAD 
						FROM `actividad` A
						INNER JOIN `actividades_del_evento` AE
						ON(A.`ID_ACTIVIDAD`=AE.`ID_ACTIVIDAD`)
						WHERE AE.`ID_CALENDARIO` =".$evento['ID_CALENDARIO'];
	$datos_actividades = array();
	$registros_actividades = $conexion->listar($sql_actividades);
	$titulo = ' \n Actividades : ';
	$contador = 1;
	$cantidad_registros = count($registros_actividades);
	foreach($registros_actividades as $actividades){
		if($contador==$cantidad_registros){
			$titulo .= $actividades['NOMBRE_ACTIVIDAD'].'. ';
		}else{
			$titulo .= $actividades['NOMBRE_ACTIVIDAD'].', ';
		}
		$datos_actividades[] = array("id"=>$actividades['ID_ACTIVIDAD'],"nombre"=>$actividades['NOMBRE_ACTIVIDAD']);
	}
	//Datos Actividades
	
	
	//Datos inspectores
	$sql_inspectores = "SELECT I.`ID_INSPECTOR`,
									   I.`NOMBRE_INSPECTOR`,
									   I.`RUT_INSPECTOR`,
									   T.`ES_CHOFER`
						FROM `calendario` C
						INNER JOIN `turnos_inspectores` T
						ON(C.`ID_CALENDARIO`=T.`ID_CALENDARIO`)
						INNER JOIN `inspector` I
						ON(I.`ID_INSPECTOR`=T.`ID_INSPECTOR`)
						WHERE C.`ID_CALENDARIO` =".$evento['ID_CALENDARIO']."
						ORDER BY I.`ID_INSPECTOR` ASC";
	$datos_inspectores = array();
	$titulo .= ' \n Inspectores : ';
	$registros_inspectores = $conexion->listar($sql_inspectores);
	foreach($registros_inspectores as $inspector){
		if($inspector['ES_CHOFER']=='SI'){
			$chofer = '(chofer)';
		}else{
			$chofer = '';
		}
		if($contador==$cantidad_registros){
			$titulo .= $inspector['NOMBRE_INSPECTOR'].$chofer.'. ';
		}else{
			$titulo .= $inspector['NOMBRE_INSPECTOR'].$chofer.', ';
		}
		$datos_inspectores[] = array("id"=>$inspector['ID_INSPECTOR'],"nombre"=>$inspector['NOMBRE_INSPECTOR'],"conductor"=>$inspector['ES_CHOFER']);
	}
	//Datos Inspectores
	
	
	$datos[] = array(
		"id"=>$evento['ID_CALENDARIO'],
		"title"=>$evento['NOMBRE_SECTOR'].$titulo,
		"actividades"=>$datos_actividades,
		"sector"=>$evento['NOMBRE_SECTOR'],
		"inspectores"=>$datos_inspectores,
		"start"=>$evento['FECHA_INICIO']."T".$evento['HORA_INICIO'],
		"end"=>$evento['FECHA_FINAL']."T".$evento['HORA_FINAL'],
		"cantidad_inspectores"=>$evento['CANTIDAD_INSPECTORES'],
		"backgroundColor"=>$evento['COLOR_DE_FONDO'],
		"borderColor"=>$evento['COLOR_DE_BORDE'],
		"textColor"=>$evento['COLOR_DE_TEXTO'],
		"nombre_grupo"=>$evento['NOMBRE_GRUPO']
	);
}
/*$datos[] = array(
	"id"=>1,
	"title"=>'.',
	"actividad"=>'Feria',
	"sector"=>'Tierras Blancas',
	"inspectores"=>array(
						array("id"=>1,"nombre"=>"Roy Standen Barraza"),
						array("id"=>2,"nombre"=>"Amanda Standen Barraza"),
				   ),
	"start"=>"2017-01-27T09:00:00",
	"end"=>"2017-01-27T14:00:00"
);
$datos[] = array(
	"id"=>2,
	"title"=>'.',
	"actividad"=>'Feria',
	"sector"=>'La Cantera',
	"inspectores"=>array(
						array("id"=>3,"nombre"=>"Clara Standen Barraza"),
						array("id"=>4,"nombre"=>"Sol Standen Barraza"),
				   ),
	"start"=>"2017-01-27T09:00:00",
	"end"=>"2017-01-27T14:00:00"
);*/
echo json_encode($datos);
?>