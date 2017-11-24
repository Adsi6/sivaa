<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_lista_de_chequeo.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class Consultas_chequeo {

	private $con;
	private $conexion;
	private $resultado;
	private $fecha;

	function __construct() {
		$this->con = new Conexion();
		$this->conexion = $this->con->conn();
		$this->resultado = array();
		$this->fecha = date("Y-m-d H:i:s");

	}

	public function select_regional($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_region ="SELECT * FROM regional WHERE activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_region);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function select_pregunta($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_pregunta ="SELECT * FROM pregunta WHERE activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_pregunta);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function select_ficha() {

		$consulta_pregunta="SELECT b.id_ficha, b.numero_ficha
							FROM persona_ficha a
							INNER JOIN ficha b ON a.id_ficha = b.id_ficha
							WHERE a.activo = '1' AND a.cedula = '" . $_SESSION['cedula'] . "'";

		$resul = mysqli_query($this->conexion, $consulta_pregunta);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function select_datos($id_ficha, $valor) {
		$id_ficha = mysqli_real_escape_string($this->conexion, $id_ficha);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_pregunta="SELECT b.id_ficha, b.numero_ficha, c.id_ambiente, d.id_sede, e.id_centro, f.id_regional
							FROM persona_ficha a
							INNER JOIN ficha b ON a.id_ficha = b.id_ficha
							INNER JOIN ambiente c ON b.id_ambiente = c.id_ambiente
							INNER JOIN sede d ON c.id_sede = d.id_sede
							INNER JOIN centro e ON d.id_centro = e.id_centro
							INNER JOIN regional f ON e.id_regional = f.id_regional
							WHERE a.activo = '1' AND a.id_persona_ficha = '" . $id_ficha . "'";

		$resul = mysqli_query($this->conexion, $consulta_pregunta);

		while ($row = mysqli_fetch_array($resul)) {
			$id_regional = $row['id_regional'];
			$id_centro = $row['id_centro'];
			$id_sede = $row['id_sede'];
			$id_ambiente = $row['id_ambiente'];
			$id_ficha = $row['id_ficha'];
		}

		$_SESSION['id_regional_ficha'] = $id_regional;
		$_SESSION['id_centro_ficha'] = $id_centro;
		$_SESSION['id_sede_ficha'] = $id_sede ;
		$_SESSION['id_ambiente_ficha'] = $id_ambiente;
		$_SESSION['id_ficha_ficha'] = $id_ficha;
	}

	public function insert_respuesta($respuesta, $observacion, $id_pregunta, $id_regional, $id_centro, $id_sede, $id_ambiente, $id_ficha, $cedula) {
		$respuesta = mysqli_real_escape_string($this->conexion, $respuesta);
		$observacion = utf8_decode(mysqli_real_escape_string($this->conexion, $observacion));
		$id_pregunta = mysqli_real_escape_string($this->conexion, $id_pregunta);
		$id_regional = mysqli_real_escape_string($this->conexion, $id_regional);
		$id_centro = mysqli_real_escape_string($this->conexion, $id_centro);
		$id_sede = mysqli_real_escape_string($this->conexion, $id_sede);
		$id_ambiente = mysqli_real_escape_string($this->conexion, $id_ambiente);
		$id_ficha = mysqli_real_escape_string($this->conexion, $id_ficha);
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);

		$insert_pregunta ="INSERT INTO respuesta (respuesta, fecha, observacion, cedula, id_pregunta, id_regional, id_centro, id_sede, id_ambiente, id_ficha) 
		VALUES ('".$respuesta."', '".$this->fecha."', '".$observacion."', '".$cedula."', '".$id_pregunta."', '".$id_regional."', '".$id_centro."', '".$id_sede."', '".$id_ambiente."', '".$id_ficha."')";
		
		mysqli_query($this->conexion, $insert_pregunta);
	}

	/********************************************
	Inicio Funciones de los Selects en casacada
	*********************************************/
	public function select_centro_cascada($id_region, $valor) {
		$id_region = mysqli_real_escape_string($this->conexion, $id_region);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

	    $consulta_centro = "SELECT * FROM centro WHERE activo = '" . $valor . "' AND id_regional = '" . $id_region . "'";

	    $resul = mysqli_query($this->conexion, $consulta_centro);
	    $html= "<option value=''>Seleccionar Centro</option>";
	    while ($row = mysqli_fetch_array($resul)) {
	        $html.= "<option value='" . $row['id_centro'] . "'>" . utf8_encode($row['nombre_centro']) . "</option>";
	    }
	    echo $html;
	}

	public function select_sede_cascada($id_centro, $valor) {
		$id_centro = mysqli_real_escape_string($this->conexion, $id_centro);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

	    $consulta_sede = "SELECT * FROM sede WHERE activo = '" . $valor . "' AND id_centro = '" . $id_centro . "'";

	    $resul = mysqli_query($this->conexion, $consulta_sede);
	    $html= "<option value=''>Seleccione Sede</option>";
	    while ($row = mysqli_fetch_array($resul)) {
	        $html.= "<option value='" . $row['id_sede'] . "'>" . utf8_encode($row['nombre_sede']) . "</option>";
	    }
    	echo $html;
	}

	public function select_ambiente_cascada($id_sede, $valor) {
		$id_sede = mysqli_real_escape_string($this->conexion, $id_sede);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

	    $consulta_sede = "SELECT * FROM ambiente WHERE activo = '" . $valor . "' AND id_sede = '" . $id_sede . "'";

	    $resul = mysqli_query($this->conexion, $consulta_sede);
	    $html= "<option value=''>Seleccione Ambiente</option>";
	    while ($row = mysqli_fetch_array($resul)) {
	        $html.= "<option value='" . $row['id_ambiente'] . "'>" . utf8_encode($row['numero_ambiente']) . "</option>";
	    }
    	echo $html;
	}

	public function select_ficha_cascada($id_ambiente, $valor) {
		$id_ambiente = mysqli_real_escape_string($this->conexion, $id_ambiente);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

	    $consulta_sede = "SELECT * FROM ficha WHERE activo = '" . $valor . "' AND id_ambiente = '" . $id_ambiente . "'";

	    $resul = mysqli_query($this->conexion, $consulta_sede);
	    $html= "<option value=''>Seleccione Ficha</option>";
	    while ($row = mysqli_fetch_array($resul)) {
	        $html.= "<option value='" . $row['id_ficha'] . "'>" . utf8_encode($row['numero_ficha']) . "</option>";
	    }
    	echo $html;
	}
	/********************************************
	Fin Funciones de los Selects en casacada
	*********************************************/
}
?>