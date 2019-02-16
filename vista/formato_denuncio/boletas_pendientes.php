<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BOLETAS PENDIENTES</title>
</head>

<body>
<?php
include_once("../../modelo/conexion.php");
$ID_TALONARIO = $_GET['id'];
$conexion = new Database();


$sql_talonario = "SELECT `NUMERO_FINAL`,
                         `NUMERO_INICIAL`,
						 NOMBRE_TALONARIO
				  FROM `talonario` WHERE `ID_TALONARIO` = ".$ID_TALONARIO;
$conexion->ejecutar_query($sql_talonario);
$registros_talonario = $conexion->listar($sql_talonario);
foreach($registros_talonario as $datos_talonario){
	echo "<br>Talonario N° ".$datos_talonario['NOMBRE_TALONARIO'];
	echo "<table border='1'>";
	echo "<tr>";
	echo " <td>FECHA</td>";
	echo " <td>NUMERO DE BOLETA</td>";
	echo " <td>ESTADO</td>";
	echo "</tr>";
	for($x = $datos_talonario['NUMERO_INICIAL']; $x<=$datos_talonario['NUMERO_FINAL'];$x++){
		$sql = "SELECT * 
				FROM `denuncio` 
				WHERE `ID_TALONARIO` =  ".$ID_TALONARIO." 
				AND `NUMERO_BOLETA_TALONARIO` = ".$x."
				ORDER BY `NUMERO_BOLETA_TALONARIO` DESC";

		$conexion->ejecutar_query($sql);
		$registros = $conexion->listar($sql);
		if(count($registros)>0){
			foreach($registros as $datos){
				echo "<tr>";
				echo " <td>".$datos['FECHA_INFRACCION']."</td>";
				echo " <td>".$datos['NUMERO_BOLETA_TALONARIO']."</td>";
				echo " <td><strong>REGISTRADO</strong></td>";
				echo "</tr>";
			}	
		}else{
			echo "<tr>";
			echo " <td></td>";
			echo " <td style='color:red;'>".$x."</td>";
			echo " <td style='color:red;'><strong>NO REGISTRADO</strong></td>";
			echo "</tr>";
		}
	}
}

echo "</table>";
?>
</body>
</html>
