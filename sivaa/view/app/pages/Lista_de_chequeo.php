<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
session_start();
require_once("../../../model/modelo_lista_de_chequeo.php");

if ($_GET['update']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Regional Actualizada');
			</script>";
}

if ($_GET['insert']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Regional Insertada');
			</script>";
}

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
	<link href="../vendor/css/style.css" rel="stylesheet">

	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="../vendor/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="../vendor/css/custom.css" rel="stylesheet">

	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>

	<script src="../js/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

	<script language="javascript">
		$(document).ready(function(){
			$("#regional").change(function () {
		$('#sede').find('option').remove().end().append('<option value=""></option>').val('');
		$('#ambiente').find('option').remove().end().append('<option value=""></option>').val('');
		$('#ficha').find('option').remove().end().append('<option value=""></option>').val('');
				$("#regional option:selected").each(function () {
					id_region = $(this).val();
					$.post("../../../controller/controlador_lista_de_chequeo.php", { id_region: id_region, cascada: 1, opcion: 1 }, function(data){
						$("#centro").html(data);
					});
				});
			})

			$("#centro").change(function () {
				$("#centro option:selected").each(function () {
					id_centro = $(this).val();
					$.post("../../../controller/controlador_lista_de_chequeo.php", { id_centro: id_centro, cascada: 2, opcion: 1 }, function(data){
						$("#sede").html(data);
					});
				});
			})

			$("#sede").change(function () {
				$("#sede option:selected").each(function () {
					id_sede = $(this).val();
					$.post("../../../controller/controlador_lista_de_chequeo.php", { id_sede: id_sede, cascada: 3, opcion: 1 }, function(data){
						$("#ambiente").html(data);
					});
				});
			})

			$("#ambiente").change(function () {
				$("#ambiente option:selected").each(function () {
				id_ambiente = $(this).val();
					$.post("../../../controller/controlador_lista_de_chequeo.php", { id_ambiente: id_ambiente, cascada: 4, opcion: 1 }, function(data){
						$("#ficha").html(data);
					});
				});
			})

			$("#ficha_2").change(function () {
				$("#ficha_2 option:selected").each(function () {
				id_ficha = $(this).val();
					$.post("../../../controller/controlador_lista_de_chequeo.php", { id_ficha: id_ficha, cascada: 5, opcion: 1 }, function(data){
						//$("#ficha").html(data);
					});
				});
			})
		});        
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
					<h1 class="page-header">Lista de Chequeo</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Llene el formulario para contestar la encuesta</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-7"><br>
									<form action="../../../controller/controlador_lista_de_chequeo.php" method="POST">
										<?php
											if ($_SESSION['nombre_rol'] == "Administrador") {
										?>
												<div class="form-group">
													<label>Nombre Regional</label>
													<select id="regional" name="regional" class="form-control" required>
														<option value="">Seleccione regional</option>
														<?php
															$region_act = new Consultas_chequeo();
															$region_activo = $region_act->select_regional(1);

															foreach ($region_activo as $region) {
																echo "<option value='" . $region['id_regional'] . "'>" . utf8_encode($region['nombre_regional'] . " | " . $region['cod_regional']) . "</option>";
															}
														?>
													</select>
													<br>
													<label>Nombre Centro</label>
													<select id="centro" name="centro" class="form-control" required>
														<option value="">Seleccione centro</option>
													</select>
													<br>
													<label>Nombre Sede</label>
													<select id="sede" name="sede" class="form-control" required>
														<option value="">Seleccione sede</option>
													</select>
													<br>
													<label>Numero Ambiente</label>
													<select id="ambiente" name="ambiente" class="form-control" required>
														<option value="">Seleccione Ambiente</option>
													</select>
													<br>
													<label>Numero Ficha</label>
													<select id="ficha" name="ficha" class="form-control" required>
														<option value="">Seleccione Ficha</option>
													</select>
												</div>
										<?php
											} else if ($_SESSION['nombre_rol'] == "Instructor") {
												//$_SESSION['id_centro'];
										?>
												<div class="form-group">
													<label>Numero Ficha</label>
													<select id="ficha_2" name="ficha" class="form-control" required>
														<option value="">Seleccione Ficha</option>
														<?php
															$ficha_act = new Consultas_chequeo();
															$ficha_activo = $ficha_act->select_ficha();

															foreach ($ficha_activo as $ficha) {
																echo "<option value='" . $ficha['id_ficha'] . "'>" . utf8_encode($ficha['numero_ficha']) . "</option>";
															}
														?>
													</select>
													<input type="hidden" name="valor_ficha" value="1">
												</div>
										<?php
											}
										?>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#encuesta">Ver Encuesta</button>
											<!-- Modal -->
											<div class="modal fade" id="encuesta" role="dialog">
											  <div class="modal-dialog" style="width: 80%">
												<div class="modal-content">
												  <div class="panel-body">
													<div class="row">
													  <div class="col-lg-12 col-sm-8"><br>
														<div class="modal-header">
														  <h4 class="modal-title">Lista de Chequeo</h4>
														</div>
														<div class="modal-body">
														  <div class="panel panel-default">
															<div class="panel-body">
															   <table width="100%" class="table table-striped table-hover table-responsive">
																<thead>
																  <tr>
																	<th>#</th>
																	<th>Pregunta</th>
																	<th>Cumple</th>
																	<th>No Cumple</th>
																	<th>Observación</th>
																  </tr>
																</thead>
																<tbody>
																  <?php
																	$pregunta_act = new Consultas_chequeo();
																	$pregunta_activo = $pregunta_act->select_pregunta(1);
																	$i = 1;
																	foreach ($pregunta_activo as $pregunta) {
																	  $id_pregunta = $pregunta['id_pregunta'];
																	  $_SESSION['pregunta' . $i] = $id_pregunta;
																  ?>
																	  <tr>
																		<td><?php echo $i ?></td>
																		<td><?php echo $pregunta['pregunta'] ?></td>
																		<td><div class="i-checks">
																		  <input type="radio" name="respuesta<?php echo $i ?>" value="1" required>
																		</div>
																		</td>
																		<td>
																			<div class="i-checks">
																		  <input type="radio" name="respuesta<?php echo $i ?>" value="0" required>
																		</div>
																		</td>
																		<td>
																		  <textarea class="form-control" name="observacion<?php echo $i ?>" style="height: 50px;"></textarea>
																		</td>
																	  </tr>
																  <?php
																	  $i++;
																	}
																  ?>
																</tbody>
															  </table>
															</div>
														  </div>
														</div>
														  <input type="hidden" name="ciclo" value="<?php echo $i ?>">
														  <input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
														  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													  </div>
													</div>
												  </div>
												</div>
											  </div>
											</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>