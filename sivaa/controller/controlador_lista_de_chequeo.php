<?php
session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_lista_de_chequeo.php");

$id_regional = $_POST['regional'];
$id_centro = $_POST['centro'];
$id_sede = $_POST['sede'];
$id_ambiente = $_POST['ambiente'];
$id_ficha = $_POST['ficha'];
$cedula = $_SESSION['cedula'];

$ciclo = $_POST['ciclo'];

for ($i=1; $i < $ciclo; $i++) { 
	$id_pregunta = $_SESSION['pregunta' . $i];
	$respuesta = $_POST['respuesta' . $i];
	$observacion = $_POST['observacion' . $i];
	
	if ($_POST['valor_ficha'] == 1) {
		$pre = new Consultas_chequeo();
		$pre->insert_respuesta($respuesta, $observacion, $id_pregunta, $_SESSION['id_regional_ficha'], $_SESSION['id_centro_ficha'], $_SESSION['id_sede_ficha'], $_SESSION['id_ambiente_ficha'], $_SESSION['id_ficha_ficha'], $cedula);
	} else {
		$pre = new Consultas_chequeo();
		$pre->insert_respuesta($respuesta, $observacion, $id_pregunta, $id_regional, $id_centro, $id_sede, $id_ambiente, $id_ficha, $cedula);
	}
	
	echo '<script language="javascript">alert("Datos guardados con Exito!");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Lista_de_chequeo.php" </script>';

	//header("location:/sivaa/view/app/pages/Lista_de_chequeo.php");
}

/********************************************
Inicio condiciones Selects es Casacada
*********************************************/
if ($_POST['cascada'] == 1) {
	$id_region = $_POST['id_region'];
	$valor = $_POST['opcion'];

	$region = new Consultas_chequeo();
	$region->select_centro_cascada($id_region, $valor);
}

if ($_POST['cascada'] == 2) {
	$id_centro = $_POST['id_centro'];
	$valor = $_POST['opcion'];

	$sede = new Consultas_chequeo();
	$sede->select_sede_cascada($id_centro, $valor);
}

if ($_POST['cascada'] == 3) {
	$id_sede = $_POST['id_sede'];
	$valor = $_POST['opcion'];

	$ambiente = new Consultas_chequeo();
	$ambiente->select_ambiente_cascada($id_sede, $valor);
}

if ($_POST['cascada'] == 4) {
	$id_ambiente = $_POST['id_ambiente'];
	$valor = $_POST['opcion'];

	$ficha = new Consultas_chequeo();
	$ficha->select_ficha_cascada($id_ambiente, $valor);
}

if ($_POST['cascada'] == 5) {
	$id_ficha = $_POST['id_ficha'];
	$valor = $_POST['opcion'];

	$ficha = new Consultas_chequeo();
	$ficha->select_datos($id_ficha, $valor);
}
/********************************************
Fin condiciones Selects es Casacada
*********************************************/

?>