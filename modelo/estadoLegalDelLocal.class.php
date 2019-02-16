<?php
include_once("conexion.php");
Class estadoLegalDelLocal{
	//Atributos
	private $ID_ESTADO_LEGAL = null;
	private $ID_EMPRESAS_A_INTERVENIR = null;
	private $ID_DIRECCION_EMPRESA = null;
	private $LEY_ESTADO_LEGAL = null;
	private $ARTICULO_ESTADO_LEGAL = null;
	private $ORDENANZA_ESTADO_LEGAL = null;
	private $DETALLE_ESTADO_LEGAL = null;
	private $ESTA_AL_DIA_ESTADO_LEGAL = null;
	private $FECHA_ESTADO_LEGAL = null;
	private $conexion = null;
	private $nombre_tabla = 'ESTADO_LEGAL';
	private $id_tabla = 'ID_ESTADO_LEGAL';
	
	//Constructor
	function __construct($ID_ESTADO_LEGAL,$ID_EMPRESAS_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$LEY_ESTADO_LEGAL,$ARTICULO_ESTADO_LEGAL,$ORDENANZA_ESTADO_LEGAL,$DETALLE_ESTADO_LEGAL,$ESTA_AL_DIA_ESTADO_LEGAL,$FECHA_ESTADO_LEGAL) {
		$this->ID_ESTADO_LEGAL = $ID_ESTADO_LEGAL;
		$this->ID_EMPRESAS_A_INTERVENIR = $ID_EMPRESAS_A_INTERVENIR;
		$this->ID_DIRECCION_EMPRESA = $ID_DIRECCION_EMPRESA;
		$this->LEY_ESTADO_LEGAL = $LEY_ESTADO_LEGAL;
		$this->ARTICULO_ESTADO_LEGAL = $ARTICULO_ESTADO_LEGAL;
		$this->ORDENANZA_ESTADO_LEGAL = $ORDENANZA_ESTADO_LEGAL;
		$this->DETALLE_ESTADO_LEGAL = $DETALLE_ESTADO_LEGAL;
		$this->ESTA_AL_DIA_ESTADO_LEGAL = $ESTA_AL_DIA_ESTADO_LEGAL;
		$this->FECHA_ESTADO_LEGAL = $FECHA_ESTADO_LEGAL;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_EMPRESAS_A_INTERVENIR`,`ID_DIRECCION_EMPRESA`,LEY_ESTADO_LEGAL,ARTICULO_ESTADO_LEGAL,ORDENANZA_ESTADO_LEGAL,DETALLE_ESTADO_LEGAL,ESTA_AL_DIA_ESTADO_LEGAL,FECHA_ESTADO_LEGAL)
				VALUES
				('".$this->ID_EMPRESAS_A_INTERVENIR."','".$this->ID_DIRECCION_EMPRESA."','".$this->LEY_ESTADO_LEGAL."','".$this->ARTICULO_ESTADO_LEGAL."','".$this->ORDENANZA_ESTADO_LEGAL."','".$this->DETALLE_ESTADO_LEGAL."','".$this->ESTA_AL_DIA_ESTADO_LEGAL."',STR_TO_DATE(REPLACE('".$this->FECHA_ESTADO_LEGAL."','-','.') ,GET_FORMAT(date,'EUR')))";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_EMPRESAS_A_INTERVENIR` = '".$this->ID_EMPRESAS_A_INTERVENIR."',
				`ID_DIRECCION_EMPRESA` = '".$this->ID_DIRECCION_EMPRESA."',
				LEY_ESTADO_LEGAL = '".$this->LEY_ESTADO_LEGAL."',
				ARTICULO_ESTADO_LEGAL = '".$this->ARTICULO_ESTADO_LEGAL."',
				ORDENANZA_ESTADO_LEGAL = '".$this->ORDENANZA_ESTADO_LEGAL."',
				ESTA_AL_DIA_ESTADO_LEGAL = '".$this->ESTA_AL_DIA_ESTADO_LEGAL."',
				DETALLE_ESTADO_LEGAL = '".$this->DETALLE_ESTADO_LEGAL."',
				FECHA_ESTADO_LEGAL = STR_TO_DATE(REPLACE('".$this->FECHA_ESTADO_LEGAL."','-','.') ,GET_FORMAT(date,'EUR'))
				WHERE `".$this->id_tabla."` = '".$this->ID_ESTADO_LEGAL."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_ESTADO_LEGAL."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " ESTADO_LEGAL ";
		$clausulaWhere = " WHERE `ID_DIRECCION_EMPRESA` = ".$this->ID_DIRECCION_EMPRESA;
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