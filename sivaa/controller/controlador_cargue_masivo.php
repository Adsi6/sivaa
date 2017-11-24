<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_cargue_masivo.php");


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

			$sqlcedula = new consultas_masivo();
			$consulta_cedula = $sqlcedula->select_persona_cedula($cedula);

			if($consulta_cedula == 0) {
			//echo "Entro";
				$sqlcentro = new consultas_masivo();
				$existe_centro = $sqlcentro -> select_centro_valor($centro);
				if($existe_centro != 0) {
					foreach ($existe_centro as $valor_id_centro) {
						$centro_id = $valor_id_centro['id_centro'];
					}
					$sqlrol = new consultas_masivo();
					$existe_rol = $sqlrol -> select_rol_valor($rol);
					if($existe_rol != 0){
						foreach ($existe_rol as $valor_id_rol) {
							$rol_id = $valor_id_rol['id_rol'];
						}
							$insert_user = new consultas_masivo();
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

			$sqlcedula = new consultas_masivo();
			$consulta_regional = $sqlcedula->select_regional_cod($cod_regional);

			if($consulta_regional == 0) {
			//echo "Entro";
				$insert_user = new consultas_masivo();
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

			$sqlcentro = new consultas_masivo();
			$consulta_centro = $sqlcentro->select_centro_cod($cod_centro);

			if($consulta_centro == 0) {
					//echo "Entro1";
			
				$sqlregional = new consultas_masivo();
				$ver_regional = $sqlregional -> select_regional_cod($cod_regional);
					
				if($ver_regional != 0) {
					//echo "Entro2";

					foreach ($ver_regional as $valor_id_regional) {
					$regional_id = $valor_id_regional['id_regional'];
					}
					//echo $regional_id;

						$insert_user = new consultas_masivo();
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

			$sqlcentro = new consultas_masivo();
			$consulta_centro = $sqlcentro->select_centro_cod($cod_centro);

			if($consulta_centro != 0) {
					//echo "Entro1";
				foreach ($consulta_centro as $ver_centro) {
					$centro_id = $ver_centro['id_centro'];
					
				}
				$sqlsede = new consultas_masivo();
				$ver_sede = $sqlsede -> select_sede_valor($nom_sede,$centro_id);
					
				if($ver_sede == 0) {
					//echo "Entro1";

						$insert_user = new consultas_masivo();
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

			$nom_sede = $data[0];
			$num_ambiente = $data[1];

			$sqlsede = new consultas_masivo();
			$consulta_sede = $sqlsede->select_sede_ver($nom_sede);

			if($consulta_sede != 0) {
				//echo "Entro1";
				foreach ($consulta_sede as $ver_sede) {
					 $sede_id = $ver_sede['id_sede'];		
				}
				$sqlambiente = new consultas_masivo();
				$consulta_ambiente = $sqlambiente -> select_ambiente_valor($num_ambiente,$sede_id);
					
				if($consulta_ambiente == 0) {
					//echo "Entro2";

						$insert_user = new consultas_masivo();
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
			$nom_sede = $data[1];
			$num_ambiente = $data[2];
			$nom_jornada = $data[3];
			$siglas = $data[4];

			$sqlficha = new consultas_masivo();
			$consulta_ficha = $sqlficha->select_ficha_ver($ficha);

			if($consulta_ficha == 0) {
				//echo "Entro1";

				$sqlsede = new consultas_masivo();
				$consulta_sede = $sqlsede -> select_sede_ver($nom_sede);		
				if($consulta_sede != 0) {
					foreach ($consulta_sede as $ver_sede) {
					 $sede_id = $ver_sede['id_sede'];		
				}
				$sqlambiente = new consultas_masivo();
				$consulta_ambiente = $sqlambiente -> select_ambiente_valor($num_ambiente,$sede_id);

						if($consulta_ambiente != 0) {
								foreach ($consulta_ambiente as $ver_ambiente) {
								 $ambiente_id = $ver_ambiente['id_ambiente'];		
							}

							$sqljornada = new consultas_masivo();
							$consulta_jornada = $sqljornada -> select_jornada_ver($nom_jornada);
									if($consulta_jornada != 0) {
										foreach ($consulta_jornada as $ver_jornada) {
										 $jornada_id = $ver_jornada['id_jornada'];		
									}
									$sqlprograma = new consultas_masivo();
									$consulta_programa = $sqlprograma -> select_programa_ver($siglas);
										if($consulta_programa != 0) {
										//echo "Entro2";
										foreach ($consulta_programa as $ver_programa) {
										 $programa_id = $ver_programa['id_programa'];		
										}
											$insert_ficha = new consultas_masivo();
											$insert_ficha->insert_ficha_masivo($ficha,$ambiente_id,$jornada_id,$programa_id);
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
	echo '<script>document.location.href="../../../sivaa/view/app/pages/Admin_control_ficha.php" </script>';
	exit;
}



	/*****************************************************************

	*****************************************************************/



?>