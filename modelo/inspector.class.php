<?php
include_once("conexion.php");
Class inspector{
	//Atributos
	private $ID_INSPECTOR = null;
	private $ID_INSPECTOR_A_CARGO = null;
	private $NOMBRE_INSPECTOR = null;
	private $RUT_INSPECTOR = null;
	private $conexion = null;
	private $nombre_tabla = 'inspector';
	private $id_tabla = 'ID_INSPECTOR';
	
	//Constructor
	function __construct($ID_INSPECTOR,$ID_INSPECTOR_A_CARGO,$NOMBRE_INSPECTOR,$RUT_INSPECTOR) {
		$this->ID_INSPECTOR = $ID_INSPECTOR;
		$this->ID_INSPECTOR_A_CARGO = $ID_INSPECTOR_A_CARGO;
		$this->NOMBRE_INSPECTOR = $NOMBRE_INSPECTOR;
		$this->RUT_INSPECTOR = $RUT_INSPECTOR;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_INSPECTOR_A_CARGO`,`NOMBRE_INSPECTOR`,`RUT_INSPECTOR`)
				VALUES
				('".$this->ID_INSPECTOR_A_CARGO."','".$this->NOMBRE_INSPECTOR."','".$this->RUT_INSPECTOR."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_INSPECTOR_A_CARGO` = '".$this->ID_INSPECTOR_A_CARGO."',
				`NOMBRE_INSPECTOR` = '".$this->NOMBRE_INSPECTOR."',
				`RUT_INSPECTOR` = '".$this->RUT_INSPECTOR."'
				WHERE `".$this->id_tabla."` = '".$this->ID_INSPECTOR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_INSPECTOR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " inspector ";
		$clausulaWhere = " ";
		$datos = $this->conexion->listarJtables($tablas,$campos,$clausulaWhere,$jtSorting,$jtStartIndex,$jtPageSize);
		$this->conexion->cerrarConexion();
		return $datos;
	}
	
	
	//Funciones privadas
	private function devolver_datos_tabla($resultado_query){
		$result = "SELECT * FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."` LIKE '".$this->conexion->ultimo_id()."'";
		if($resultado_query){
			$result = $this->conexion->consulta($result);
			$result = $this->conexion->extraer_registro();
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = $result;
			$this->conexion->cerrarConexion();
		}else{
			$result = $this->conexion->consulta($result);
			$result = $this->conexion->extraer_registro();
			$jTableResult = array();
			$jTableResult['Result'] = "ERROR";
			$jTableResult['Record'] = $result;
			$this->conexion->cerrarConexion();
		}
		return json_encode($jTableResult);
	}
}
?>