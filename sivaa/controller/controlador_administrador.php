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

	header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?insert=1");
}

if ($_POST['editar_usuario'] == 1) {
	$cedula = $_POST['cedula'];
	$centro = $_POST['centro'];
	$perfil = $_POST['perfil'];

	$act = new consultas_admin();
	$act->act_roles($cedula, $centro, $perfil);

	header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?update=1");
}

if ($_POST['elimina_usuario'] == 1) {
	$documento_opcion = $_POST['documento'];
	$opcion = $_POST['opcion'];

	$opcion_usu = new consultas_admin();
	$opcion_usu->opcion_usuario($documento_opcion, $opcion);

	header("location:/sivaa/view/app/pages/Admin_control_usuarios.php?update=1");
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

	echo "<script>
               alert('Pregunta Insertada');
               window.history.go(-1);
          </script>";
}

if ($_POST['vacio_pregunta'] == 2) {
	$pregunta = $_POST['pregunta'];
	$id_pregunta = $_POST['id_pregunta'];

	$act_pregunta = new consultas_admin();
	$act_pregunta->act_pregunta($pregunta, $id_pregunta);

	echo "<script>
               alert('Pregunta Actualizada');
               window.history.go(-1);
          </script>";
}

if ($_POST['valida_pre'] == 1) {
	$id_pregunta = $_POST['pregunta'];
	$opcion_pre = $_POST['opcion'];

	$pregunta = new consultas_admin();
	$pregunta->elimina_pre($id_pregunta, $opcion_pre);

	echo "<script>
               alert('Pregunta Actualizada');
               window.history.go(-1);
          </script>";
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

	echo "<script>
	          alert('Regional Actualizada Correctamente');

               window.history.go(-1);
          </script>";

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

	echo "<script>
               alert('Centro Actualizado Correctamente');
               window.history.go(-1);
          </script>";
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

	echo "<script>
           alert('Sede Actualizada Correctamente');
           window.history.go(-1);
      </script>";

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

	echo "<script>
           alert('Ambiente Actualizado Correctamente');
           window.history.go(-1);
      </script>";

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

    echo "<script>
        alert(' Programa Actualizado Correctamente');
        window.history.go(-1);
      </script>";

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

	echo "<script>
          alert(' Ficha Actualizada Correctamente');
          window.history.go(-1);
         </script>";

	//header("location:/sivaa/view/app/pages/Admin_control_ficha.php?update=1");
}

