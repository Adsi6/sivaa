<?php
session_start();
if ($_SESSION['nombre_usuario'] && $_SESSION['nombre_rol']) {
	session_destroy();
	header("location:/sivaa/index.php");
}
?>