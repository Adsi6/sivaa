<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_estadisticas.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class Estadisticas {

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

	public function select_centro($centro,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE e.id_centro = '".$centro."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}
	public function select_sede($sede_1,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE f.id_sede = '".$sede_1."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}
	public function select_programa($programa,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE i.id_programa = '".$programa."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}
	public function select_ambiente($ambiente_1,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE g.id_ambiente = '".$ambiente_1."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}
	public function select_jornada($jornada,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE j.id_jornada = '".$jornada."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}
	public function select_ficha($ficha,$fecha_inicio,$fecha_final) {

		$consulta_sin_filtro = "SELECT *
								FROM respuesta a
								INNER JOIN persona b ON a.cedula = b.cedula
								INNER JOIN pregunta c ON a.id_pregunta = c.id_pregunta
								INNER JOIN regional d ON a.id_regional = d.id_regional
								INNER JOIN centro e ON a.id_centro = e.id_centro
								INNER JOIN sede f ON a.id_sede = f.id_sede
								INNER JOIN ambiente g ON a.id_ambiente = g.id_ambiente
								INNER JOIN ficha h ON a.id_ficha = h.id_ficha
								INNER JOIN programa i ON h.id_programa = i.id_programa
								INNER JOIN jornada j ON h.id_jornada = j.id_jornada
								WHERE h.id_ficha = '".$ficha."' AND a.fecha BETWEEN '".$fecha_inicio." 00:00:01' AND '".$fecha_final." 23:59:59'";

		$resul = mysqli_query($this->conexion, $consulta_sin_filtro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}


}
?>