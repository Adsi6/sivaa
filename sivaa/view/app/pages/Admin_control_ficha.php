<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
require_once("../../../model/modelo_administrador.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Control Ambientes</title>
	<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
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
			$("#regional").change(function () {
				$('#sede').find('option').remove().end().append('<option value=""></option>').val('');
				$('#ambiente').find('option').remove().end().append('<option value=""></option>').val('');
				$("#regional option:selected").each(function () {
					id_region = $(this).val();
					$.post("../../../controller/controlador_administrador.php", { id_region: id_region, cascada: 1, opcion: 1 }, function(data){
						$("#centro").html(data);
					});
				});
			})

			$("#centro").change(function () {
				$("#centro option:selected").each(function () {
					id_centro = $(this).val();
					$.post("../../../controller/controlador_administrador.php", { id_centro: id_centro, cascada: 2, opcion: 1 }, function(data){
						$("#sede").html(data);
					});
				});
			})

			$("#sede").change(function () {
				$("#sede option:selected").each(function () {
					id_sede = $(this).val();
					$.post("../../../controller/controlador_administrador.php", { id_sede: id_sede, cascada: 3, opcion: 1 }, function(data){
						$("#ambiente").html(data);
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
							<h3>Gestion Fichas</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ficha">Crear ficha</button>
							<div class="modal fade" id="ficha" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12"><br>
													<form action="../../../controller/controlador_administrador.php" method="POST">
														<div class="form-group">
															<div class="modal-header">
	                                                          <h4 class="modal-title">Control Fichas</h4>
															</div>
															<br>
															<label>Nombre Regional</label>
															<select id="regional" name="regional" class="form-control" required>
																<option value="">Seleccione regional</option>
																<?php
																	$region_act = new consultas_admin();
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
															<label>Jornada</label>
															<select id="jornada" name="jornada" class="form-control" required>
																<option value="">Seleccione Jornada</option>
																<?php
																	$jornada_act = new consultas_admin();
																	$jornada_activo = $jornada_act->select_jornada(1);

																	foreach ($jornada_activo as $jornada) {
																		echo "<option value='" . $jornada['id_jornada'] . "'>" . utf8_encode($jornada['nombre_jornada']) . "</option>";
																	}
																?>
															</select>
															<br>
															<label>Nombre Programa</label>
															<select id="programa" name="programa" class="form-control" required>
																<option value="">Seleccione Programa</option>
																<?php
																	$programa_act = new consultas_admin();
																	$programa_activo = $programa_act->select_programa(1);

																	foreach ($programa_activo as $programa) {
																		echo "<option value='" . $programa['id_programa'] . "'>" . utf8_encode($programa['nombre_programa']) . "</option>";
																	}
																?>
															</select>
															<br>
															<label>Numero Ficha</label>
															<input class="form-control" name="num_ficha" placeholder="Ingrese el numero de Ficha" required>
															<input type="hidden" name="vacio_ficha" value="1">
														</div>
														<input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
															<a  data-toggle="modal" data-target="#crear_masivos" >Crear Masivos</a>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="crear_masivos" role="dialog">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-body">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12">
												<script type="text/javascript">
													function cargarHojaExcel(){
											            if(document.frmcargararchivo.ficha_masivo.value==""){
											              alert("Debe seleccionar un archivo");
											              document.frmcargararchivo.ficha_masivo.focus();
											              return false;
											            }   
											            document.frmcargararchivo.action = "../../../controller/controlador_cargue_masivo.php";
											            document.frmcargararchivo.submit();
											          }
												</script>
												<!-- Modal content-->
											        <div class="modal-header">
											          <button type="button" class="close" data-dismiss="modal">&times;</button>
											          <h4 class="modal-title">Subir archivo con Fichas.</h4>
											        </div>
										          <div class="modal-body">
										            <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
										              <p>Seleccione el archivo (.csv) para Subir (Numero_ficha,sede,Ambiente,Jornada,programa)</p>
										              <p><input type="file" name="ficha_masivo" id="ficha_masivo" /></p>
										              <button type="submit"  class="btn btn-success"  onclick="cargarHojaExcel();" >subir</button>
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
																			<th>Editar</th>
																			<th>Inactivar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$ficha_act = new consultas_admin();
																			$ficha_activa = $ficha_act->select_ficha(1);

																			foreach ($ficha_activa as $valores_activos) {
																				$valores_activos['id_ficha'];
																				$valores_activos['id_sede'];
																				$valores_activos['id_centro'];
																				$valores_activos['id_ambiente'];
																				$valores_activos['id_jornada'];
																				$valores_activos['id_programa'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['nombre_centro'] ?></td>
																				<td><?php echo $valores_activos['nombre_sede'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_programa']) ?></td>
																				<td><?php echo $valores_activos['numero_ambiente'] ?></td>
																				<td><?php echo $valores_activos['nombre_jornada'] ?></td>
																				<td><?php echo $valores_activos['numero_ficha'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar<?php echo $valores_activos['id_ficha']?>"><i class="fa fa-pencil-square-o"></i></button>
																				</td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#elimina<?php echo $valores_activos['id_ficha'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																				<script language="javascript">
																					$(document).ready(function(){
																						$("#sede<?php echo $valores_activos['id_ficha'] ?>").change(function () {                
																							$("#sede<?php echo $valores_activos['id_ficha'] ?> option:selected").each(function () {
																								id_sede = $(this).val();
																								$.post("../../../controller/controlador_administrador.php", { id_sede: id_sede, cascada: 3, opcion: 1 }, function(data){
																									$("#ambiente<?php echo $valores_activos['id_ficha'] ?>").html(data);
																								});            
																							});
																						})
																					});
																				</script>
																				<div class="modal fade" id="editar<?php echo $valores_activos['id_ficha'] ?>" role="dialog">
																					<div class="modal-dialog modal-md">
																						<div class="modal-content">
																							<div class="modal-body">
																								<div class="panel-body">
																									<div class="row">
																										<div class="col-lg-12">
																											<form action="../../../controller/controlador_administrador.php" method="POST">
																												<div class="form-group">
																												   <div class="modal-header">
															                                                        <h4 class="modal-title">Control Fichas</h4>
																												   </div>
																													<br>
																													<label>Nombre Centro</label>
																													<input class="form-control" name="centro" value="<?php echo $valores_activos['nombre_centro'] ?>" disabled>
																													<br>
																													<label>Nombre Sede</label>
																													<select id="sede<?php echo $valores_activos['id_ficha'] ?>" name="sede" class="form-control" required>
																														<option value="<?php echo $valores_activos['id_sede'] ?>"><?php echo utf8_encode($valores_activos['nombre_sede']) ?></option>
																														<?php
																															$sede_act = new consultas_admin();
																															$sede_activa = $sede_act->select_sede_ficha($valores_activos['id_centro']);

																															foreach ($sede_activa as $valor_sede) {
																																if ($valores_activos['id_sede'] == $valor_sede['id_sede']) {

																																} else {
																																	echo "<option value=" . $valor_sede['id_sede'] . ">" . utf8_encode($valor_sede['nombre_sede']) . "</option>";
																																}
																															}
																														?>
																													</select>
																													<br>
																													<label>Numero Ambiente</label>
																													<select id="ambiente<?php echo $valores_activos['id_ficha'] ?>" name="ambiente" class="form-control" required>
																														<option value="<?php echo $valores_activos['id_ambiente'] ?>"><?php echo $valores_activos['numero_ambiente'] ?></option>
																														<?php
																															$ambiente_act = new consultas_admin();
																															$ambiente_activo = $ambiente_act->select_ambiente_ficha($valores_activos['id_sede']);

																															foreach ($ambiente_activo as $valor_ambiente) {
																																if ($valores_activos['id_ambiente'] == $valor_ambiente['id_ambiente']) {

																																} else {
																																	echo "<option value=" . $valor_ambiente['id_ambiente'] . ">" . $valor_ambiente['numero_ambiente'] . "</option>";
																																}
																															}
																														?>
																													</select>
																													<br>
																													<label>Jornada</label>
																													<select id="jornada" name="jornada" class="form-control" required>
																														<option value="<?php echo $valores_activos['id_jornada'] ?>"><?php echo $valores_activos['nombre_jornada'] ?></option>
																														<?php
																															$jornada_act = new consultas_admin();
																															$jornada_activo = $jornada_act->select_jornada(1);

																															foreach ($jornada_activo as $jornada) {
																																if ($valores_activos['id_jornada'] == $jornada['id_jornada']) {

																																} else {
																																	echo "<option value='" . $jornada['id_jornada'] . "'>" . utf8_encode($jornada['nombre_jornada']) . "</option>";
																																}

																															}
																														?>
																													</select>
																													<br>
																													<label>Nombre Programa</label>
																													<select id="programa" name="programa" class="form-control" required>
																														<option value="<?php echo $valores_activos['id_programa'] ?>"><?php echo utf8_encode($valores_activos['nombre_programa']) ?></option>
																														<?php
																															$programa_act = new consultas_admin();
																															$programa_activo = $programa_act->select_programa(1);

																															foreach ($programa_activo as $programa) {
																																if ($valores_activos['id_programa'] == $programa['id_programa']) {

																																} else {
																																	echo "<option value='" . $programa['id_programa'] . "'>" . utf8_encode($programa['nombre_programa']) . "</option>";
																																}
																															}
																														?>
																													</select>
																													<br>
																													<label>Numero Ficha</label>
																													<input class="form-control" name="num_ficha" value="<?php echo $valores_activos['numero_ficha'] ?>" required>
																													<input type="hidden" name="id_ficha" value="<?php echo $valores_activos['id_ficha'] ?>">
																													<input type="hidden" name="vacio_ficha" value="2">
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
																				<div class="modal fade" id="elimina<?php echo $valores_activos['id_ficha'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<form action="../../../controller/controlador_administrador.php" method="POST">
																								<div class="modal-body" style="text-align: center;">
																									<h3>Inactivar la ficha</h3><br>
																									<input type="hidden" name="id_ficha" value="<?php echo $valores_activos['id_ficha']?>">
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
																			$ficha_act = new consultas_admin();
																			$ficha_activa = $ficha_act->select_ficha(0);

																			foreach ($ficha_activa as $valores_activos) {
																				$valores_activos['id_ficha'];
																				$valores_activos['id_sede'];
																				$valores_activos['id_centro'];
																				$valores_activos['id_ambiente'];
																				$valores_activos['id_jornada'];
																				$valores_activos['id_programa'];
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['nombre_centro'] ?></td>
																				<td><?php echo $valores_activos['nombre_sede'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_programa']) ?></td>
																				<td><?php echo $valores_activos['numero_ambiente'] ?></td>
																				<td><?php echo $valores_activos['nombre_jornada'] ?></td>
																				<td><?php echo $valores_activos['numero_ficha'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#activa<?php echo $valores_activos['id_ficha'] ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																				<div class="modal fade" id="activa<?php echo $valores_activos['id_ficha'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<form action="../../../controller/controlador_administrador.php" method="POST">
																								<div class="modal-body" style="text-align: center;">
																									<h3>Activar la ficha</h3><br>
																									<input type="hidden" name="id_ficha" value="<?php echo $valores_activos['id_ficha']?>">
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