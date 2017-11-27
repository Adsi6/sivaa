<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
//session_start();
error_reporting(0);
require_once("../../../model/modelo_olvido_password.php");

$cedula = $_GET['cedula'];
$token = $_GET['token'];

$sqlcedula = new olvido_password();
$consulta_cedula = $sqlcedula->recuperacion_correo($cedula,$token);


if ($consulta_cedula != 0) {

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Restaurar contraseña</title>
		<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
		<link href="/sivaa/view/app/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="/sivaa/view/app/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="/sivaa/view/app/vendor/css/style.css" rel="stylesheet">
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
							<h3>Restaurar contraseña del usuario: <?php echo $cedula ?></h3>
						</div>
						<div class="panel-body">
							<form action="../../../controller/controlador_olvido_password.php" method="POST" id="registro_pass">
								<div class="form-group">
									<label for="pass">Nueva Contraseña</label>
									<input type="password" class="form-control" name="pass" id="pass" required>
									<br>
									<input type="hidden" name="cedula" value="<?php echo $cedula?>">
									<label for="valida_pass">Repita Contraseña</label>
									<input type="password" class="form-control" name="valida_pass" id="valida_pass" required>
								</div>
                              	<input type="hidden" name="recuperar_pass" value="1">
								<input type="submit" class="btn btn-success" value="recuperar" >
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
				$("#registro_pass").validate({
					rules: {
						
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
<?php
}else {
  echo "<script> alert('No fue posible restaurar la contraseña por favor intente nuevamente');</script>";
  echo '<script>document.location.href="../../../index.php" </script>';
}

?>