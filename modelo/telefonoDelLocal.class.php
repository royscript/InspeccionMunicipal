<?php
include_once("conexion.php");
Class telefonoDelLocal{
	//Atributos
	private $ID_TELEFONO_EMPRESA_A_INTERVENIR = null;
	private $NUMERO_TELEFONO_EMPRESA_A_INTERVENIR = null;
	private $ID_DIRECCION_EMPRESA = null;
	private $NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR = null;
	private $conexion = null;
	private $nombre_tabla = 'TELEFONO_EMPRESA_A_INTERVENIR';
	private $id_tabla = 'ID_TELEFONO_EMPRESA_A_INTERVENIR';
	
	//Constructor
	function __construct($ID_TELEFONO_EMPRESA_A_INTERVENIR,$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR) {
		$this->ID_TELEFONO_EMPRESA_A_INTERVENIR = $ID_TELEFONO_EMPRESA_A_INTERVENIR;
		$this->NUMERO_TELEFONO_EMPRESA_A_INTERVENIR = $NUMERO_TELEFONO_EMPRESA_A_INTERVENIR;
		$this->ID_DIRECCION_EMPRESA = $ID_DIRECCION_EMPRESA;
		$this->NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR = $NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`NUMERO_TELEFONO_EMPRESA_A_INTERVENIR`,`ID_DIRECCION_EMPRESA`,NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR,FECHA_REGISTRO_TELEFONO_EMPRESA_A_INTERVENIR)
				VALUES
				('".$this->NUMERO_TELEFONO_EMPRESA_A_INTERVENIR."','".$this->ID_DIRECCION_EMPRESA."','".$this->NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR."',NOW())";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`NUMERO_TELEFONO_EMPRESA_A_INTERVENIR` = '".$this->NUMERO_TELEFONO_EMPRESA_A_INTERVENIR."',
				`ID_DIRECCION_EMPRESA` = '".$this->ID_DIRECCION_EMPRESA."',
				NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR = '".$this->NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR."',
				FECHA_REGISTRO_TELEFONO_EMPRESA_A_INTERVENIR = NOW()
				WHERE `".$this->id_tabla."` = '".$this->ID_TELEFONO_EMPRESA_A_INTERVENIR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_TELEFONO_EMPRESA_A_INTERVENIR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " TELEFONO_EMPRESA_A_INTERVENIR ";
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