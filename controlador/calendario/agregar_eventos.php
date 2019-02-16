<?php
header('Content-Type: application/json');
include_once("../../modelo/conexion.php");
$conexion = new Database();
$sector = $_GET['sector'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];
$hora_inicio = $_GET['hora_inicio'];
$hora_final = $_GET['hora_final'];
$cantidad_inspectores = $_GET['cantidad_inspectores'];
$color_de_fondo = $_GET['color_de_fondo'];
$color_de_bordes = $_GET['color_de_bordes'];
$color_de_texto = $_GET['color_de_texto'];
$grupo = $_GET['grupo'];
echo $sql = "INSERT INTO `calendario`
(`ID_SECTOR`,`FECHA_INICIO`,`FECHA_FINAL`,`HORA_INICIO`,`HORA_FINAL`,`CANTIDAD_INSPECTORES`,`COLOR_DE_FONDO`,`COLOR_DE_BORDE`,`COLOR_DE_TEXTO`,`ID_GRUPO`)
VALUES
('".$sector."','".$fecha_inicio."','".$fecha_final."','".$hora_inicio."','".$hora_final."','".$cantidad_inspectores."','".$color_de_fondo."','".$color_de_bordes."','".$color_de_texto."','".$grupo."')";
$conexion->ejecutar_query($sql);
?>