<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/categoria_empresa.class.php");
if(isset($_SESSION['usuario'])){
@$ID_CATEGORIA_EMPRESA = $_POST['ID_CATEGORIA_EMPRESA'];
@$NOMBRE_CATEGORIA_EMPRESA = $_POST['NOMBRE_CATEGORIA_EMPRESA'];
@$DESCRIPCION_CATEGORIA_EMPRESA = $_POST['DESCRIPCION_CATEGORIA_EMPRESA'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new categoria_empresa($ID_CATEGORIA_EMPRESA,$NOMBRE_CATEGORIA_EMPRESA,$DESCRIPCION_CATEGORIA_EMPRESA);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new categoria_empresa($ID_CATEGORIA_EMPRESA,$NOMBRE_CATEGORIA_EMPRESA,$DESCRIPCION_CATEGORIA_EMPRESA);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new categoria_empresa($ID_CATEGORIA_EMPRESA,$NOMBRE_CATEGORIA_EMPRESA,$DESCRIPCION_CATEGORIA_EMPRESA);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new categoria_empresa($ID_CATEGORIA_EMPRESA,$NOMBRE_CATEGORIA_EMPRESA,$DESCRIPCION_CATEGORIA_EMPRESA);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxClaseNegocio'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `CATEGORIA_EMPRESA` "
															," `ID_CATEGORIA_EMPRESA` AS Value, CONCAT(`NOMBRE_CATEGORIA_EMPRESA`,' ',`DESCRIPCION_CATEGORIA_EMPRESA`) AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>