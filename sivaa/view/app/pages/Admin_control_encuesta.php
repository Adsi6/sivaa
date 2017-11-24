<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
require_once("../../../model/modelo_administrador.php");

if ($_GET['update']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Pregunta Actualizada');
			</script>";
}

if ($_GET['insert']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Pregunta Insertada');
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
	<title>Control Encuestas</title>
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../vendor/datatables/css/datatables.min.css" rel="stylesheet">
	<link href="../vendor/css/style.css" rel="stylesheet">

	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<script src="../vendor/datatables/js/datatables.min.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>

	 <script>
		$(document).ready(function(){
			$("#btn_1").click(function(){
				$("#mostrar_2").hide();
				$("#mostrar_1").show();
			});
		});

		$(document).ready(function(){
			$("#btn_2").click(function(){
				$("#mostrar_1").hide();
				$("#mostrar_2").show();
			});
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
					<h1 class="page-header">Control Encuesta</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Lista de preguntas</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#encuesta">Crear Pregunta</button>
							<div class="modal fade" id="encuesta" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-body">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<form action="../../../controller/controlador_administrador.php" method="POST" id="crear_pregunta">
															<div class="modal-header">
																<h4 class="modal-title">Creación de preguntas</h4>
															</div>
															<br>
															<div class="form-group">
																<label for="pregunta">Pregunta</label>
																<textarea class="form-control" name="pregunta" id="pregunta" autofocus="" style="height: 150px;" required placeholder="Ingrese la pregunta"></textarea>
																<input type="hidden" name="vacio_pregunta" value="1">
															</div>
															<input type="submit" class="btn btn-success" value="Guardar" name="btn_guardar">
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
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">                                    
									<button id="btn_1" name="btn_1" class="btn btn-default">Preguntas Activas</button>
									<button id="btn_2" name="btn_2" class="btn btn-default">Preguntas Inactivas</button>

									<div id="mostrar_1">
										<div class="wrapper wrapper-content animated fadeInRight">
									        <div class="row">
									            <div class="col-lg-12">
									                <div class="ibox float-e-margins">
									                    <div class="ibox-content">
									                        <div class="table-responsive">
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_1">
																	<thead>
																		<tr>
																			<th>Pregunta</th>
																			<th>Fecha creación</th>
																			<th>Editar</th>
																			<th>Inactivar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$pregunta_act = new consultas_admin();
																			$pregunta_activa = $pregunta_act->select_pregunta(1);

																			foreach ($pregunta_activa as $valores_activos) {
																				$valores_activos['id_pregunta'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['pregunta'] ?></td>
																				<td><?php echo $valores_activos['fecha_creacion'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#edita<?php echo $valores_activos['id_pregunta'] ?>"><i class="fa fa-pencil-square-o"></i></button>
																				</td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#<?php echo $valores_activos['id_pregunta'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																			<div class="modal fade" id="edita<?php echo $valores_activos['id_pregunta'] ?>" role="dialog">
																				<div class="modal-dialog modal-md">
																					<div class="modal-content">
																						<div class="modal-body">
																							<div class="panel-body">
																								<div class="row">
																									<div class="col-lg-12">
																										<form action="../../../controller/controlador_administrador.php" method="POST" id="edita_pregunta">
																											<div class="modal-header">
																												<h4 class="modal-title">Editar preguntas</h4>
																											</div>
																											<div class="form-group">
																												<br>
																												<label for="pregunta">Pregunta</label>
																												<textarea class="form-control" name="pregunta" id="pregunta" style="height: 150px;" placeholder="Ingrese la pregunta" required><?php echo $valores_activos['pregunta'] ?></textarea>
																												<input type="hidden" name="vacio_pregunta" value="2">
																												<input type="hidden" name="id_pregunta" value="<?php echo $valores_activos['id_pregunta'] ?>">
																											</div>
																											<input type="submit" class="btn btn-success" value="Guardar" name="btn_guardar">
																											<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																										</form>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="modal fade" id="<?php echo $valores_activos['id_pregunta'] ?>" role="dialog">
																				<div class="modal-dialog modal-sm">
																					<div class="modal-content">
																						<form action="../../../controller/controlador_administrador.php" method="POST">
																							<div class="modal-body" style="text-align: center;">
																								<h3>Eliminar la pregunta</h3><br>
																								<input type="hidden" name="pregunta" value="<?php echo $valores_activos['id_pregunta']?>">
																								<input type="hidden" name="opcion" value="0">
																								<input type="hidden" name="valida_pre" value="1">
																								<button type="submit" class="btn btn-success">Confirmar</button>
																								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		<?php
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="mostrar_2" style="display: none;">
										<div class="wrapper wrapper-content animated fadeInRight">
									        <div class="row">
									            <div class="col-lg-12">
									                <div class="ibox float-e-margins">
									                    <div class="ibox-content">
									                        <div class="table-responsive">
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_2" style="text-align: center;">
																	<thead>
																		<tr>
																			<th>Pregunta</th>
																			<th>Fecha creación</th>
																			<th>Activar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$pregunta_act = new consultas_admin();
																			$pregunta_activa = $pregunta_act->select_pregunta(0);

																			foreach ($pregunta_activa as $valores_activos) {
																				$valores_activos['id_pregunta'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['pregunta'] ?></td>
																				<td><?php echo $valores_activos['fecha_creacion'] ?></td>
																				<td><button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#<?php echo $valores_activos['id_pregunta'] ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></td>
																			</tr>
																			<div class="modal fade" id="<?php echo $valores_activos['id_pregunta'] ?>" role="dialog">
																				<div class="modal-dialog modal-sm">
																					<div class="modal-content">
																						<form action="../../../controller/controlador_administrador.php" method="POST">
																							<div class="modal-body" style="text-align: center;">
																								<h3>Activar la pregunta</h3><br>
																								<input type="hidden" name="pregunta" value="<?php echo $valores_activos['id_pregunta']?>">
																								<input type="hidden" name="opcion" value="1">
																								<input type="hidden" name="valida_pre" value="1">
																								<button type="submit" class="btn btn-success">Confirmar</button>
																								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		<?php
																			}
																		?>
																	</tbody>
																</table>
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
				</div>
			</div>
		</div>
	</div>
	<script src="../js/validate/jquery.validate.js"></script>
	<script>
		$().ready(function () {
			$("#crear_pregunta").validate({
				rules: {
					pregunta: {
						required: true,
						minlength: 30,
						maxlength: 250
					}
				},
			});
		});
	</script>

	<script>
	$(document).ready(function() {

		$('#tabla_1').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ],

            "language": {
				"url": "../js/Spanish.json"
			}

        });

        $('#tabla_2').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ],

            "language": {
				"url": "../js/Spanish.json"
			}

        });
	});
	</script>
</body>

</html>