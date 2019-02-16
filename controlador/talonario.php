<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/talonario.class.php");
if(isset($_SESSION['usuario'])){
@$ID_TALONARIO = $_POST['ID_TALONARIO'];
@$ID_INSPECTOR = $_POST['ID_INSPECTOR'];
@$NOMBRE_TALONARIO = $_POST['NOMBRE_TALONARIO'];
@$NUMERO_INICIAL = $_POST['NUMERO_INICIAL'];
@$NUMERO_FINAL = $_POST['NUMERO_FINAL'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new talonario($ID_TALONARIO,$ID_INSPECTOR,$NOMBRE_TALONARIO,$NUMERO_INICIAL,$NUMERO_FINAL);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new talonario($ID_TALONARIO,$ID_INSPECTOR,$NOMBRE_TALONARIO,$NUMERO_INICIAL,$NUMERO_FINAL);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new talonario($ID_TALONARIO,$ID_INSPECTOR,$NOMBRE_TALONARIO,$NUMERO_INICIAL,$NUMERO_FINAL);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new talonario($ID_TALONARIO,$ID_INSPECTOR,$NOMBRE_TALONARIO,$NUMERO_INICIAL,$NUMERO_FINAL);
		echo $objeto->mostrar($_POST['buscar_numero_talonario'],$_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTalonario'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `inspector` "
															," `ID_INSPECTOR` AS Value, `NOMBRE_INSPECTOR` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>