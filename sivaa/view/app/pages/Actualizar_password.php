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
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../vendor/datatables/css/datatables.min.css" rel="stylesheet">
	<link href="../vendor/css/style.css" rel="stylesheet">

	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.js"></script>
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>

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
					<h1 class="page-header">Actualizar Contraseña</h1>
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
									<form action="" method="POST" id="valida_pass">
										<div class="form-group">
											<label for="pass_validar">Contraseña actual</label>
											<input type="password" class="form-control" name="pass_validar" id="pass_validar" required>
										</div>
										<input type="submit" class="btn btn-success" value="Verificar" name="btn_pass">
									</form>

									<?php
										if (isset($_POST['btn_pass'])) {
											$pass_validar = sha1($_POST['pass_validar']);
											$password_temp = $_POST['pass_validar'];

											$validar = new Actualiza_datos();
											$valor_pass = $validar->valida_password($documento, $pass_validar);

											if ($valor_pass == 0) {
												echo "<h4 id='error'>La contraseña en incorecta</h4>";
											} else {
									?>
												<form action="../../../controller/controlador_actualizar_datos.php" method="POST" id="actualiza_pass">
													<div class="form-group">
														<br>
														<input type="hidden" class="form-control" name="pass_actual" id="pass_actual" value="<?php echo $password_temp?>">

														<label for="pass">Nueva contraseña</label>
														<input type="password" class="form-control" name="pass" id="pass" required>
														<br>
														<label for="verifica_pass">Repita contraseña</label>
														<input type="password" class="form-control" name="verifica_pass" id="verifica_pass" required>
													</div>
													<input type="hidden" name="act_pass" value="1">
													<input type="submit" class="btn btn-success" value="Actualizar" name="btn_regional">
												</form>
									<?php
											}
										}
									?>
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
			$("#valida_pass").validate({
				rules: {
					pass_validar: {
						required: true
					}
				},
			});

			$("#actualiza_pass").validate({
				rules: {
					pass: {
						required: true,
						minlength: 4
					},

					verifica_pass: {
						required: true,
						equalTo: "#pass"
					}
				},
			});
		});
	</script>
</body>

</html>