<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();

$mes = $_GET['mes'];
$ano = $_GET['ano'];
$inicio_horas_diurnas_de_lunes_a_jueves = '17:30:00';
$numero_de_dia_jueves = '4';
$sql_de_lunes_a_jueves = "(
							SELECT	SUM(
											TIME_TO_SEC(
												TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),
												CONCAT(C.`FECHA_INICIO`,' ','".$inicio_horas_diurnas_de_lunes_a_jueves."'))
											)
										) AS HORAS_DIURNAS_DE_LUNES_A_JUEVES
							FROM `calendario` C
							INNER JOIN `turnos_inspectores` T
							ON(C.`ID_CALENDARIO`=T.`ID_CALENDARIO`)
							INNER JOIN `inspector` I
							ON(I.`ID_INSPECTOR`=T.`ID_INSPECTOR`)
							WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
							AND DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
							AND (DAYOFWEEK(C.`FECHA_INICIO`)-1) <= ".$numero_de_dia_jueves."
							AND (
									C.`HORA_INICIO` >= '".$inicio_horas_diurnas_de_lunes_a_jueves."' 
									OR C.`HORA_FINAL` > '".$inicio_horas_diurnas_de_lunes_a_jueves."'
								)
							AND I.`ID_INSPECTOR` = INSP.`ID_INSPECTOR`
						)";
$inicio_horas_diurnas_de_viernes = '16:30:00';
$numero_de_dia_viernes = '5';
$sql_viernes = "(
					SELECT 	SUM(
									TIME_TO_SEC(
										TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),
										CONCAT(C.`FECHA_INICIO`,' ','".$inicio_horas_diurnas_de_viernes."'))
									)
								
								) AS HORAS_DIURNAS_VIERNES
					FROM `calendario` C
					INNER JOIN `turnos_inspectores` T
					ON(C.`ID_CALENDARIO`=T.`ID_CALENDARIO`)
					INNER JOIN `inspector` I
					ON(I.`ID_INSPECTOR`=T.`ID_INSPECTOR`)
					WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
					AND DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
					AND (DAYOFWEEK(C.`FECHA_INICIO`)-1) = ".$numero_de_dia_viernes."
					AND (
							C.`HORA_INICIO` >= '".$inicio_horas_diurnas_de_viernes."' 
							OR C.`HORA_FINAL` > '".$inicio_horas_diurnas_de_viernes."'
						)
					AND I.`ID_INSPECTOR` = INSP.`ID_INSPECTOR`
				)";
$rango_inicio_dias_festivos = '6';//SABADO
$rango_final_dias_festivos = '1';//DOMINGO
$sql_dias_festivos = "(
						SELECT 	SEC_TO_TIME(
									SUM(
										TIME_TO_SEC(
											TIMEDIFF(CONCAT(C.`FECHA_FINAL`,' ',C.`HORA_FINAL`),CONCAT(C.`FECHA_INICIO`,' ',C.`HORA_INICIO`))
										)
									
									) 
								)AS HORAS_FINES_DE_SEMANA
						FROM `calendario` C
						INNER JOIN `turnos_inspectores` T
						ON(C.`ID_CALENDARIO`=T.`ID_CALENDARIO`)
						INNER JOIN `inspector` I
						ON(I.`ID_INSPECTOR`=T.`ID_INSPECTOR`)
						WHERE DATE_FORMAT(C.`FECHA_INICIO`, '%m') LIKE '".$mes."'
						AND DATE_FORMAT(C.`FECHA_INICIO`, '%Y') LIKE '".$ano."'
						AND (
								(DAYOFWEEK(C.`FECHA_INICIO`)-1) = ".$rango_inicio_dias_festivos."
								OR (DAYOFWEEK(C.`FECHA_INICIO`)) = ".$rango_final_dias_festivos."
							)
						AND I.`ID_INSPECTOR` = INSP.`ID_INSPECTOR`
					)";

//echo json_encode($data);
$datos_inspectores = array();
$sql = "SELECT `ID_INSPECTOR`,
			   `NOMBRE_INSPECTOR`,
			   `RUT_INSPECTOR`,
			   SEC_TO_TIME(
						 	IF(
								".$sql_de_lunes_a_jueves." IS NULL,0,".$sql_de_lunes_a_jueves."
							)
							+
							IF(
								".$sql_viernes." IS NULL,0,".$sql_viernes."
							)
						
			   ) AS HORAS_DIURNAS_LUNES_A_VIERNES,
			   (
					".$sql_dias_festivos."
				) AS HORAS_FINES_DE_SEMANA
		FROM `inspector` INSP";
$registros = $conexion->listar($sql);
foreach($registros as $inspector){
	$datos_inspectores[] = array(
								 "id"=>$inspector['ID_INSPECTOR'],
								 "nombre"=>$inspector['NOMBRE_INSPECTOR'],
								 "horas_diurnas"=>$inspector['HORAS_DIURNAS_LUNES_A_VIERNES'],
								 "horas_festivas"=>$inspector['HORAS_FINES_DE_SEMANA']
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
echo json_encode($datos_inspectores);
?>