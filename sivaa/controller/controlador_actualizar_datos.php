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
	echo '<script language="javascript">alert("Datos Actualizados");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/index.php" </script>';
	//header("location:/sivaa/view/app/pages/index.php");
}

if ($_POST['act_pass'] == 1) {
	$pass_actual = sha1($_POST['pass_actual']);
	$pass = sha1($_POST['pass']);

	if ($pass_actual == $pass) {
		echo '<script language="javascript">alert("La contraseña debe ser diferente a la actual");</script>'; 
    	echo '<script>document.location.href="/sivaa/view/app/pages/Actualizar_password.php" </script>';
		//header("location:/sivaa/view/app/pages/Actualizar_password.php?error=1");
	} else {
		$validar = new Actualiza_datos();
		$validar->act_password($documento, $pass);
		echo '<script language="javascript">alert("Su contraseña Se ha Actualizado");</script>'; 
    	echo '<script>document.location.href="/sivaa/view/app/pages/index.php" </script>';
		//header("location:/sivaa/view/app/pages/index.php");
	}
}

/********************************************
*********************************************
*********************************************/
?>