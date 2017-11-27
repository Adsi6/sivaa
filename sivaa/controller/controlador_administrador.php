<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_administrador.php");

/********************************************
Inicio Modulo Control Usuarios
*********************************************/
if ($_POST['crear_usuario'] == 1) {
	$documento = $_POST['documento'];
	$centro = $_POST['centro'];
	$perfil = $_POST['perfil'];

	$insert_usuario = new consultas_admin();
	$insert_usuario->insert_usuario($documento, $centro, $perfil);
	
	echo '<script language="javascript">alert("suario creado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_usuarios.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?insert=1");
}

if ($_POST['editar_usuario'] == 1) {
	$cedula = $_POST['cedula'];
	$centro = $_POST['centro'];
	$perfil = $_POST['perfil'];

	if ($centro != NULL || $perfil != NULL) {
		$act = new consultas_admin();
		$act->act_roles($cedula, $centro, $perfil);
	}

	echo '<script language="javascript">alert("Usuario Modificado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_usuarios.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?update=1");
}

if ($_POST['elimina_usuario'] == 1) {
	$documento_opcion = $_POST['documento'];
	$opcion = $_POST['opcion'];

	$opcion_usu = new consultas_admin();
	$opcion_usu->opcion_usuario($documento_opcion, $opcion);

	echo '<script language="javascript">alert("Usuario Modificado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_usuarios.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?update=1");
}




/********************************************
Fin Modulo Control Usuarios
*********************************************/

/********************************************
Inicio Modulo Control Encuesta
*********************************************/
if ($_POST['vacio_pregunta'] == 1) {
	$pregunta = $_POST['pregunta'];

	$insert_pregunta = new consultas_admin();
	$insert_pregunta->insert_pregunta($pregunta);


    echo '<script language="javascript">alert("Pregunta Insertada");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_encuesta.php" </script>';
}

if ($_POST['vacio_pregunta'] == 2) {
	$pregunta = $_POST['pregunta'];
	$id_pregunta = $_POST['id_pregunta'];

	$act_pregunta = new consultas_admin();
	$act_pregunta->act_pregunta($pregunta, $id_pregunta);


    echo '<script language="javascript">alert("Pregunta Actualizada");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_encuesta.php" </script>';
}

if ($_POST['valida_pre'] == 1) {
	$id_pregunta = $_POST['pregunta'];
	$opcion_pre = $_POST['opcion'];

	$pregunta = new consultas_admin();
	$pregunta->elimina_pre($id_pregunta, $opcion_pre);


    echo '<script language="javascript">alert("Pregunta Actualizada");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_encuesta.php" </script>';
}
/********************************************
Fin Modulo Control Encuesta
*********************************************/

/********************************************
Inicio Modulo Control Regionales
*********************************************/
if ($_POST['vacio_regional'] == 1) {
	$cod_regional = $_POST['cod_regional'];
	$nom_regional = $_POST['nom_regional'];

	$insert_regional = new consultas_admin();
	$insert_regional->insert_regional($cod_regional, $nom_regional);

	//echo "<script>
	          // alert('Nueva Regional Insertada');
              // window.history.go(-1);
         // </script>";
     echo '<script language="javascript">alert("Nueva Regional Insertada");</script>'; 
     echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_regional.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_regional.php?insert=1");
}

if ($_POST['vacio_regional'] == 2) {
	$id_region = $_POST['id_regional'];
	$nombre_region = $_POST['nom_regional'];

	$act_region = new consultas_admin();
	$act_region->act_region($id_region, $nombre_region);


	echo '<script language="javascript">alert("Regional Actualizada Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_regional.php" </script>';
	//header("location:/sivaa/view/app/pages/Admin_control_regional.php?update=1");
}
/********************************************
Fin Modulo Control Regionales
*********************************************/

/********************************************
Inicio Modulo Control Centros
*********************************************/
if ($_POST['vacio_centro'] == 1) {
	$cod_centro = $_POST['cod_centro'];
	$nom_centro = $_POST['nom_centro'];
	$cod_regional = $_POST['cod_regional'];

	$insert_centro = new consultas_admin();
	$insert_centro->insert_centro($cod_centro, $nom_centro, $cod_regional);

	//echo "<script>
               //alert('Nuevo Centro Insertado');
              // window.history.go(-1);
          //</script>";
    echo '<script language="javascript">alert("Nuevo Centro Insertado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_centro.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_centro.php?insert=1");
}

if ($_POST['vacio_centro'] == 2) {
	$nom_centro = $_POST['nom_centro'];
	$id_centro = $_POST['id_centro'];

	$act_centro = new consultas_admin();
	$act_centro->act_centro($nom_centro, $id_centro);


    echo '<script language="javascript">alert("Centro Actualizado Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_centro.php" </script>';
	//header("location:/sivaa/view/app/pages/Admin_control_centro.php?insert=1");
}
/********************************************
Fin Modulo Control Centros
*********************************************/

/********************************************
Inicio Modulo Control Sede
*********************************************/
if ($_POST['vacio_sede'] == 1) {
	$nom_sede = $_POST['nom_sede'];
	$cod_centro = $_POST['centro'];

	$insert_sede = new consultas_admin();
	$insert_sede->insert_sede($nom_sede, $cod_centro);

	//echo "<script>
      //         alert('Nueva Sede Insertada');
        //       window.history.go(-1);
          //</script>";

    echo '<script language="javascript">alert("Nueva Sede Insertado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_sede.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_sede.php?insert=1");
}

