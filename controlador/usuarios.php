<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/usuarios.class.php");
if(isset($_SESSION['usuario'])){
@$ID_USUARIO = $_POST['ID_USUARIO'];
@$ID_PERMISO = $_POST['ID_PERMISO'];
@$USUARIO_USUARIO = $_POST['USUARIO_USUARIO'];
@$CONTRASENA_USUARIO = $_POST['CONTRASENA_USUARIO'];
@$TIPO_USUARIO = $_POST['TIPO_USUARIO'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new usuario($ID_USUARIO,$ID_PERMISO,$USUARIO_USUARIO,$CONTRASENA_USUARIO,$TIPO_USUARIO);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new usuario($ID_USUARIO,$ID_PERMISO,$USUARIO_USUARIO,$CONTRASENA_USUARIO,$TIPO_USUARIO);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new usuario($ID_USUARIO,$ID_PERMISO,$USUARIO_USUARIO,$CONTRASENA_USUARIO,$TIPO_USUARIO);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new usuario($ID_USUARIO,$ID_PERMISO,$USUARIO_USUARIO,$CONTRASENA_USUARIO,$TIPO_USUARIO);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTipoPermiso'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `permiso` "
															," `ID_PERMISO` AS Value, `NOMBRE_PERMISO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>