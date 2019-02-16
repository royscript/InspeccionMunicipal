<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/preguntas_checklist.class.php");
if(isset($_SESSION['usuario'])){
@$ID_PREGUNTAS_CHECKLIST = $_POST['ID_PREGUNTAS_CHECKLIST'];
@$ID_OPERATIVO = $_POST['ID_OPERATIVO'];
@$CONTENIDO_PREGUNTAS_CHECKLIST = $_POST['CONTENIDO_PREGUNTAS_CHECKLIST'];
@$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST = $_POST['REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new preguntas_checklist($ID_PREGUNTAS_CHECKLIST,$ID_OPERATIVO,$CONTENIDO_PREGUNTAS_CHECKLIST,$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new preguntas_checklist($ID_PREGUNTAS_CHECKLIST,$ID_OPERATIVO,$CONTENIDO_PREGUNTAS_CHECKLIST,$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new preguntas_checklist($ID_PREGUNTAS_CHECKLIST,$ID_OPERATIVO,$CONTENIDO_PREGUNTAS_CHECKLIST,$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new preguntas_checklist($ID_PREGUNTAS_CHECKLIST,$ID_OPERATIVO,$CONTENIDO_PREGUNTAS_CHECKLIST,$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxOperativo'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `operativo` "
															," `ID_OPERATIVO` AS Value, `NOMBRE_OPERATIVO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>