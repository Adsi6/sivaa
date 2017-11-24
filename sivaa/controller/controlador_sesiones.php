<?php

session_start();
//echo $_SERVER['PHP_SELF'];

require_once("../model/modelo_sesiones.php");

$user = $_POST['usuario'];
$pass = sha1($_POST['password']);

if ($user == "" || $pass == "") {
	echo "<script>
               alert('Error al ingresar los datos');
               window.history.go(-1);
          </script>";
} else {
	$valores = new Consultas();
	$valores->validar_usuario($user, $pass);

	if ($_SESSION['id_rol'] == 1) {
		header("location:/sivaa/view/app/pages/index.php");

	} else if ($_SESSION['id_rol'] == 2) {
		header("location:/sivaa/view/app/pages/index.php");

	} else if ($_SESSION['id_rol'] == 3) {
		header("location:/sivaa/view/app/pages/index.php");

	} else {


	}
}

/*
$_SESSION['id_rol'];
$_SESSION['nombre_rol'];
$_SESSION['nombre_usuario'];
$_SESSION['apellido_usuario'];
*/

?>