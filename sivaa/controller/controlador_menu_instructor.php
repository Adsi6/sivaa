<?php

session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_menu_instructor.php");


if ($_POST['valida_isert'] == 1) {
	$ficha = $_POST['ficha'];
	$cedula = $_SESSION['cedula'];

	$insert = new Menu_instructor();
	$insert->insert_persona_ficha($cedula, $ficha);

	echo "<script>
			alert('Se ha creado la ficha');
			window.history.go(-1);
		  </script>";
}

if ($_POST['elimina'] == 1) {
	$opcion = $_POST['opcion'];
	$id_ficha = $_POST['id_ficha'];

	$update = new Menu_instructor();
	$update->update_ficha($opcion, $id_ficha);

	if ($opcion == 0) {
		echo "<script>
				alert('Se ha Inactivado la ficha');
				window.history.go(-1);
			  </script>";
	} else {
		echo "<script>
				alert('Se realizo la activacion de la ficha');
				window.history.go(-1);
			  </script>";
	}
}

/********************************************
Inicio condiciones Selects es Casacada
*********************************************/
if ($_POST['cascada'] == 1) {
	$id_sede = $_POST['id_sede'];
	$valor = $_POST['opcion'];

	$ambiente = new Menu_instructor();
	$ambiente->select_ambiente_cascada($id_sede, $valor);
}

if ($_POST['cascada'] == 2) {
	$id_ambiente = $_POST['id_ambiente'];
	$valor = $_POST['opcion'];

	$ficha = new Menu_instructor();
	$ficha->select_ficha_cascada($id_ambiente, $valor);
}
/********************************************
Fin condiciones Selects es Casacada  $_SESSION['cedula']
*********************************************/




?>