<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/eventos.class.php");
if(isset($_SESSION['usuario'])){
@$ID_EVENTO_VIA_PUBLICA = $_POST['ID_EVENTO_VIA_PUBLICA'];
@$ID_SECTOR = $_POST['ID_SECTOR'];
@$ID_ACTIVIDAD = $_POST['ID_ACTIVIDAD'];
@$ID_GRUPO = $_POST['ID_GRUPO'];
@$FECHA = $_POST['FECHA'];
@$DIRECCION = $_POST['DIRECCION'];
@$DETALLE = $_POST['DETALLE'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new eventos($ID_EVENTO_VIA_PUBLICA,$ID_SECTOR,$ID_ACTIVIDAD,$ID_GRUPO,$FECHA,$DIRECCION,$DETALLE);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new eventos($ID_EVENTO_VIA_PUBLICA,$ID_SECTOR,$ID_ACTIVIDAD,$ID_GRUPO,$FECHA,$DIRECCION,$DETALLE);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new eventos($ID_EVENTO_VIA_PUBLICA,$ID_SECTOR,$ID_ACTIVIDAD,$ID_GRUPO,$FECHA,$DIRECCION,$DETALLE);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$Fecha_inicio = $_POST['Fecha_inicio'];
		$Fecha_final = $_POST['Fecha_final'];
		$buscar_grupo = $_POST['buscar_grupo'];
		$objeto = new eventos('','','','','','','');
		echo $objeto->mostrar($Fecha_inicio,$Fecha_final,$buscar_grupo,$_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);	
	}else if($accion=='comboboxSector'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `sector` "
															," `ID_SECTOR` AS Value, `NOMBRE_SECTOR` AS DisplayText ", "");
		echo json_encode($datos);	
	}else if($accion=='comboboxGrupo'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `grupo` "
															," `ID_GRUPO` AS Value, `NOMBRE_GRUPO` AS DisplayText ", "");
		echo json_encode($datos);	
	}else if($accion=='comboboxActividad'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `actividad` "
															," `ID_ACTIVIDAD` AS Value, `NOMBRE_ACTIVIDAD` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>