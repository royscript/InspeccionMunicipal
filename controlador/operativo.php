<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/operativo.class.php");
if(isset($_SESSION['usuario'])){
@$ID_OPERATIVO = $_POST['ID_OPERATIVO'];
@$NOMBRE_OPERATIVO = $_POST['NOMBRE_OPERATIVO'];
@$FECHA_OPERATIVO = $_POST['FECHA_OPERATIVO'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new operativo($ID_OPERATIVO,$NOMBRE_OPERATIVO,$FECHA_OPERATIVO);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new operativo($ID_OPERATIVO,$NOMBRE_OPERATIVO,$FECHA_OPERATIVO);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new operativo($ID_OPERATIVO,$NOMBRE_OPERATIVO,$FECHA_OPERATIVO);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new operativo($ID_OPERATIVO,$NOMBRE_OPERATIVO,$FECHA_OPERATIVO);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}
}
?>