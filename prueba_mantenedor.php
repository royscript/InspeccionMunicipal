<?php
include_once("modelo/conexion.php");
$conexion = new Database();
/*echo $query = "INSERT INTO `mantenedor`
				(`NOMBRE_MANTENEDOR`,`UBICACION_MANTENEDOR`)
				VALUES
				('CATEGORIA NEGOCIO','categoria_empresa.php')";*/
		$query = $conexion->ejecutar_query($query);
?>