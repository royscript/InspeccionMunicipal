<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/juzgado.class.php");
if(isset($_SESSION['usuario'])){
@$ID_JUZGADO = $_POST['ID_JUZGADO'];
@$NOMBRE = $_POST['NOMBRE'];
@$NUMERO = $_POST['NUMERO'];
@$DIRECCION = $_POST['DIRECCION'];
@$HORARIO_DE_ATENCION = $_POST['HORARIO_DE_ATENCION'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new juzgado($ID_JUZGADO,$NOMBRE,$NUMERO,$DIRECCION,$HORARIO_DE_ATENCION);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new juzgado($ID_JUZGADO,$NOMBRE,$NUMERO,$DIRECCION,$HORARIO_DE_ATENCION);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new juzgado($ID_JUZGADO,$NOMBRE,$NUMERO,$DIRECCION,$HORARIO_DE_ATENCION);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new juzgado($ID_JUZGADO,$NOMBRE,$NUMERO,$DIRECCION,$HORARIO_DE_ATENCION);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTipoPermiso'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `permiso` "
															," `NOMBRE` AS Value, `NOMBRE_PERMISO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>