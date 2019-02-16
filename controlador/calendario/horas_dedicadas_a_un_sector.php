<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();

$mes = $_GET['mes'];
$ano = $_GET['ano'];

//echo json_encode($data);
$datos_sectores = array();
$sql = "SELECT	S.`NOMBRE_SECTOR`,
				SEC_TO_TIME( 
					SUM(
						TIME_TO_SEC(
							TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),CONCAT(C.`FECHA_INICIO`,' ',C.`HORA_INICIO`))
						)
					)
				) AS HORAS
		FROM `calendario` C
		INNER JOIN `sector` S
		ON(C.`ID_SECTOR`=S.`ID_SECTOR`)
		WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
		AND DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
		GROUP BY S.`ID_SECTOR`
		ORDER BY SEC_TO_TIME( 
					SUM(
						TIME_TO_SEC(
							TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),CONCAT(C.`FECHA_INICIO`,' ',C.`HORA_INICIO`))
						)
					)
				) DESC";
$registros = $conexion->listar($sql);
foreach($registros as $sector){
	$datos_sectores[] = array(
								 "nombre"=>$sector['NOMBRE_SECTOR'],
								 "horas"=>$sector['HORAS']
								 );
}
echo json_encode($datos_sectores);
?>