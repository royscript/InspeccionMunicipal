<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();

$mes = $_GET['mes'];
$ano = $_GET['ano'];

//echo json_encode($data);
$datos_horas_por_materia = array();
$sql = "SELECT	M.`NOMBRE_ACTIVIDAD`,
				SEC_TO_TIME( 
					SUM(
						TIME_TO_SEC(
							TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),CONCAT(C.`FECHA_INICIO`,' ',C.`HORA_INICIO`))
						)
					)
				) AS HORAS
		FROM `calendario` C
		INNER JOIN `actividades_del_evento` AE
		ON(C.`ID_CALENDARIO`=AE.`ID_CALENDARIO`)
		INNER JOIN `actividad` M
		ON(AE.`ID_ACTIVIDAD`=M.`ID_ACTIVIDAD`)
		WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
		AND DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
		GROUP BY M.`ID_ACTIVIDAD`
		ORDER BY SEC_TO_TIME( 
					SUM(
						TIME_TO_SEC(
							TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),CONCAT(C.`FECHA_INICIO`,' ',C.`HORA_INICIO`))
						)
					)
				) DESC";
$registros = $conexion->listar($sql);
foreach($registros as $materia){
	$datos_horas_por_materia[] = array(
								 "nombre"=>$materia['NOMBRE_ACTIVIDAD'],
								 "horas"=>$materia['HORAS']
								 );
}
echo json_encode($datos_horas_por_materia);
?>