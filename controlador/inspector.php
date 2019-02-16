<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/inspector.class.php");
if(isset($_SESSION['usuario'])){
@$ID_INSPECTOR = $_POST['ID_INSPECTOR'];
@$ID_INSPECTOR_A_CARGO = $_POST['ID_INSPECTOR_A_CARGO'];
@$NOMBRE_INSPECTOR = $_POST['NOMBRE_INSPECTOR'];
@$RUT_INSPECTOR = $_POST['RUT_INSPECTOR'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new inspector($ID_INSPECTOR,$ID_INSPECTOR_A_CARGO,$NOMBRE_INSPECTOR,$RUT_INSPECTOR);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new inspector($ID_INSPECTOR,$ID_INSPECTOR_A_CARGO,$NOMBRE_INSPECTOR,$RUT_INSPECTOR);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new inspector($ID_INSPECTOR,$ID_INSPECTOR_A_CARGO,$NOMBRE_INSPECTOR,$RUT_INSPECTOR);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new inspector($ID_INSPECTOR,$ID_INSPECTOR_A_CARGO,$NOMBRE_INSPECTOR,$RUT_INSPECTOR);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxInspectorACargo'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `inspector_a_cargo` "
															," `ID_INSPECTOR_A_CARGO` AS Value, `NOMBRE_INSPECTOR_A_CARGO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>