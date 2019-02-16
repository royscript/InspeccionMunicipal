<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/permisos.class.php");
include_once("../modelo/mantenedor_del_permiso.class.php");
if(isset($_SESSION['usuario'])){
@$ID_PERMISO = $_POST['ID_PERMISO'];
@$NOMBRE_PERMISO = $_POST['NOMBRE_PERMISO'];
@$ID_MANTENEDOR_DEL_PERMISO = $_POST['ID_MANTENEDOR_DEL_PERMISO'];
@$ID_MANTENEDOR = $_POST['ID_MANTENEDOR'];
@$LISTAR_MANTENEDOR_DEL_PERMISO = $_POST['LISTAR_MANTENEDOR_DEL_PERMISO'];
@$INGRESAR_MANTENEDOR_DEL_PERMISO = $_POST['INGRESAR_MANTENEDOR_DEL_PERMISO'];
@$MODIFICAR_MANTENEDOR_DEL_PERMISO = $_POST['MODIFICAR_MANTENEDOR_DEL_PERMISO'];
@$ELIMINAR_MANTENEDOR_DEL_PERMISO = $_POST['ELIMINAR_MANTENEDOR_DEL_PERMISO'];
@$NOMBRE_MANTENEDOR = $_POST['NOMBRE_MANTENEDOR'];
@$UBICACION_MANTENEDOR = $_POST['UBICACION_MANTENEDOR'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new permisos($ID_PERMISO,$NOMBRE_PERMISO);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new permisos($ID_PERMISO,$NOMBRE_PERMISO);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new permisos($ID_PERMISO,$NOMBRE_PERMISO);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new permisos('','');
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='listarMantenedorDelPermiso'){
		$objeto = new mantenedor_del_permiso($ID_MANTENEDOR_DEL_PERMISO,$ID_MANTENEDOR,$ID_PERMISO,$LISTAR_MANTENEDOR_DEL_PERMISO,$INGRESAR_MANTENEDOR_DEL_PERMISO,$MODIFICAR_MANTENEDOR_DEL_PERMISO,$ELIMINAR_MANTENEDOR_DEL_PERMISO);
		echo $objeto->mostrar($_GET['IdPermiso'],$_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);	
	}else if($accion=='CrearMantenedorDelPermiso'){
		$objeto = new mantenedor_del_permiso($ID_MANTENEDOR_DEL_PERMISO,$ID_MANTENEDOR,$ID_PERMISO,$LISTAR_MANTENEDOR_DEL_PERMISO,$INGRESAR_MANTENEDOR_DEL_PERMISO,$MODIFICAR_MANTENEDOR_DEL_PERMISO,$ELIMINAR_MANTENEDOR_DEL_PERMISO);
		print $objeto->crear();
	}else if($accion=='ModificarMantenedorDelPermiso'){
		$objeto = new mantenedor_del_permiso($ID_MANTENEDOR_DEL_PERMISO,$ID_MANTENEDOR,$ID_PERMISO,$LISTAR_MANTENEDOR_DEL_PERMISO,$INGRESAR_MANTENEDOR_DEL_PERMISO,$MODIFICAR_MANTENEDOR_DEL_PERMISO,$ELIMINAR_MANTENEDOR_DEL_PERMISO);
		print $objeto->modificar();
	}else if($accion=='eliminarMantenedorDelPermiso'){
		$objeto = new mantenedor_del_permiso($ID_MANTENEDOR_DEL_PERMISO,$ID_MANTENEDOR,$ID_PERMISO,$LISTAR_MANTENEDOR_DEL_PERMISO,$INGRESAR_MANTENEDOR_DEL_PERMISO,$MODIFICAR_MANTENEDOR_DEL_PERMISO,$ELIMINAR_MANTENEDOR_DEL_PERMISO);
		print $objeto->eliminar();
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
	}else if($accion=='comboboxMantenedor'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `mantenedor` "
															," `ID_MANTENEDOR` AS Value, `NOMBRE_MANTENEDOR` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>