if ($_POST['elimina'] == 1) {
	$id_ficha = $_POST['id_ficha'];
	$opcion_ficha = $_POST['opcion'];

	$ficha = new consultas_admin();
	$ficha->elimina_ficha($id_ficha, $opcion_ficha);

		echo "<script>
          alert('Se Ha Inactivado La Ficha Seleccionada ');
          window.history.go(-1);
         </script>";

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



/***************************************************************
Cargar Masivos Usuarios
***************************************************************************/

if (substr($_FILES['usuario_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['usuario_masivo']['name'];

	move_uploaded_file($_FILES['usuario_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$cedula = $data[0];
			$centro = $data[1];
			$rol = $data[2];

			$sqlcedula = new consultas_admin();
			$consulta_cedula = $sqlcedula->select_persona_cedula($cedula);

			if($consulta_cedula == 0) {
			//echo "Entro";
				$sqlcentro = new consultas_admin();
				$existe_centro = $sqlcentro -> select_centro_valor($centro);
				if($existe_centro != 0) {
					foreach ($existe_centro as $valor_id_centro) {
						$centro_id = $valor_id_centro['id_centro'];
					}
					$sqlrol = new consultas_admin();
					$existe_rol = $sqlrol -> select_rol_valor($rol);
					if($existe_rol != 0){
						foreach ($existe_rol as $valor_id_rol) {
							$rol_id = $valor_id_rol['id_rol'];
						}
							$insert_user = new consultas_admin();
							$insert_user->insert_usuario_masivo($cedula, $centro_id, $rol_id);
							$contarinsert++;
						}else{
						$contador++;
					}
				}else{
					$contador++;
				}
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." usuarios con exito ! \\n\\n Usuarios no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_usuarios.php" </script>';
	exit;
}


/***************************************************************
Cargar Masivos Regional
***************************************************************************/

if (substr($_FILES['regional_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['regional_masivo']['name'];

	move_uploaded_file($_FILES['regional_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$cod_regional = $data[0];
			$nom_regional = $data[1];

			$sqlcedula = new consultas_admin();
			$consulta_regional = $sqlcedula->select_regional_cod($cod_regional);

			if($consulta_regional == 0) {
			//echo "Entro";
				$insert_user = new consultas_admin();
				$insert_user->insert_regional($cod_regional, $nom_regional);
				$contarinsert++;
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Regionales con exito ! \\n\\n Regionales no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_regional.php" </script>';
	exit;
}


/***************************************************************
Cargar Masivos centros
***************************************************************************/

if (substr($_FILES['centros_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['centros_masivo']['name'];

	move_uploaded_file($_FILES['centros_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$cod_centro = $data[0];
			$nom_centro = $data[1];
			$cod_regional = $data[2];

			$sqlcentro = new consultas_admin();
			$consulta_centro = $sqlcentro->select_centro_cod($cod_centro);

			if($consulta_centro == 0) {
					//echo "Entro1";
			
				$sqlregional = new consultas_admin();
				$ver_regional = $sqlregional -> select_regional_cod($cod_regional);
					
				if($ver_regional != 0) {
					//echo "Entro2";

					foreach ($ver_regional as $valor_id_regional) {
					$regional_id = $valor_id_regional['id_regional'];
					}
					//echo $regional_id;

						$insert_user = new consultas_admin();
						$insert_user->insert_centro($cod_centro, $nom_centro, $regional_id);
						$contarinsert++;
				}else{
					$contador++;
				}
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Centros con exito ! \\n\\n Centros no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_centro.php" </script>';
	exit;
}


/***************************************************************
Cargar Masivos Sede
***************************************************************************/

if (substr($_FILES['sede_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['sede_masivo']['name'];

	move_uploaded_file($_FILES['sede_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$cod_centro = $data[0];
			$nom_sede = $data[1];

			$sqlcentro = new consultas_admin();
			$consulta_centro = $sqlcentro->select_centro_cod($cod_centro);

			if($consulta_centro != 0) {
					//echo "Entro1";
				foreach ($consulta_centro as $ver_centro) {
					$centro_id = $ver_centro['id_centro'];
					
				}
				$sqlsede = new consultas_admin();
				$ver_sede = $sqlsede -> select_sede_valor($nom_sede,$centro_id);
					
				if($ver_sede == 0) {
					//echo "Entro1";

						$insert_user = new consultas_admin();
						$insert_user->insert_sede_masivo($centro_id, $nom_sede);
						$contarinsert++;
				}else{
					$contador++;
				}
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Centros con exito ! \\n\\n Centros no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_sede.php" </script>';
	exit;
}

/***************************************************************
Cargar Masivos Ambiente
***************************************************************************/

if (substr($_FILES['ambiente_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['ambiente_masivo']['name'];

	move_uploaded_file($_FILES['ambiente_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$num_ambiente = $data[0];
			$nom_sede = $data[1];

			$sqlsede = new consultas_admin();
			$consulta_sede = $sqlsede->select_sede_ver($nom_sede);

			if($consulta_sede != 0) {
				//echo "Entro1";
				foreach ($consulta_sede as $ver_sede) {
					 $sede_id = $ver_sede['id_sede'];		
				}
				$sqlambiente = new consultas_admin();
				$consulta_ambiente = $sqlambiente -> select_ambiente_valor($num_ambiente,$sede_id);
					
				if($consulta_ambiente == 0) {
					//echo "Entro2";

						$insert_user = new consultas_admin();
						$insert_user->insert_ambiente_masivo($num_ambiente,$sede_id);
						$contarinsert++;
				}else{
					$contador++;
					//echo "no";
				}
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Centros con exito ! \\n\\n Centros no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_ambiente.php" </script>';
	exit;
}

/***************************************************************
Cargar Masivos Programa
***************************************************************************/

if (substr($_FILES['programa_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['programa_masivo']['name'];

	move_uploaded_file($_FILES['programa_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$cod_regional = $data[0];
			$nom_regional = $data[1];

			$sqlcedula = new consultas_admin();
			$consulta_regional = $sqlcedula->select_regional_cod($cod_regional);

			if($consulta_regional == 0) {
			//echo "Entro";
				$insert_user = new consultas_admin();
				$insert_user->insert_regional($cod_regional, $nom_regional);
				$contarinsert++;
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Regionales con exito ! \\n\\n Regionales no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_programa.php" </script>';
	exit;
}

/***************************************************************
Cargar Masivos ficha
***************************************************************************/

if (substr($_FILES['ficha_masivo']['name'],-3)=="csv")	{
	$carpeta = "../view/app/tmp_excel/";
	$excel = $_FILES['ficha_masivo']['name'];

	move_uploaded_file($_FILES['ficha_masivo']['tmp_name'], "$carpeta$excel");
	
	$row = 1;

	$fp = fopen ("$carpeta$excel","r");
	//fgetcsv. obtiene los valores que estan en el csv y los extrae.
	$contador = 0;
	$contarinsert = 0;
	while ($data = fgetcsv ($fp, 100000, ";")) {
		//si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
		if ($row!=1) {

			$num = count($data);

			$ficha = $data[0];
			$sede = $data[1];
			$ambiente = $data[2];
			$jornada = $data[3];
			$programa = $data[4];

			$sqlficha = new consultas_admin();
			$consulta_ficha = $sqlficha->select_ficha_ver($ficha);

			if($consulta_ficha == 0) {
				//echo "Entro1";

				$sqlambiente = new consultas_admin();
				$consulta_ambiente = $sqlambiente -> select_ambiente_valor($num_ambiente,$sede_id);
					
				if($consulta_ambiente == 0) {
					//echo "Entro2";

						$insert_user = new consultas_admin();
						$insert_user->insert_ambiente_masivo($num_ambiente,$sede_id);
						$contarinsert++;
				}else{
					$contador++;
					//echo "no";
				}
			}else{
				$contador++;
			}
		}
	$row++;
	}
	fclose ($fp);
	echo "<script> alert('Se han cargado ".$contarinsert." Centros con exito ! \\n\\n Centros no cargados:  ".$contador." ');</script>";
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_ambiente.php" </script>';
	exit;
}



	/*****************************************************************

	*****************************************************************/



?>