if ($_POST['vacio_sede'] == 2) {
	$nom_sede = $_POST['nom_sede'];
	$id_sede = $_POST['id_sede'];

	$act_sede = new consultas_admin();
	$act_sede->act_sede($nom_sede, $id_sede);

    echo '<script language="javascript">alert("Sede Actualizada Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_sede.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_sede.php?insert=1");
}
/********************************************
Fin Modulo Control Sede
*********************************************/

/********************************************
Inicio Modulo Control Ambientes
*********************************************/
if ($_POST['vacio_ambiente'] == 1) {
	$num_ambiente = $_POST['num_ambiente'];
	$cod_sede = $_POST['sede'];

	$insert_ambiente = new consultas_admin();
	$insert_ambiente->insert_ambiente($num_ambiente, $cod_sede);

    //echo "<script>
      //  alert('Nuevo Ambiente Insertado');
        //window.history.go(-1);
      //</script>";

    echo '<script language="javascript">alert("Nuevo Ambiente Insertado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_ambiente.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_ambiente.php?insert=1");
}

if ($_POST['vacio_ambiente'] == 2) {
	$id_ambiente = $_POST['id_ambiente'];
	$num_ambiente = $_POST['num_ambiente'];

	$act_ambiente = new consultas_admin();
	$act_ambiente->act_ambiente($id_ambiente, $num_ambiente);

    echo '<script language="javascript">alert("Ambiente Actualizado Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_ambiente.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_ambiente.php?insert=1");
}
/********************************************
Fin Modulo Control Ambientes
*********************************************/

/********************************************
Inicio Modulo Control Programa
*********************************************/
if ($_POST['vacio_programa'] == 1) {
	$sigla = $_POST['sigla'];
	$nom_programa = $_POST['nom_programa'];

	$insert_programa = new consultas_admin();
	$insert_programa->insert_programa($sigla, $nom_programa);

    //echo "<script>
      //  alert('Nuevo Programa Insertado');
       // window.history.go(-1);
      //</script>";

    echo '<script language="javascript">alert("Nuevo Programa Insertado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_programa.php" </script>';


	//header("location:/sivaa/view/app/pages/Admin_control_programa.php?insert=1");
}

if ($_POST['vacio_programa'] == 2) {
	$id_programa = $_POST['id_programa'];
	$nom_programa = $_POST['nom_programa'];

	$act_programa = new consultas_admin();
	$act_programa->act_programa($id_programa, $nom_programa);


    echo '<script language="javascript">alert("Programa Actualizado Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_programa.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_programa.php?insert=1");
}
/********************************************
Fin Modulo Control Programa
*********************************************/

/********************************************
Inicio Modulo Control Ficha
*********************************************/
if ($_POST['vacio_ficha'] == 1) {
	$ambiente = $_POST['ambiente'];
	$jornada = $_POST['jornada'];
	$programa = $_POST['programa'];
	$num_ficha = $_POST['num_ficha'];

	$insert_pregunta = new consultas_admin();
	$insert_pregunta->insert_ficha($ambiente, $jornada, $programa, $num_ficha);

	//echo "<script>
        //  alert(' Nueva Ficha Insertada');
      //    window.history.go(-1);
    //     </script>";

    echo '<script language="javascript">alert("Nuevo Programa Insertado");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_ficha.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_ficha.php?insert=1");
}

if ($_POST['vacio_ficha'] == 2) {
	$ambiente = $_POST['ambiente'];
	$jornada = $_POST['jornada'];
	$programa = $_POST['programa'];
	$num_ficha = $_POST['num_ficha'];
	$id_ficha = $_POST['id_ficha'];

	$act_ficha = new consultas_admin();
	$act_ficha->act_ficha($ambiente, $jornada, $programa, $num_ficha, $id_ficha);


    echo '<script language="javascript">alert(" Ficha Actualizada Correctamente");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_ficha.php" </script>';
	//header("location:/sivaa/view/app/pages/Admin_control_ficha.php?update=1");
}

if ($_POST['elimina'] == 1) {
	$id_ficha = $_POST['id_ficha'];
	$opcion_ficha = $_POST['opcion'];

	$ficha = new consultas_admin();
	$ficha->elimina_ficha($id_ficha, $opcion_ficha);

    echo '<script language="javascript">alert(" Se Ha Inactivado La Ficha Seleccionada");</script>'; 
    echo '<script>document.location.href="/sivaa/view/app/pages/Admin_control_ficha.php" </script>';

	//header("location:/sivaa/view/app/pages/Admin_control_ficha.php?update=1");
}
/********************************************
Fin Modulo Control Ficha
*********************************************/

/********************************************
Inicio condiciones Selects es Casacada
*********************************************/
if ($_POST['cascada'] == 1) {
	$id_region = $_POST['id_region'];
	$valor = $_POST['opcion'];

	$region = new consultas_admin();
	$region->select_centro_cascada($id_region, $valor);
}

if ($_POST['cascada'] == 2) {
	$id_centro = $_POST['id_centro'];
	$valor = $_POST['opcion'];

	$sede = new consultas_admin();
	$sede->select_sede_cascada($id_centro, $valor);
}

if ($_POST['cascada'] == 3) {
	$id_sede = $_POST['id_sede'];
	$valor = $_POST['opcion'];

	$ambiente = new consultas_admin();
	$ambiente->select_ambiente_cascada($id_sede, $valor);
}
/********************************************
Fin condiciones Selects es Casacada
*********************************************/


	/*****************************************************************

	*****************************************************************/



?>