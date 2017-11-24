<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
session_start();
require_once("../../../model/modelo_actualizar_datos.php");

$documento = $_SESSION['cedula'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Lista de Chequeo</title>
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../vendor/datatables/css/datatables.min.css" rel="stylesheet">
	<link href="../vendor/css/style.css" rel="stylesheet">

	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>

	<script language=Javascript>
		function justNumbers(e) {
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
				return true;
				return /\d/.test(String.fromCharCode(keynum));
		}
   </script>

</head>

<body>

	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<?php include'menu_cabecera.php';?>
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<?php include'menu.php';?>
				</div>
			</div>
		</nav>
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Actualizar Datos</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<!--<h4>Llene el formulario para contestar la encuesta</h4>-->
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-7"><br>
									<form action="../../../controller/controlador_actualizar_datos.php" method="POST" id="actualia_datos">
										<div class="form-group">
											<?php
												$datos = new Actualiza_datos();
												$act_datos = $datos->select_regional($documento);

												foreach ($act_datos as $datos_usuario) {
													$nombre = utf8_encode($datos_usuario['nombre']);
													$apellido = utf8_encode($datos_usuario['apellido']);
													$correo = $datos_usuario['correo'];
													$sexo = $datos_usuario['sexo'];
													if ($sexo == 'M') {
														$sexo_1 = "M";
														$sexo_2 = "F";
														$valor_sexo_1 = "Masculino";
														$valor_sexo_2 = "Femenino";
													} else {
														$sexo_1 = "F";
														$sexo_2 = "M";
														$valor_sexo_1 = "Femenino";
														$valor_sexo_2 = "Masculino";
													}
													$direccion = utf8_encode($datos_usuario['direccion']);
													$telefono = $datos_usuario['telefono'];
												}
											?>
											<label>Documento</label>
											<input class="form-control" name="documento" value="<?php echo $documento ?>" disabled>
											<br>
											<label for="nombre">Nombre</label>
											<input class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" required>
											<br>
											<label for="apellido">Apellido</label>
											<input class="form-control" name="apellido" id="apellido" value="<?php echo $apellido ?>" required>
											<br>
											<label for="correo">Correo</label>
											<input class="form-control" type="email" name="correo" id="correo" value="<?php echo $correo ?>" required>
											<br>
											<label for="sexo">Sexo</label>
											<select class="form-control" name="sexo" id="sexo" required>
												<option value="<?php echo $sexo_1 ?>"><?php echo $valor_sexo_1 ?></option>
												<option value="<?php echo $sexo_2 ?>"><?php echo $valor_sexo_2 ?></option>
											</select>
											<br>
											<label for="direccion">Dirección</label>
											<input class="form-control" name="direccion" id="direccion" value="<?php echo $direccion ?>" required>
											<br>
											<label for="telefono">Telefono</label>
											<input class="form-control" name="telefono" id="telefono" maxlength="10" onkeypress="return justNumbers(event);" value="<?php echo $telefono ?>" required>
										</div>
										<input type="hidden" name="act_datos" value="1">
										<input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../js/validate/jquery.validate.js"></script>
	<script>
		$().ready(function () {
			$("#actualia_datos").validate({
				rules: {
					nombre: {
						required: true,
						minlength: 3
					},

					apellido: {
						required: true,
						minlength: 3
					},

					correo: {
						required: true
					},

					sexo: {
						required: true
					},

					direccion: {
						required: true,
						minlength: 3
					},

					telefono: {
						required: true
					}
				},
			});
		});
	</script>
</body>

</html>