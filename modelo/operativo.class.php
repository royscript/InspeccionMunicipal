<?php
include_once("conexion.php");
Class operativo{
	//Atributos
	private $ID_OPERATIVO = null;
	private $NOMBRE_OPERATIVO = null;
	private $FECHA_OPERATIVO = null;
	private $DIRECCION = null;
	private $HORARIO_DE_ATENCION = null;
	private $conexion = null;
	private $nombre_tabla = 'operativo';
	private $id_tabla = 'ID_OPERATIVO';
	
	//Constructor
	function __construct($ID_OPERATIVO,$NOMBRE_OPERATIVO,$FECHA_OPERATIVO) {
		$this->ID_OPERATIVO = $ID_OPERATIVO;
		$this->NOMBRE_OPERATIVO = $NOMBRE_OPERATIVO;
		$this->FECHA_OPERATIVO = $FECHA_OPERATIVO;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`NOMBRE_OPERATIVO`,`FECHA_OPERATIVO`)
				VALUES
				('".$this->NOMBRE_OPERATIVO."',STR_TO_DATE(REPLACE('".$this->FECHA_OPERATIVO."','-','.') ,GET_FORMAT(date,'EUR')))";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`NOMBRE_OPERATIVO` = '".$this->NOMBRE_OPERATIVO."',
				`FECHA_OPERATIVO` = STR_TO_DATE(REPLACE('".$this->FECHA_OPERATIVO."','-','.') ,GET_FORMAT(date,'EUR'))
				WHERE `".$this->id_tabla."` = '".$this->ID_OPERATIVO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_OPERATIVO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " operativo ";
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