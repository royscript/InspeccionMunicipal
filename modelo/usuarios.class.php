<?php
include_once("conexion.php");
Class usuario{
	//Atributos
	private $ID_USUARIO = null;
	private $ID_PERMISO = null;
	private $USUARIO_USUARIO = null;
	private $CONTRASENA_USUARIO = null;
	private $TIPO_USUARIO = null;
	private $conexion = null;
	private $nombre_tabla = 'usuario';
	private $id_tabla = 'ID_USUARIO';
	
	//Constructor
	function __construct($ID_USUARIO,$ID_PERMISO,$USUARIO_USUARIO,$CONTRASENA_USUARIO,$TIPO_USUARIO) {
		$this->ID_USUARIO = $ID_USUARIO;
		$this->ID_PERMISO = $ID_PERMISO;
		$this->USUARIO_USUARIO = $USUARIO_USUARIO;
		$this->CONTRASENA_USUARIO = $CONTRASENA_USUARIO;
		$this->TIPO_USUARIO = $TIPO_USUARIO;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_PERMISO`,`USUARIO_USUARIO`,`CONTRASENA_USUARIO`,`TIPO_USUARIO`)
				VALUES
				('".$this->ID_PERMISO."','".$this->USUARIO_USUARIO."','".$this->CONTRASENA_USUARIO."','".$this->TIPO_USUARIO."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_PERMISO` = '".$this->ID_PERMISO."',
				`USUARIO_USUARIO` = '".$this->USUARIO_USUARIO."',
				`CONTRASENA_USUARIO` = '".$this->CONTRASENA_USUARIO."',
				`TIPO_USUARIO` = '".$this->TIPO_USUARIO."'
				WHERE `".$this->id_tabla."` = '".$this->ID_USUARIO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_USUARIO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " usuario ";
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