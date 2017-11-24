<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_registro_usuario.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class Registro_usuario {

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

	public function select_documento($documento) { //funcion para buscar el documento del usuario
		$documento = mysqli_real_escape_string($this->conexion, $documento);

		$consulta_datos ="SELECT * FROM persona WHERE cedula = '" . $documento . "'";

		$resul = mysqli_query($this->conexion, $consulta_datos);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado = $row['cedula'];
			}
		}
		return $this->resultado;
	}

	public function select_documento_registrado($documento) { //funcion para buscar el documento del usuario
		$documento = mysqli_real_escape_string($this->conexion, $documento);

		$consulta_datos ="SELECT * FROM persona WHERE cedula = '" . $documento . "' AND nombre IS NOT NULL";

		$resul = mysqli_query($this->conexion, $consulta_datos);
		
		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado = $row['cedula'];
			}
		}
		return $this->resultado;
	}

	public function inser_usuario($documento, $nombre, $apellido, $correo, $sexo, $direccion, $telefono, $pass) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);
		$nombre = utf8_decode(mysqli_real_escape_string($this->conexion, $nombre));
		$apellido = utf8_decode(mysqli_real_escape_string($this->conexion, $apellido));
		$correo = mysqli_real_escape_string($this->conexion, $correo);
		$sexo = mysqli_real_escape_string($this->conexion, $sexo);
		$direccion = utf8_decode(mysqli_real_escape_string($this->conexion, $direccion));
		$telefono = mysqli_real_escape_string($this->conexion, $telefono);
		$pass = mysqli_real_escape_string($this->conexion, $pass);

		$nun_aleatorio = mt_rand(0, 9999999999);
		$token = sha1($nun_aleatorio);

		$update_datos ="UPDATE persona SET nombre = '".$nombre."', apellido = '".$apellido."', correo = '".$correo."', sexo = '".$sexo."', direccion = '".$direccion."', telefono = '".$telefono."', activo = '0', pass = '".$pass."', token = '".$token."' WHERE cedula = '".$documento."'";

		mysqli_query($this->conexion, $update_datos) or die ("Error en el insert Usuario");
	}

	public function update_token($code,$cedula) { //Actualizar token
		$documento = mysqli_real_escape_string($this->conexion, $code);
		$documento = mysqli_real_escape_string($this->conexion, $cedula);

		$actualizar_datos ="UPDATE persona SET token='".$code."' WHERE cedula = '".$cedula ."' ";

		mysqli_query($this->conexion, $actualizar_datos)or die ("Error SQL token");

	}

	public function validar_token($cedula,$token) { 
		$documento = mysqli_real_escape_string($this->conexion, $cedula);
		$documento = mysqli_real_escape_string($this->conexion, $token);

		$consulta_token ="SELECT * FROM persona WHERE cedula = '" .$cedula."' AND token = '".$token."' ";

		$resul = mysqli_query($this->conexion, $consulta_token);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado = $row['cedula'];
			}
		}
		return $this->resultado;
	}

	public function activar_usuario($cedula) { 
		$documento = mysqli_real_escape_string($this->conexion, $cedula);

		$actualizar_datos ="UPDATE persona SET activo='1' WHERE cedula = '".$cedula ."' ";

		mysqli_query($this->conexion, $actualizar_datos)or die ("Error SQL token");

	}
}
?>