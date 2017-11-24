<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_menu_instructor.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class Menu_instructor {

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

	public function select_centro($id_centro) {
		$id_centro = mysqli_real_escape_string($this->conexion, $id_centro);

		$consulta_centro ="SELECT * FROM centro a INNER JOIN persona b ON a.id_centro = b.id_centro WHERE a.activo = '1' AND a.id_centro = '" . $id_centro . "'";

		$resul = mysqli_query($this->conexion, $consulta_centro) or die("Error centro");

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function select_sede($id_centro) {

		$consulta_sede ="SELECT * FROM sede WHERE activo = '1' AND id_centro = " . $id_centro . "";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function insert_persona_ficha($cedula, $ficha) {
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);
		$ficha = mysqli_real_escape_string($this->conexion, $ficha);

		$insert_ficha ="INSERT INTO persona_ficha (cedula, id_ficha) VALUES ('" . $cedula . "', '" . $ficha . "')";
		
		mysqli_query($this->conexion, $insert_ficha);
	}

	public function select_ficha($opcion) {
		$opcion = mysqli_real_escape_string($this->conexion, $opcion);

		$consulta_ficha = " SELECT a.id_persona_ficha, e.nombre_centro, d.nombre_sede, f.nombre_programa, c.numero_ambiente, g.nombre_jornada, b.numero_ficha
							FROM persona_ficha a
							INNER JOIN ficha b ON a.id_ficha = b.id_ficha
							INNER JOIN ambiente c ON b.id_ambiente = c.id_ambiente
							INNER JOIN sede d ON c.id_sede = d.id_sede
							INNER JOIN centro e ON d.id_centro = e.id_centro
							INNER JOIN programa f ON b.id_programa = f.id_programa
							INNER JOIN jornada g ON b.id_jornada = g.id_jornada
							WHERE a.activo = '" . $opcion . "' AND a.cedula = '" . $_SESSION['cedula'] . "'";

		$resul = mysqli_query($this->conexion, $consulta_ficha) or die("Error centro");

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function update_ficha($opcion, $id_ficha) {
		$opcion = mysqli_real_escape_string($this->conexion, $opcion);
		$id_ficha = mysqli_real_escape_string($this->conexion, $id_ficha);

		$update_ficha ="UPDATE persona_ficha SET activo = '" . $opcion . "' WHERE id_persona_ficha = '" . $id_ficha . "'";

		mysqli_query($this->conexion, $update_ficha);
	}

	/********************************************
	Inicio Funciones de los Selects en casacada
	*********************************************/
	public function select_ambiente_cascada($id_sede, $valor) {
		$id_sede = mysqli_real_escape_string($this->conexion, $id_sede);
		$valor = mysqli_real_escape_string($this->conexion, $valor);

	    echo $consulta_sede = "SELECT * FROM ambiente WHERE activo = '" . $valor . "' AND id_sede = '" . $id_sede . "'";

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