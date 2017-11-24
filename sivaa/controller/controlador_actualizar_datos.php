<?php
session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_actualizar_datos.php");

$documento = $_SESSION['cedula'];

/********************************************
Actualizar Datos
*********************************************/

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

if ($_POST['act_pass'] == 1) {
	$pass_actual = sha1($_POST['pass_actual']);
	$pass = sha1($_POST['pass']);

	if ($pass_actual == $pass) {
		header("location:/sivaa/view/app/pages/Actualizar_password.php?error=1");
	} else {
		$validar = new Actualiza_datos();
		$validar->act_password($documento, $pass);

		header("location:/sivaa/view/app/pages/index.php");
	}
}

/********************************************
*********************************************
*********************************************/
?>