<?php
include_once("conexion.php");
Class categoria_empresa{
	//Atributos
	private $ID_CATEGORIA_EMPRESA = null;
	private $NOMBRE_CATEGORIA_EMPRESA = null;
	private $DESCRIPCION_CATEGORIA_EMPRESA = null;
	private $conexion = null;
	private $nombre_tabla = 'CATEGORIA_EMPRESA';
	private $id_tabla = 'ID_CATEGORIA_EMPRESA';
	
	//Constructor
	function __construct($ID_CATEGORIA_EMPRESA,$NOMBRE_CATEGORIA_EMPRESA,$DESCRIPCION_CATEGORIA_EMPRESA) {
		$this->ID_CATEGORIA_EMPRESA = $ID_CATEGORIA_EMPRESA;
		$this->NOMBRE_CATEGORIA_EMPRESA = $NOMBRE_CATEGORIA_EMPRESA;
		$this->DESCRIPCION_CATEGORIA_EMPRESA = $DESCRIPCION_CATEGORIA_EMPRESA;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`NOMBRE_CATEGORIA_EMPRESA`,`DESCRIPCION_CATEGORIA_EMPRESA`)
				VALUES
				('".$this->NOMBRE_CATEGORIA_EMPRESA."','".$this->DESCRIPCION_CATEGORIA_EMPRESA."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`NOMBRE_CATEGORIA_EMPRESA` = '".$this->NOMBRE_CATEGORIA_EMPRESA."',
				`DESCRIPCION_CATEGORIA_EMPRESA` = '".$this->DESCRIPCION_CATEGORIA_EMPRESA."'
				WHERE `".$this->id_tabla."` = '".$this->ID_CATEGORIA_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_CATEGORIA_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " CATEGORIA_EMPRESA ";
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