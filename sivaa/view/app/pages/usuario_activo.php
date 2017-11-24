<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
//session_start();
error_reporting(0);
require_once("../../../model/modelo_registro_usuario.php");

$cedula = $_GET['cedula'];
$token = $_GET['token'];

	$sqlcedula = new Registro_usuario();
	$consulta_cedula = $sqlcedula->validar_token($cedula,$token);


       if ($consulta_cedula != 0) {
       	$code = sha1(uniqid(rand()));
		$updatetoken = new Registro_usuario();
		$updatetoken->update_token($code,$cedula);

       	$sqlactivo = new Registro_usuario();
		$sqlactivo->activar_usuario($cedula);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>usuario activo</title>
		<link href="/sivaa/view/app/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="/sivaa/view/app/dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="/sivaa/view/app/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3>usuario activo: <?php echo $cedula ?></h3>
						</div>
						<div class="panel-body">
							<form action="../../../index.php" >
								<input type="submit" class="btn btn-success" value=" usuario activo" >
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
}else{

  echo "<script> alert('No fue posible activar el usuario ".$cedula."  por favor intente nuevamente');</script>";
  echo '<script>document.location.href="../../../index.php" </script>';
}

?>