<?php

session_start();
//echo "<br> consultas " . $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "/sivaa/controller/controlador_administrador.php") {
	require_once("../model/conexion.php");
} else {
	require_once("../../../model/conexion.php");	
}

class consultas_admin {

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

	/********************************************
	Inicio Modulo Control Usuarios
	*********************************************/
	public function usuarios($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_usuario ="SELECT a.cedula, a.nombre, a.correo, a.apellido, a.sexo, a.direccion, a.telefono, a.fecha, b.id_rol, b.nombre_rol, a.activo, c.id_centro, c.nombre_centro, d.id_regional, d.nombre_regional
							FROM persona a
							INNER JOIN rol b ON a.id_rol = b.id_rol
							INNER JOIN centro c ON a.id_centro = c.id_centro
							INNER JOIN regional d ON c.id_regional = d.id_regional
							WHERE a.activo = '" . $valor . "' AND nombre IS NOT NULL";

		$resul = mysqli_query($this->conexion, $consulta_usuario);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function usuarios_pendientes($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_usuario ="SELECT a.cedula, b.id_rol, b.nombre_rol, c.id_centro, c.nombre_centro, d.id_regional, d.nombre_regional, a.fecha
							FROM persona a
							INNER JOIN rol b ON a.id_rol = b.id_rol
							INNER JOIN centro c ON a.id_centro = c.id_centro
							INNER JOIN regional d ON c.id_regional = d.id_regional
							WHERE a.activo = '" . $valor . "' AND nombre IS NULL";

		$resul = mysqli_query($this->conexion, $consulta_usuario);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function roles() {
		$consulta_rol ="SELECT id_rol, nombre_rol FROM rol WHERE activo = '1'";

		$resul = mysqli_query($this->conexion, $consulta_rol);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_roles($cedula, $centro, $perfil) {
		$cedula = mysqli_real_escape_string($this->conexion, $cedula);
		$centro = mysqli_real_escape_string($this->conexion, $centro);
		$perfil = mysqli_real_escape_string($this->conexion, $perfil);

		$update_rol ="UPDATE persona SET id_centro = '" . $centro . "', id_rol = '" . $perfil . "' WHERE cedula = '" . $cedula . "'";

		mysqli_query($this->conexion, $update_rol);
	}

	//Activar o desactivar un usuario
	public function opcion_usuario($documento_opcion, $opcion) {
		$documento_opcion = mysqli_real_escape_string($this->conexion, $documento_opcion);
		$opcion = mysqli_real_escape_string($this->conexion, $opcion);

		$update_usuario ="UPDATE persona SET activo = '" . $opcion . "' WHERE cedula = '" . $documento_opcion . "'";

		mysqli_query($this->conexion, $update_usuario);
	}

	public function insert_usuario($documento, $centro, $perfil) {
		$documento = mysqli_real_escape_string($this->conexion, $documento);
		$centro = mysqli_real_escape_string($this->conexion, $centro);
		$perfil = mysqli_real_escape_string($this->conexion, $perfil);

		$insert_usuario ="INSERT INTO persona (cedula, fecha, id_centro, id_rol) VALUES ('" . $documento . "', '" . $this->fecha  . "', '" . $centro . "', '" . $perfil . "')";
		mysqli_query($this->conexion, $insert_usuario);
	}
	/********************************************
	Fin Modulo Control Usuarios
	*********************************************/

	/********************************************
	Inicio Modulo Control Encuesta
	*********************************************/
	public function insert_pregunta($pregunta) {
		$pregunta = mysqli_real_escape_string($this->conexion, $pregunta);

		$fecha = date("Y-m-d H:i:s");
		$insert_pregunta ="INSERT INTO pregunta (pregunta, fecha_creacion) VALUES ('" . $pregunta . "', '" . $fecha  . "')";
		mysqli_query($this->conexion, $insert_pregunta);
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

	public function act_pregunta($pregunta, $id_pregunta) {
		$pregunta = mysqli_real_escape_string($this->conexion, $pregunta);
		$id_pregunta = mysqli_real_escape_string($this->conexion, $id_pregunta);

		$update_pregunta ="UPDATE pregunta SET pregunta = '" . $pregunta . "' WHERE id_pregunta = '" . $id_pregunta . "'";

		mysqli_query($this->conexion, $update_pregunta);
	}

	public function elimina_pre($id_pregunta, $opcion_pre) {
		$id_pregunta = mysqli_real_escape_string($this->conexion, $id_pregunta);
		$opcion_pre = mysqli_real_escape_string($this->conexion, $opcion_pre);

		$update_pregunta ="UPDATE pregunta SET activo = '" . $opcion_pre . "' WHERE id_pregunta = '" . $id_pregunta . "'";

		mysqli_query($this->conexion, $update_pregunta);
	}
	/********************************************
	Fin Modulo Control Encuesta
	*********************************************/

	/********************************************
	Inicio Modulo Control Regionales
	*********************************************/
	public function insert_regional($cod_regional, $nom_regional) {
		$cod_regional = mysqli_real_escape_string($this->conexion, $cod_regional);
		$nom_regional = mysqli_real_escape_string($this->conexion, $nom_regional);

		$insert_regional ="INSERT INTO regional (cod_regional, nombre_regional) VALUES ('" . $cod_regional . "', '" . $nom_regional  . "')";
		mysqli_query($this->conexion, $insert_regional);
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

	public function act_region($id_region, $nombre_region) {
		$id_region = mysqli_real_escape_string($this->conexion, $id_region);
		$nombre_region = mysqli_real_escape_string($this->conexion, $nombre_region);

		$update_region ="UPDATE regional SET nombre_regional = '" . $nombre_region . "' WHERE id_regional = '" . $id_region . "'";

		mysqli_query($this->conexion, $update_region);
	}
	/********************************************
	Inicio Modulo Control Centros
	*********************************************/
	public function insert_centro($cod_centro, $nom_centro, $cod_regional) {
		$cod_centro = mysqli_real_escape_string($this->conexion, $cod_centro);
		$nom_centro = mysqli_real_escape_string($this->conexion, $nom_centro);
		$cod_regional = mysqli_real_escape_string($this->conexion, $cod_regional);

		$insert_centro ="INSERT INTO centro (cod_centro, nombre_centro, id_regional) VALUES ('" . $cod_centro . "', '" . $nom_centro  . "', '" . $cod_regional . "')";
		mysqli_query($this->conexion, $insert_centro);
	}

	public function select_centro($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_centro ="SELECT * FROM centro a INNER JOIN regional b ON a.id_regional = b.id_regional WHERE a.activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_centro);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_centro($nom_centro, $id_centro) {
		$nom_centro = mysqli_real_escape_string($this->conexion, $nom_centro);
		$id_centro = mysqli_real_escape_string($this->conexion, $id_centro);

		$update_centro ="UPDATE centro SET nombre_centro = '" . $nom_centro . "' WHERE id_centro = '" . $id_centro . "'";

		mysqli_query($this->conexion, $update_centro);
	}
	/********************************************
	Fin Modulo Control Centros
	*********************************************/

	/********************************************
	Inicio Modulo Control Sedes
	*********************************************/
	public function insert_sede($nom_sede, $cod_centro) {
		$nom_sede = mysqli_real_escape_string($this->conexion, $nom_sede);
		$cod_centro = mysqli_real_escape_string($this->conexion, $cod_centro);

		$insert_sede ="INSERT INTO sede (nombre_sede, id_centro) VALUES ('" . $nom_sede . "', '" . $cod_centro  . "')";
		mysqli_query($this->conexion, $insert_sede);
	}

	public function select_sede($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_sede ="SELECT * FROM sede a INNER JOIN centro b ON a.id_centro = b.id_centro INNER JOIN regional c ON b.id_regional = c.id_regional WHERE a.activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_sede($nom_sede, $id_sede) {
		$nom_sede = mysqli_real_escape_string($this->conexion, $nom_sede);
		$id_sede = mysqli_real_escape_string($this->conexion, $id_sede);

		$update_centro ="UPDATE sede SET nombre_sede = '" . $nom_sede . "' WHERE id_sede = '" . $id_sede . "'";

		mysqli_query($this->conexion, $update_centro);
	}
	/********************************************
	Fin Modulo Control Sedes
	*********************************************/

	/********************************************
	Inicio Modulo Control Ambiente
	*********************************************/
	public function insert_ambiente($num_ambiente, $cod_sede) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$cod_sede = mysqli_real_escape_string($this->conexion, $cod_sede);

		$insert_ambiente ="INSERT INTO ambiente (numero_ambiente, id_sede) VALUES ('" . $num_ambiente . "', '" . $cod_sede  . "')";
		mysqli_query($this->conexion, $insert_ambiente);
	}

	public function select_ambiente($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_ambiente ="SELECT * FROM ambiente a INNER JOIN sede b ON a.id_sede = b.id_sede INNER JOIN centro c ON b.id_centro = c.id_centro WHERE a.activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_ambiente);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_ambiente($id_ambiente, $num_ambiente) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$id_ambiente = mysqli_real_escape_string($this->conexion, $id_ambiente);

		$update_ambiente ="UPDATE ambiente SET numero_ambiente = '" . $num_ambiente . "' WHERE id_ambiente = '" . $id_ambiente . "'";

		mysqli_query($this->conexion, $update_ambiente);
	}
	/********************************************
	Fin Modulo Control Ambiente
	*********************************************/

	/********************************************
	Inicio Modulo Control Programas
	*********************************************/
	public function insert_programa($sigla, $nom_programa) {
		$sigla = mysqli_real_escape_string($this->conexion, $sigla);
		$nom_programa = mysqli_real_escape_string($this->conexion, $nom_programa);

		echo $insert_programa ="INSERT INTO programa (siglas, nombre_programa) VALUES ('" . utf8_decode($sigla) . "', '" . utf8_decode($nom_programa)  . "')";
		mysqli_query($this->conexion, $insert_programa);
	}

	public function select_programa($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_programa ="SELECT * FROM programa WHERE activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_programa);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_programa($id_programa, $nom_programa) {
		$id_programa = mysqli_real_escape_string($this->conexion, $id_programa);
		$nom_programa = mysqli_real_escape_string($this->conexion, $nom_programa);

		$update_programa ="UPDATE programa SET nombre_programa = '" . utf8_decode($nom_programa) . "' WHERE id_programa = '" . $id_programa . "'";

		mysqli_query($this->conexion, $update_programa);
	}
	/********************************************
	Fin Modulo Control Programas
	*********************************************/

	/********************************************
	Inicio Modulo Control Fichas
	*********************************************/
	public function select_jornada($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_jornada ="SELECT * FROM jornada WHERE activo = '" . $valor . "'";
		$resul = mysqli_query($this->conexion, $consulta_jornada);
		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function insert_ficha($ambiente, $jornada, $programa, $num_ficha) {
		$ambiente = mysqli_real_escape_string($this->conexion, $ambiente);
		$jornada = mysqli_real_escape_string($this->conexion, $jornada);
		$programa = mysqli_real_escape_string($this->conexion, $programa);
		$num_ficha = mysqli_real_escape_string($this->conexion, $num_ficha);

		$insert_ficha ="INSERT INTO ficha (numero_ficha, id_ambiente, id_jornada, id_programa) 
						VALUES ('" . $num_ficha . "', '" . $ambiente  . "', '" . $jornada  . "', '" . $programa . "')";
		mysqli_query($this->conexion, $insert_ficha);
	}

	public function select_ficha($valor) {
		$valor = mysqli_real_escape_string($this->conexion, $valor);

		$consulta_ficha =  "SELECT f.id_centro, f.nombre_centro, e.id_sede, e.nombre_sede, d.id_ambiente, d.numero_ambiente, a.id_ficha, a.numero_ficha, b.id_programa, b.siglas, b.nombre_programa, c.id_jornada, c.nombre_jornada
							FROM ficha a
							INNER JOIN programa b ON a.id_programa = b.id_programa
							INNER JOIN jornada c ON a.id_jornada = c.id_jornada
							INNER JOIN ambiente d ON a.id_ambiente = d.id_ambiente
							INNER JOIN sede e ON d.id_sede = e.id_sede
							INNER JOIN centro f ON e.id_centro = f.id_centro
							WHERE a.activo = '" . $valor . "'";

		$resul = mysqli_query($this->conexion, $consulta_ficha);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function act_ficha($ambiente, $jornada, $programa, $num_ficha, $id_ficha) {
		$ambiente = mysqli_real_escape_string($this->conexion, $ambiente);
		$jornada = mysqli_real_escape_string($this->conexion, $jornada);
		$programa = mysqli_real_escape_string($this->conexion, $programa);
		$num_ficha = mysqli_real_escape_string($this->conexion, $num_ficha);
		$id_ficha = mysqli_real_escape_string($this->conexion, $id_ficha);

		$update_programa ="UPDATE ficha SET numero_ficha = '".$num_ficha."', id_ambiente = '".$ambiente."', id_jornada = '".$jornada."', id_programa = '".$programa."' WHERE id_ficha = '" . $id_ficha . "'";

		mysqli_query($this->conexion, $update_programa);
	}

	public function select_sede_ficha($id_centro) {
		$id_centro = mysqli_real_escape_string($this->conexion, $id_centro);

		$consulta_sede = "SELECT * FROM sede WHERE activo = '1' AND id_centro = '" . $id_centro . "'";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function select_ambiente_ficha($id_sede) {
		$id_sede = mysqli_real_escape_string($this->conexion, $id_sede);

		$consulta_sede = "SELECT * FROM ambiente WHERE activo = '1' AND id_sede = '" . $id_sede . "'";

		$resul = mysqli_query($this->conexion, $consulta_sede);

		while ($row = mysqli_fetch_array($resul)) {
			$this->resultado[] = $row;
		}
		return $this->resultado;
	}

	public function elimina_ficha($id_ficha, $opcion_ficha) {
		$id_ficha = mysqli_real_escape_string($this->conexion, $id_ficha);
		$opcion_ficha = mysqli_real_escape_string($this->conexion, $opcion_ficha);

		$update_ficha ="UPDATE ficha SET activo = '" . $opcion_ficha . "' WHERE id_ficha = '" . $id_ficha . "'";

		mysqli_query($this->conexion, $update_ficha);
	}
	/********************************************
	Fin Modulo Control Fichas
	*********************************************/

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
	/********************************************
	Fin Funciones de los Selects en casacada
	*********************************************/
	
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
			$this->resultado = 1;
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
	public function insert_ficha_masivo($num_ambiente,$sede_id) {
		$num_ambiente = mysqli_real_escape_string($this->conexion, $num_ambiente);
		$sede_id = mysqli_real_escape_string($this->conexion, $sede_id);

		$insertar_masivos ="INSERT INTO ambiente (numero_ambiente, activo, id_sede)
							VALUES ('".$num_ambiente."','1', '".$sede_id."')";	

		$resul = mysqli_query($this->conexion, $insertar_masivos);

	}



/*******************************************/
}
?>