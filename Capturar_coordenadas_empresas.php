<html>
<head></head>
<body>
<?php
set_time_limit(0);
include_once("modelo/conexion.php");
$conexion = new Database(); 
$sql = "SELECT 
ID_EMPRESAS_A_INTERVENIR,
REPLACE(
REPLACE(
REPLACE(
REPLACE(`DIRECCION_EMPRESAS_A_INTERVENIR`,'JOSE SANTIAGO ',''),
'2DO PISO',''),
'1ER PISO',''),
'LOCAL','') AS DIRECCION_MODIFICADA
FROM `empresas_a_intervenir` 
WHERE `DIRECCION_EMPRESAS_A_INTERVENIR` LIKE '%JOSE SANTIAGO ALDUNATE%'
		";
$registros = $conexion->listar($sql);
foreach($registros as $datos){
	localizar($datos['ID_EMPRESAS_A_INTERVENIR'],$datos['DIRECCION_MODIFICADA']);
}



function localizar($id,$direc){
		$conexion2 = new Database();
 	    $localizar= $direc.", Coquimbo, Chile";
 
		// urlencode codifica datos de texto modificando simbolos como acentos
		//$localizar = $direccion.", Coquimbo, Chile";
		$direccion = urlencode($localizar);
		// envio la consulta a Google map api
		$url = "http://maps.google.com/maps/api/geocode/json?address={".$direccion."}";
		// recibo la respuesta en formato Json
		$datosjson = file_get_contents($url);
		// decodificamos los datos Json
		$datosmapa = json_decode($datosjson, true);
		// Esperar 1 segundo para no saturar a google maps de consultas
		usleep(1000000);
		// si recibimos estado o status igual a OK, es porque se encontro la direccion
		if($datosmapa['status']='OK'){
			// asignamos los datos
			if(isset($datosmapa['results'][0]['geometry']['location']['lat'])){
				$latitud = $datosmapa['results'][0]['geometry']['location']['lat'];
				$longitud = $datosmapa['results'][0]['geometry']['location']['lng'];
				$localizacion = $datosmapa['results'][0]['formatted_address'];
				// Guardamos los datos en una matriz
				$query = "UPDATE `empresas_a_intervenir` SET
							`LATITUD_EMPRESAS_A_INTERVENIR` = '".$latitud."',
							`LONGITUD_EMPRESAS_A_INTERVENIR` = '".$longitud."'
							WHERE `ID_EMPRESAS_A_INTERVENIR` =".$id;
				$query = $conexion2->ejecutar_query($query);
			}else{
				echo "<br>Sin resultados id ".$id." url = ".$url." direccion ".$localizar;
			}
		}
}
?>
</body>
</html>