<?php
include_once("conexion.php");
Class categoria_de_la_empresa{
	//Atributos
	private $ID_CATEGORIA_DE_LA_EMPRESA = null;
	private $ID_EMPRESAS_A_INTERVENIR = null;
	private $ID_CATEGORIA_EMPRESA = null;
	private $ROL_CATEGORIA_DE_LA_EMPRESA = null;
	private $ESTADO_CATEGORIA_DE_LA_EMPRESA = null;
	private $conexion = null;
	private $nombre_tabla = 'CATEGORIA_DE_LA_EMPRESA';
	private $id_tabla = 'ID_CATEGORIA_DE_LA_EMPRESA';
	
	//Constructor
	function __construct($ID_CATEGORIA_DE_LA_EMPRESA,$ID_EMPRESAS_A_INTERVENIR,$ID_CATEGORIA_EMPRESA,$ROL_CATEGORIA_DE_LA_EMPRESA,$ESTADO_CATEGORIA_DE_LA_EMPRESA) {
		$this->ID_CATEGORIA_DE_LA_EMPRESA = $ID_CATEGORIA_DE_LA_EMPRESA;
		$this->ID_EMPRESAS_A_INTERVENIR = $ID_EMPRESAS_A_INTERVENIR;
		$this->ID_CATEGORIA_EMPRESA = $ID_CATEGORIA_EMPRESA;
		$this->ROL_CATEGORIA_DE_LA_EMPRESA = $ROL_CATEGORIA_DE_LA_EMPRESA;
		$this->ESTADO_CATEGORIA_DE_LA_EMPRESA = $ESTADO_CATEGORIA_DE_LA_EMPRESA;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_EMPRESAS_A_INTERVENIR`,`ID_CATEGORIA_EMPRESA`,
				ROL_CATEGORIA_DE_LA_EMPRESA,ESTADO_CATEGORIA_DE_LA_EMPRESA,
				`FECHA_REGISTRO_CATEGORIA_DE_LA_EMPRESA`)
				VALUES
				('".$this->ID_EMPRESAS_A_INTERVENIR."','".$this->ID_CATEGORIA_EMPRESA."','".$this->ROL_CATEGORIA_DE_LA_EMPRESA."','".$this->ESTADO_CATEGORIA_DE_LA_EMPRESA."',NOW())";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_EMPRESAS_A_INTERVENIR` = '".$this->ID_EMPRESAS_A_INTERVENIR."',
				`ID_CATEGORIA_EMPRESA` = '".$this->ID_CATEGORIA_EMPRESA."',
				ROL_CATEGORIA_DE_LA_EMPRESA = '".$this->ROL_CATEGORIA_DE_LA_EMPRESA."',
				ESTADO_CATEGORIA_DE_LA_EMPRESA = '".$this->ESTADO_CATEGORIA_DE_LA_EMPRESA."',
				`FECHA_REGISTRO_CATEGORIA_DE_LA_EMPRESA` = NOW()
				WHERE `".$this->id_tabla."` = '".$this->ID_CATEGORIA_DE_LA_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_CATEGORIA_DE_LA_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " CATEGORIA_DE_LA_EMPRESA ";
		$clausulaWhere = " WHERE `ID_EMPRESAS_A_INTERVENIR` = ".$this->ID_EMPRESAS_A_INTERVENIR;
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