<?php
set_time_limit(0);
include_once("conexion.php");
Class eventos{
	//Atributos
	private $ID_EVENTO_VIA_PUBLICA = null;
	private $ID_SECTOR = null;
	private $ID_ACTIVIDAD = null;
	private $ID_GRUPO = null;
	private $FECHA = null;
	private $DIRECCION = null;
	private $DETALLE = null;
	private $conexion = null;
	private $nombre_tabla = 'evento_via_publica';
	private $id_tabla = 'ID_EVENTO_VIA_PUBLICA';
	
	//Constructor
	function __construct($ID_EVENTO_VIA_PUBLICA,$ID_SECTOR,$ID_ACTIVIDAD,$ID_GRUPO,$FECHA,$DIRECCION,$DETALLE) {
		$this->ID_EVENTO_VIA_PUBLICA = $ID_EVENTO_VIA_PUBLICA;
		$this->ID_SECTOR = $ID_SECTOR;
		$this->ID_ACTIVIDAD = $ID_ACTIVIDAD;
		$this->ID_GRUPO = $ID_GRUPO;
		$this->FECHA = $FECHA;
		$this->DIRECCION = $DIRECCION;
		$this->DETALLE = $DETALLE;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_SECTOR`,`ID_ACTIVIDAD`,`ID_GRUPO`,
				`FECHA`,
				`DIRECCION`,`DETALLE`)
				VALUES
				('".$this->ID_SECTOR."','".$this->ID_ACTIVIDAD."',
				'".$this->ID_GRUPO."',STR_TO_DATE(REPLACE('".$this->FECHA."','-','.') ,GET_FORMAT(date,'EUR')),
				'".$this->DIRECCION."','".$this->DETALLE."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_SECTOR` = '".$this->ID_SECTOR."',
				`ID_ACTIVIDAD` = '".$this->ID_ACTIVIDAD."',
				`ID_GRUPO` = '".$this->ID_GRUPO."',
				`DIRECCION` = '".$this->DIRECCION."',
				`FECHA` = STR_TO_DATE(REPLACE('".$this->FECHA."','-','.') ,GET_FORMAT(date,'EUR')),
				`DETALLE` = '".$this->DETALLE."'
				WHERE `".$this->id_tabla."` = '".$this->ID_EVENTO_VIA_PUBLICA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_EVENTO_VIA_PUBLICA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($Fecha_inicio,$Fecha_final,$buscar_grupo,$jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		if($Fecha_inicio!='' && $Fecha_final!=''){
			$Fecha_inicio = "  `FECHA` BETWEEN '".$Fecha_inicio."' AND '".$Fecha_final."' ";
		}else{
			$Fecha_inicio = " 1 = 1 ";
		}
		if($buscar_grupo!=''){
			$buscar_grupo = "  AND `ID_GRUPO` = ".$buscar_grupo;
		}else{
			$buscar_grupo = " ";
		}
		$tablas = " evento_via_publica ";
		$clausulaWhere = " WHERE ".$Fecha_inicio." ".$buscar_grupo;
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
			$jTableResult = array();
			$jTableResult['Result'] = "ERROR";
			$jTableResult['Message'] = ini_set('error_reporting', E_ALL);
			$this->conexion->cerrarConexion();
		}
		return json_encode($jTableResult);
	}
	
	private function geolocalizar($direccion){
		// Buscamos la latitud, longitud en base a la direccion calle y número, ciudad, país
 	    //$localizar=$_POST['direccion'].", ".$_POST['ciudad'].", ".$_POST['provincia'].", ".$_POST['pais'];
 
		// urlencode codifica datos de texto modificando simbolos como acentos
		$localizar = $direccion.", Coquimbo, Chile";
		$direccion = urlencode($localizar);
		// envio la consulta a Google map api
		$url = "http://maps.google.com/maps/api/geocode/json?address={".$direccion."}";
		// recibo la respuesta en formato Json
		$datosjson = file_get_contents($url);
		// decodificamos los datos Json
		$datosmapa = json_decode($datosjson, true);
		// Esperar 1 segundo para no saturar a google maps de consultas
		usleep(1000000);
		// si recibimos estado o status igual a OK, es porque se encontro la direccion
		if($datosmapa['status']='OK'){
			// asignamos los datos
			$latitud = $datosmapa['results'][0]['geometry']['location']['lat'];
			$longitud = $datosmapa['results'][0]['geometry']['location']['lng'];
			$localizacion = $datosmapa['results'][0]['formatted_address'];
				// Guardamos los datos en una matriz
				$datosmapa = array();      
				array_push(
					$datosmapa,
						$latitud,
						$longitud,
						$localizacion
					);
				return $datosmapa;
	 
			}
	}
}
?>