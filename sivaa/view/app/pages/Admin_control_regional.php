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
	<title>Control Regionales</title>
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
					<h1 class="page-header">Control Regionales</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Gestion Regionales</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#region">Crear region</button>
							<div class="modal fade" id="region" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12">
													<form action="../../../controller/controlador_administrador.php" method="POST">
														<div class="form-group">
														   <div class="modal-header">
	                                                        <h4 class="modal-title">Control Regionales</h4>
															</div>
															<br>
															<label>Codigo Regional</label>
															<input class="form-control" name="cod_regional" id="cod_regional" autofocus="" placeholder="Ingrese el codigo de la regional" required>
															<br>
															<label>Nombre Regional</label>
															<input class="form-control" name="nom_regional" id="nom_regional" placeholder="Ingrese el nombre de la regional" required>
															<input type="hidden" name="vacio_regional" value="1">
														</div>
														<input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
															<a  data-toggle="modal" data-target="#crear_masivos" >Crear Masivos</a>
															<br>
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
											            if(document.frmcargararchivo.regional_masivo.value==""){
											              alert("Debe seleccionar un archivo");
											              document.frmcargararchivo.regional_masivo.focus();
											              return false;
											            }   
											            document.frmcargararchivo.action = "../../../controller/controlador_cargue_masivo.php";
											            document.frmcargararchivo.submit();
											          }
												</script>
												<!-- Modal content-->
											        <div class="modal-header">
											          <button type="button" class="close" data-dismiss="modal">&times;</button>
											          <h4 class="modal-title">Subir archivos con Regionales.</h4>
											        </div>
										          <div class="modal-body">
										            <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
										              <p>Seleccione el archivo (.csv) para Subir (Codigo_Regional,Nombre_Regional) </p>
										              <p><input type="file" name="regional_masivo" id="regional_masivo" /></p>
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
								<div class="wrapper wrapper-content animated fadeInRight">
							        <div class="row">
							            <div class="col-lg-12">
							                <div class="ibox float-e-margins">
							                    <div class="ibox-content">
							                        <div class="table-responsive">
														<table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
															<thead>
																<tr>
																	<th>Nombre Regional</th>
																	<th>Codigo Regional</th>
																	<th>Editar</th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$regional_act = new consultas_admin();
																	$regional_activa = $regional_act->select_regional(1);

																	foreach ($regional_activa as $valores_activos) {
																		$valores_activos['id_regional'];
																?>
																	<tr class="odd gradeX">
																		<td><?php echo $valores_activos['nombre_regional'] ?></td>
																		<td><?php echo $valores_activos['cod_regional'] ?></td>
																		<td>
																			<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar<?php echo $valores_activos['id_regional']?>"><i class="fa fa-pencil-square-o"></i></button>
																		</td>
																	</tr>
																	<div class="modal fade" id="editar<?php echo $valores_activos['id_regional']?>" role="dialog">
																		<div class="modal-dialog modal-md">
																			<div class="modal-content">
																				<div class="panel-body">
																					<div class="row">
																						<div class="col-lg-12"><br>
																							<form action="../../../controller/controlador_administrador.php" method="POST">
																								<div class="form-group">
																									<label>Nombre Regional</label>
																									<input class="form-control" name="nom_regional" value="<?php echo $valores_activos['nombre_regional']?>" required>
																									<input type="hidden" name="id_regional" value="<?php echo $valores_activos['id_regional']?>">
																									<input type="hidden" name="vacio_regional" value="2">
																								</div>
																								<input type="submit" class="btn btn-success" value="Guardar" name="btn_regional">
																								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																							</form>
																						</div>
																					</div>
																				</div>
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
	
	<script src="/sivaa/view/app/js/validate/jquery.validate.js"></script>
	<script>
		$().ready(function () {
			$("#registro").validate({
				rules: {
					cod_regional: {
						required: true,
						minlength: 3
					},

					nom_regional: {
						required: true,
						minlength: 3
					}
				},
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#tabla').DataTable({
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