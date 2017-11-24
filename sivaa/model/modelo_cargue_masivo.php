<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_cargue_masivo.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class consultas_masivo {

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

	
	
/******************* Select persona para realizar cargue masivos*******/

	public function select_persona_cedula($cedula) {
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);
		$consulta_persona ="SELECT * FROM persona WHERE cedula = '" . $cedula . "'";

		$resul = mysqli_query($this->conexion, $consulta_persona);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			$this->resultado = 1;
		}
		return $this->resultado;
	}

	public function select_centro_valor($centro) {
		$centro = mysqli_real_escape_string($this->conexion, $centro);
		$consulta_persona ="SELECT * FROM centro WHERE cod_centro = '" . $centro . "'";

		$resul = mysqli_query($this->conexion, $consulta_persona);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
		}
		return $this->resultado;
	}

	public function select_rol_valor($rol) {
		$rol = mysqli_real_escape_string($this->conexion, $rol);
		$consulta_persona ="SELECT * FROM rol WHERE nombre_rol = '" . $rol . "'";		

		$resul = mysqli_query($this->conexion, $consulta_persona);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
		}
		return $this->resultado;
	}

	public function insert_usuario_masivo($cedula, $centro_id, $rol_id) {
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);
		$centro_id = mysqli_real_escape_string($this->conexion, $centro_id);
		$rol_id = mysqli_real_escape_string($this->conexion, $rol_id);

		$insertar_masivos ="INSERT INTO persona(cedula,  fecha, activo, id_centro, id_rol)
							VALUES ('".$cedula."', '".$this->fecha."', '0', '".$centro_id."', '".$rol_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}
	public function insert_centro($cod_centro, $nom_centro, $cod_regional) {
		$cod_centro = mysqli_real_escape_string($this->conexion, $cod_centro);
		$nom_centro = mysqli_real_escape_string($this->conexion, $nom_centro);
		$cod_regional = mysqli_real_escape_string($this->conexion, $cod_regional);

		$insert_centro ="INSERT INTO centro (cod_centro, nombre_centro, id_regional) VALUES ('" . $cod_centro . "', '" . $nom_centro  . "', '" . $cod_regional . "')";
		mysqli_query($this->conexion, $insert_centro);
	}

	/******************* Select  para realizar cargue masivos regional *******/

	public function select_regional_cod($cod_regional) {
		$cod_regional = mysqli_real_escape_string($this->conexion, $cod_regional);
		$consulta_regional ="SELECT * FROM regional WHERE cod_regional = '" . $cod_regional . "'";

		$resul = mysqli_query($this->conexion, $consulta_regional);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}

	public function insert_regional($cod_regional, $nom_regional) {
		$cod_regional = mysqli_real_escape_string($this->conexion, $cod_regional);
		$nom_regional = mysqli_real_escape_string($this->conexion, $nom_regional);

		$insert_regional ="INSERT INTO regional (cod_regional, nombre_regional) VALUES ('" . $cod_regional . "', '" . $nom_regional  . "')";
		mysqli_query($this->conexion, $insert_regional);
	}
/******************* Select  para realizar cargue masivos centro *******/

	public function select_centro_cod($cod_centro) {
		$cod_centro = mysqli_real_escape_string($this->conexion, $cod_centro);
		$consulta_regional ="SELECT * FROM centro WHERE cod_centro = '" . $cod_centro . "'";

		$resul = mysqli_query($this->conexion, $consulta_regional);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
public function insert_centro_masivo($cedula, $centro_id, $rol_id) {
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);
		$centro_id = mysqli_real_escape_string($this->conexion, $centro_id);
		$rol_id = mysqli_real_escape_string($this->conexion, $rol_id);

		$insertar_masivos ="INSERT INTO persona(cedula,  fecha, activo, id_centro, id_rol)
							VALUES ('".$cedula."', '".$this->fecha."', '0', '".$centro_id."', '".$rol_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}

	/******************* Select  para realizar cargue masivos sede *******/
	public function select_sede_valor($nom_sede,$centro_id) {
		$nom_sede = mysqli_real_escape_string($this->conexion, $nom_sede);
		$centro_id = mysqli_real_escape_string($this->conexion, $centro_id);
		$consulta_sede ="SELECT * FROM sede WHERE nombre_sede = '" . $nom_sede . "' AND id_centro = '".$centro_id."'";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function insert_sede_masivo($centro_id, $nom_sede) {
		$centro_id = mysqli_real_escape_string($this->conexion, $centro_id);
		$nom_sede = mysqli_real_escape_string($this->conexion, $nom_sede);

		$insertar_masivos ="INSERT INTO sede(nombre_sede, activo, id_centro)
							VALUES ('".$nom_sede."','1', '".$centro_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}

	/******************* Select  para realizar cargue masivos Ambiente *******/
	public function select_sede_ver($nom_sede) {
		$nom_sede = mysqli_real_escape_string($this->conexion, $nom_sede);
		$consulta_sede ="SELECT * FROM sede WHERE nombre_sede = '" . $nom_sede . "' ";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function select_ambiente_valor($num_ambiente,$sede_id) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$sede_id = mysqli_real_escape_string($this->conexion, $sede_id);
		$consulta_sede ="SELECT * FROM ambiente WHERE numero_ambiente = '" . $num_ambiente . "' AND id_sede = '".$sede_id."'";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function insert_ambiente_masivo($num_ambiente,$sede_id) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$sede_id = mysqli_real_escape_string($this->conexion, $sede_id);

		$insertar_masivos ="INSERT INTO ambiente (numero_ambiente, activo, id_sede)
							VALUES ('".$num_ambiente."','1', '".$sede_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}

	/******************* Select  para realizar cargue masivos programa *******/

	public function select_programa_ver($nombre_programa) {
		$nombre_programa = mysqli_real_escape_string($this->conexion, $nombre_programa);
		$consulta_programa ="SELECT * FROM programa WHERE nombre_programa = '" . $nombre_programa . "'";

		$resul = mysqli_query($this->conexion, $consulta_programa);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}

	public function insert_nombre_programa($nombre_programa) {
		$nombre_programa = mysqli_real_escape_string($this->conexion, $nombre_programa);
		

		$insert_nombre_programa ="INSERT INTO programa (nombre_programa) VALUES ('" . $nombre_programa . "')";
		mysqli_query($this->conexion, $insert_regional);
	}

/******************* Select  para realizar cargue masivos fichas *******/
	public function select_ficha_ver($ficha) {
		$ficha = mysqli_real_escape_string($this->conexion, $ficha);
		$consulta_ficha ="SELECT * FROM ficha WHERE numero_ficha = '" . $ficha . "' ";

		$resul = mysqli_query($this->conexion, $consulta_ficha);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function select_ficha_valor($num_ambiente,$sede_id) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$sede_id = mysqli_real_escape_string($this->conexion, $sede_id);
		$consulta_ficha ="SELECT * FROM ambiente WHERE numero_ambiente = '" . $num_ambiente . "' AND id_sede = '".$sede_id."'";

		$resul = mysqli_query($this->conexion, $consulta_ficha);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			$this->resultado = 1;
		}
		return $this->resultado;
	}

public function select_jornada_ver($nom_jornada) {
		$nom_jornada = mysqli_real_escape_string($this->conexion, $nom_jornada);
		$consulta_ficha ="SELECT * FROM jornada WHERE nombre_jornada = '" . $nom_jornada . "' ";
		
		$resul = mysqli_query($this->conexion, $consulta_ficha);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function select_programa_ver($siglas) {
		$siglas = mysqli_real_escape_string($this->conexion, $siglas);
		$consulta_programa ="SELECT * FROM programa WHERE siglas = '" . $siglas . "' ";
		////aqui voy/////
		$resul = mysqli_query($this->conexion, $consulta_programa);

		if ($resul->num_rows == 0) {
			$this->resultado = 0;
		} else {
			while ($row = mysqli_fetch_array($resul)) {
				$this->resultado[] = $row;
			}
			//$this->resultado = 1;
		}
		return $this->resultado;
	}
	public function insert_ficha_masivo($ficha,$ambiente_id,$jornada_id,$programa_id) {
		$ficha = mysqli_real_escape_string($this->conexion, $ficha);
		$ambiente_id = mysqli_real_escape_string($this->conexion, $ambiente_id);
		$jornada_id = mysqli_real_escape_string($this->conexion, $jornada_id);
		$programa_id = mysqli_real_escape_string($this->conexion, $programa_id);

		$insertar_masivos ="INSERT INTO ficha (numero_ficha,activo,id_ambiente,id_jornada,id_programa)
							VALUES ('".$ficha."','1','".$ambiente_id."','".$jornada_id."','".$programa_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}
/*******************************************/
}
?>