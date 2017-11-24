<?php

//session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_olvido_password.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class olvido_password {

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

	public function select_correo($correo) { //funcion para buscar el correo del usuario
		$documento = mysqli_real_escape_string($this->conexion, $correo);

		$consulta_datos ="SELECT * FROM persona WHERE correo = '" . $correo . "' LIMIT 1 ";

		$resul = mysqli_query($this->conexion, $consulta_datos);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
		}
		return $this->resultado;
	}

	public function update_token($code,$cedula) { //Actualizar token
		$documento = mysqli_real_escape_string($this->conexion, $code);
		$documento = mysqli_real_escape_string($this->conexion, $cedula);

		$actualizar_datos ="UPDATE persona SET token='".$code."' WHERE cedula = '".$cedula ."' ";

		mysqli_query($this->conexion, $actualizar_datos)or die ("Error SQL token");

	}

	public function recuperacion_correo($cedula,$token) { 
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

	public function actualizar_pass($cedula,$pass,$coden) { //Actualizar contraseña
		$documento = mysqli_real_escape_string($this->conexion, $cedula);
		$documento = mysqli_real_escape_string($this->conexion, $pass);
		$documento = mysqli_real_escape_string($this->conexion, $coden);

		$actualizar_datos ="UPDATE persona SET pass = '".$pass ."' , token = '".$coden ."' WHERE cedula= '" .$cedula."' ";

		mysqli_query($this->conexion, $actualizar_datos)or die ("Error AQL contraseña");

	}

}
?>