<?php

class Conexion {

	private $host;
	private $user;
	private $pass;
	private $db_name;
	
	function __construct() {
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->db_name = "sivaa";
	}

	function conn() {

		$conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name) or die("Error en la conexion");

		return $conexion;
	}
}

?>