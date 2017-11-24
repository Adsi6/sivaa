<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_actualizar_datos.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class Actualiza_datos {

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

	public function select_regional($documento) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);

		$consulta_datos ="SELECT * FROM persona WHERE cedula = '" . $documento . "'";

		$resul = mysqli_query($this->conexion, $consulta_datos);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_datos($documento, $nombre, $apellido, $correo, $sexo, $direccion, $telefono) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);
		$nombre = utf8_decode(mysqli_real_escape_string($this->conexion, $nombre));
		$apellido = utf8_decode(mysqli_real_escape_string($this->conexion, $apellido));
		$correo = mysqli_real_escape_string($this->conexion, $correo);
		$sexo = mysqli_real_escape_string($this->conexion, $sexo);
		$direccion = utf8_decode(mysqli_real_escape_string($this->conexion, $direccion));
		$telefono = mysqli_real_escape_string($this->conexion, $telefono);

		$update_datos ="UPDATE persona SET nombre = '".$nombre."', apellido = '".$apellido."', correo = '".$correo."', sexo = '".$sexo."', direccion = '".$direccion."', telefono = '".$telefono."' WHERE cedula = '".$documento."'";

		mysqli_query($this->conexion, $update_datos);
	}

	public function act_password($documento, $pass) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);
		$pass = utf8_decode(mysqli_real_escape_string($this->conexion, $pass));

		$update_pass ="UPDATE persona SET pass = '" . $pass . "' WHERE cedula = '" . $documento . "'";

		mysqli_query($this->conexion, $update_pass);
	}

	public function valida_password($documento, $pass_validar) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);
		$pass_validar = mysqli_real_escape_string($this->conexion, $pass_validar);

		$consulta_pass ="SELECT * FROM persona WHERE cedula = '" . $documento . "' AND pass = '" . $pass_validar . "'";

		$resul = mysqli_query($this->conexion, $consulta_pass);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
		}

		return $this->resultado;
	}
}
?>