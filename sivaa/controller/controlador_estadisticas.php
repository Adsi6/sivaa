<?php
session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
//error_reporting(0);

require_once("../model/modelo_estadisticas.php");

//$documento = $_SESSION['cedula'];

/********************************************
Estadisticas
*********************************************/

if ($_POST['hidden_estadisticas'] == 1) {
	$est_sin_filtro = new Estadisticas();
	$valor_sin_filtro = $est_sin_filtro->select_sin_filtro();
}


if ($_POST['act_datos'] == 1) {
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$correo = $_POST['correo'];
	$sexo = $_POST['sexo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];

	$act_datos = new Actualiza_datos();
	$act_datos->act_datos($documento, $nombre, $apellido, $correo, $sexo, $direccion, $telefono);
	
	header("location:/sivaa/view/app/pages/index.php");
}


/********************************************
*********************************************
*********************************************/
?>