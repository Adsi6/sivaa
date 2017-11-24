<?php
error_reporting(0);
session_start();

require_once("../model/conexion.php");

class Consultas {
	
	private $con;
	private $conexion;

	function __construct() {
		$this->con = new Conexion();
		$this->conexion = $this->con->conn();
	}

	function validar_usuario($user, $pass) {

		$user = mysqli_real_escape_string($this->conexion, $user);
		$pass = mysqli_real_escape_string($this->conexion, $pass);

		$query = "SELECT a.cedula, a.id_rol, b.nombre_rol, a.nombre, a.apellido, a.id_centro
				FROM persona a
				INNER JOIN rol b ON a.id_rol = b.id_rol
				WHERE a.cedula = '".$user."' AND a.pass = '".$pass."' AND a.activo = '1'";
		
		$resul = mysqli_query($this->conexion, $query);

		if ($resul->num_rows == 0) {
			echo "<script>
		               alert('Usuario o contraseña incorectos');
		               window.history.go(-1);
		          </script>";
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$id_rol = $row['id_rol'];
				$id_centro = $row['id_centro'];
				$nombre_rol = $row['nombre_rol'];
				$nombre = $row['nombre'];
				$apellido = $row['apellido'];
				$cedula = $row['cedula'];

				$_SESSION['id_rol'] = $id_rol;
				$_SESSION['id_centro'] = $id_centro;
				$_SESSION['nombre_rol'] = $nombre_rol;
				$_SESSION['nombre_usuario'] = $nombre;
				$_SESSION['apellido_usuario'] = $apellido;
				$_SESSION['cedula'] = $cedula;
			}		
		}
	}
}

?>