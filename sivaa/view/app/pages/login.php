<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Login</title>
		<link rel="icon" href="view/app/img/favicon.ico" type="image/x-icon">
		<link href="view/app/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="view/app/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="view/app/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="view/app/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="view/app/vendor/css/style.css" rel="stylesheet">
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
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h2>Inicio de sesión</h2>
						</div>
						<div class="panel-body">
							<form action="controller/controlador_sesiones.php" method="POST" id="login">
								<fieldset>
									<div class="form-group">
										<label for="usuario"></label>
										<input class="form-control" placeholder="Usuario" name="usuario" id="usuario" type="text" required="required" autofocus>

										<label for="password"></label>
										<input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" required="required">
									</div>
									<button type="button" class="btn btn-link" data-toggle="modal" data-target="#registro">Registrarse</button><br>
									<button type="button" class="btn btn-link" data-toggle="modal" data-target="#olvido_pass">¿Olvido su contraseña?</button>
									<!--<p><a href="">¿Olvido su contraseña?</a></p>-->
									<input type="submit" name="btn_login" class="btn btn btn-success btn-block" value="Ingresar">
								</fieldset>
							</form>

							<!-- Modal Olvido contraseña-->
							<div class="modal fade" id="olvido_pass" role="dialog">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12"><br>
													<form action="controller/controlador_olvido_password.php" method="POST" >
														<div class="form-group">
															<label >Ingrese Correo Registrado</label>
															<input class="form-control" name="correo" id="correo" required >
														</div>
														<input type="hidden" name="recuperar" value="1">
														<input type="submit" class="btn btn-success" value="recuperar" >
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal Registrarse-->
							<div class="modal fade" id="registro" role="dialog">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12"><br>
													<form action="controller/controlador_registro_usuario.php" method="POST" id="login_2">
														<div class="form-group">
															<label for="documento">Numero de Documento</label>
															<input class="form-control" name="documento" id="documento" maxlength="10" onkeypress="return justNumbers(event);" required>
															<input type="hidden" name="valida_documento" value="1">
														</div>
														<input type="submit" class="btn btn-success" value="Consultar" name="btn_regional">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="view/app/vendor/jquery/jquery.min.js"></script>
		<script src="view/app/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="view/app/vendor/metisMenu/metisMenu.min.js"></script>
		<script src="view/app/dist/js/sb-admin-2.js"></script>
		<script src="view/app/js/validate/jquery.validate.js"></script>
		<script>
			$().ready(function () {
				$("#login").validate({
					rules: {
						usuario: {
							required: true
						},

						password: {
							required: true
						}
					},
				});

				$("#login_2").validate({
					rules: {
						documento: {
							required: true
						}
					},
				});
			});
		</script>
	</body>
</html>
