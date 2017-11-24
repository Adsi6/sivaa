<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
session_start();
error_reporting(0);
require_once("../../../model/modelo_menu_instructor.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Crear fichas</title>
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

	<script language="javascript">
		$(document).ready(function(){

			$("#sede").change(function () {
				$("#sede option:selected").each(function () {
					id_sede = $(this).val();
					$.post("../../../controller/controlador_menu_instructor.php", { id_sede: id_sede, cascada: 1, opcion: 1 }, function(data){
						$("#ambiente").html(data);
					});
				});
			})

			$("#ambiente").change(function () {
				$("#ambiente option:selected").each(function () {
				id_ambiente = $(this).val();
					$.post("../../../controller/controlador_menu_instructor.php", { id_ambiente: id_ambiente, cascada: 2, opcion: 1 }, function(data){
						$("#ficha").html(data);
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
					<h1 class="page-header">Control Fichas</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Fichas Instructor</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#fichas">Asociar ficha</button>
							<div class="modal fade" id="fichas" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12"><br>
													<form action="../../../controller/controlador_menu_instructor.php" method="POST">
														<div class="form-group">
															<label>Nombre Centro</label>
															<select id="centro" name="centro" class="form-control" required disabled>
																<?php
																	$centro_act = new Menu_instructor();
																	$centro_activo = $centro_act->select_centro($_SESSION['id_centro']);
																	foreach ($centro_activo as $centro_actual) {
																		echo "<option value='" . $centro_actual['id_centro'] . "'>" . utf8_encode($centro_actual['nombre_centro']) . "</option>";
																	}
																?>
															</select>
															<br>
															<label>Nombre Sede</label>
															<select id="sede" name="sede" class="form-control" required>
																<option value="">Seleccione sede</option>
																<?php
																	$sede_act = new Menu_instructor();
																	$sede_activo = $sede_act->select_sede($_SESSION['id_centro']);

																	foreach ($sede_activo as $sede) {
																		echo "<option value='" . $sede['id_sede'] . "'>" . utf8_encode($sede['nombre_sede']) . "</option>";
																	}
																?>
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
														<input type="hidden" name="valida_isert" value="1">
														<input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													</form>
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
									<button id="btn_1" name="btn_1" class="btn btn-default">Fichas Activas</button>
									<button id="btn_2" name="btn_2" class="btn btn-default">Fichas Inactivas</button>

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
																			<th>Centro</th>
																			<th>Sede</th>
																			<th>Programa</th>
																			<th>Ambiente</th>
																			<th>Jornada</th>
																			<th>Ficha</th>
																			<th>Inactivar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$ficha_act = new Menu_instructor();
																			$ficha_activa = $ficha_act->select_ficha(1);

																			foreach ($ficha_activa as $valores_activos) {
																				$id_ficha = $valores_activos['id_persona_ficha'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo utf8_encode($valores_activos['nombre_centro']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_sede']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_programa']) ?></td>
																				<td><?php echo $valores_activos['numero_ambiente'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_jornada']) ?></td>
																				<td><?php echo $valores_activos['numero_ficha'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#elimina<?php echo $id_ficha ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																				<div class="modal fade" id="elimina<?php echo $id_ficha ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<form action="../../../controller/controlador_menu_instructor.php" method="POST">
																								<div class="modal-body" style="text-align: center;">
																									<h3>Inactivar la ficha</h3><br>
																									<input type="hidden" name="id_ficha" value="<?php echo $id_ficha?>">
																									<input type="hidden" name="opcion" value="0">
																									<input type="hidden" name="elimina" value="1">
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
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_2">
																	<thead>
																		<tr>
																			<th>Centro</th>
																			<th>Sede</th>
																			<th>Programa</th>
																			<th>Ambiente</th>
																			<th>Jornada</th>
																			<th>Ficha</th>
																			<th>Activar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$ficha_act = new Menu_instructor();
																			$ficha_activa = $ficha_act->select_ficha(0);

																			foreach ($ficha_activa as $valores_activos) {
																				$id_ficha = $valores_activos['id_persona_ficha'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['nombre_centro'] ?></td>
																				<td><?php echo $valores_activos['nombre_sede'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_programa']) ?></td>
																				<td><?php echo $valores_activos['numero_ambiente'] ?></td>
																				<td><?php echo $valores_activos['nombre_jornada'] ?></td>
																				<td><?php echo $valores_activos['numero_ficha'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#activa<?php echo $id_ficha ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																				<div class="modal fade" id="activa<?php echo $id_ficha ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<form action="../../../controller/controlador_menu_instructor.php" method="POST">
																								<div class="modal-body" style="text-align: center;">
																									<h3>Activar la ficha</h3><br>
																									<input type="hidden" name="id_ficha" value="<?php echo $id_ficha?>">
																									<input type="hidden" name="opcion" value="1">
																									<input type="hidden" name="elimina" value="1">
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