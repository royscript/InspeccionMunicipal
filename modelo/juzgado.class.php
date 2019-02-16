<?php
include_once("conexion.php");
Class juzgado{
	//Atributos
	private $ID_JUZGADO = null;
	private $NOMBRE = null;
	private $NUMERO = null;
	private $DIRECCION = null;
	private $HORARIO_DE_ATENCION = null;
	private $conexion = null;
	private $nombre_tabla = 'juzgado';
	private $id_tabla = 'ID_JUZGADO';
	
	//Constructor
	function __construct($ID_JUZGADO,$NOMBRE,$NUMERO,$DIRECCION,$HORARIO_DE_ATENCION) {
		$this->ID_JUZGADO = $ID_JUZGADO;
		$this->NOMBRE = $NOMBRE;
		$this->NUMERO = $NUMERO;
		$this->DIRECCION = $DIRECCION;
		$this->HORARIO_DE_ATENCION = $HORARIO_DE_ATENCION;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`NOMBRE`,`NUMERO`,`DIRECCION`,`HORARIO_DE_ATENCION`)
				VALUES
				('".$this->NOMBRE."','".$this->NUMERO."','".$this->DIRECCION."','".$this->HORARIO_DE_ATENCION."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`NOMBRE` = '".$this->NOMBRE."',
				`NUMERO` = '".$this->NUMERO."',
				`DIRECCION` = '".$this->DIRECCION."',
				`HORARIO_DE_ATENCION` = '".$this->HORARIO_DE_ATENCION."'
				WHERE `".$this->id_tabla."` = '".$this->ID_JUZGADO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_JUZGADO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " juzgado ";
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