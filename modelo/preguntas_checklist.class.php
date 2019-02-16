<?php
include_once("conexion.php");
Class preguntas_checklist{
	//Atributos
	private $ID_PREGUNTAS_CHECKLIST = null;
	private $ID_OPERATIVO = null;
	private $CONTENIDO_PREGUNTAS_CHECKLIST = null;
	private $REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST = null;
	private $HORARIO_DE_ATENCION = null;
	private $conexion = null;
	private $nombre_tabla = 'preguntas_checklist';
	private $id_tabla = 'ID_PREGUNTAS_CHECKLIST';
	
	//Constructor
	function __construct($ID_PREGUNTAS_CHECKLIST,$ID_OPERATIVO,$CONTENIDO_PREGUNTAS_CHECKLIST,$REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST) {
		$this->ID_PREGUNTAS_CHECKLIST = $ID_PREGUNTAS_CHECKLIST;
		$this->ID_OPERATIVO = $ID_OPERATIVO;
		$this->CONTENIDO_PREGUNTAS_CHECKLIST = $CONTENIDO_PREGUNTAS_CHECKLIST;
		$this->REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST = $REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_OPERATIVO`,`CONTENIDO_PREGUNTAS_CHECKLIST`,`REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST`)
				VALUES
				('".$this->ID_OPERATIVO."','".$this->CONTENIDO_PREGUNTAS_CHECKLIST."','".$this->REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_OPERATIVO` = '".$this->ID_OPERATIVO."',
				`CONTENIDO_PREGUNTAS_CHECKLIST` = '".$this->CONTENIDO_PREGUNTAS_CHECKLIST."',
				`REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST` = '".$this->REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST."'
				WHERE `".$this->id_tabla."` = '".$this->ID_PREGUNTAS_CHECKLIST."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_PREGUNTAS_CHECKLIST."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " preguntas_checklist ";
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