<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
session_start();
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
		<title>Registro</title>
		<link href="/sivaa/view/app/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="/sivaa/view/app/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
				<div class="col-md-6 col-md-offset-3">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3>Registro de Usuario</h3>
						</div>
						<div class="panel-body">
							<form action="../../../controller/controlador_registro_usuario.php" method="POST" id="registro">
								<div class="form-group">
									<label for="documento">Documento</label>
									<input class="form-control" name="documento" id="documento" value="<?php echo $_SESSION['cedula'] ?>" disabled>
									<br>
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" name="nombre" id="nombre" required>
									<br>
									<label for="apellido">Apellido</label>
									<input type="text" class="form-control" name="apellido" id="apellido" required>
									<br>
									<label for="correo">Correo</label>
									<input type="email" class="form-control" name="correo" id="correo" required>
									<br>
									<label for="valida_correo">Repita Correo</label>
									<input type="email" class="form-control" name="valida_correo" id="valida_correo" required>
									<br>
									<label for="sexo">Sexo</label>
									<select class="form-control" name="sexo" id="sexo" required>
										<option value="">Seleccione Sexo</option>
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>
									</select>
									<br>
									<label for="direccion">Dirección</label>
									<input type="text" class="form-control" name="direccion" id="direccion" required>
									<br>
									<label for="telefono">Telefono</label>
									<input class="form-control" name="telefono" id="telefono" maxlength="10" onkeypress="return justNumbers(event);" tabindex="6" required>
									<br>
									<label for="pass">Contraseña</label>
									<input type="password" class="form-control" name="pass" id="pass" required>
									<br>
									<label for="valida_pass">Repita Contraseña</label>
									<input type="password" class="form-control" name="valida_pass" id="valida_pass" required>
								</div>
								<input type="hidden" name="ingresar_usuario" value="1">
								<input type="submit" class="btn btn-success" value="Guardar" name="btn_usuario">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="/sivaa/view/app/vendor/jquery/jquery.min.js"></script>
		<script src="/sivaa/view/app/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="/sivaa/view/app/vendor/metisMenu/metisMenu.min.js"></script>
		<script src="/sivaa/view/app/dist/js/sb-admin-2.js"></script>
		<script src="/sivaa/view/app/js/validate/jquery.validate.js"></script>
		<script>
			$().ready(function () {
				$("#registro").validate({
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

						valida_correo: {
							required: true,
							equalTo_email: "#correo"
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
						},

						pass: {
							required: true,
							minlength: 8
						},

						valida_pass: {
							required: true,
							equalTo: "#pass"
						}
					},
				});
			});
		</script>
	</body>
</html>
