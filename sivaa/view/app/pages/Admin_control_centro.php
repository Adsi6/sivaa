<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
require_once("../../../model/modelo_administrador.php");

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
	<title>Control Centros</title>
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
					<h1 class="page-header">Control Centros</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Gestion Centros</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#centro">Crear centro</button>
							<div class="modal fade" id="centro" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-body">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<form action="../../../controller/controlador_administrador.php" method="POST">
															<div class="form-group">
																<div class="modal-header">
																<h4 class="modal-title">Control Centros</h4>
															    </div>
																<br>
	                                                                <label>Nombre Regional</label>
																<select class="form-control" name="cod_regional" required>
																	<option value="">Seleccione una Region</option>
																	<?php
																		$regional_act = new consultas_admin();
																		$regional_activa = $regional_act->select_regional(1);

																		foreach ($regional_activa as $regional) {
																			echo "<option value='" . $regional['id_regional'] . "'>" . $regional['nombre_regional'] . " | " . $regional['cod_regional'] . "</option>";
																		}
																	?>
																</select>
																<br>
                               									 <label>Codigo Centro</label>
																<input class="form-control" name="cod_centro" placeholder="Ingrese el codigo del centro" required>
																<br>
                                								<label>Nombre Centro</label>
																<input class="form-control" name="nom_centro" placeholder="Ingrese el nombre del centro" required>
																<input type="hidden" name="vacio_centro" value="1">
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
											            if(document.frmcargararchivo.centros_masivo.value==""){
											              alert("Debe seleccionar un archivo");
											              document.frmcargararchivo.centros_masivo.focus();
											              return false;
											            }   
											            document.frmcargararchivo.action = "../../../controller/controlador_cargue_masivo.php";
											            document.frmcargararchivo.submit();
											          }
												</script>
												<!-- Modal content-->
											        <div class="modal-header">
											          <button type="button" class="close" data-dismiss="modal">&times;</button>
											          <h4 class="modal-title">Subir archivo con Centros.</h4>
											        </div>
										          <div class="modal-body">
										            <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
										              <p>Seleccione el archivo (.csv) para Subir (Codigo_centro,Nombre_centro,Codigo_Regional)</p>
										              <p><input type="file" name="centros_masivo" id="centros_masivo" /></p>
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
														<th>Regional</th>
														<th>Nombre Centro</th>
														<th>Codigo Centro</th>
														<th>Editar</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$centro_act = new consultas_admin();
														$centro_activa = $centro_act->select_centro(1);

														foreach ($centro_activa as $valores_activos) {
															$valores_activos['id_centro'];
													?>
														<tr class="odd gradeX">
															<td><?php echo $valores_activos['nombre_regional'] . " | " . $valores_activos['cod_regional'] ?></td>
															<td><?php echo $valores_activos['nombre_centro'] ?></td>
															<td><?php echo $valores_activos['cod_centro'] ?></td>
															<td>
																	<button type="submit" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar<?php echo $valores_activos['id_centro']?>"><i class="fa fa-pencil-square-o"></i></button>
															</td>
														</tr>
                            <div class="modal fade" id="editar<?php echo $valores_activos['id_centro']?>" role="dialog">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="panel-body">
                                    <div class="row">
                                      <div class="col-lg-12"><br>
                                        <form action="../../../controller/controlador_administrador.php" method="POST">
                                          <div class="form-group">
                                            <label>Nombre Centro</label>
                                            <input class="form-control" name="nom_centro" value="<?php echo $valores_activos['nombre_centro']?>" required>
                                            <input type="hidden" name="id_centro" value="<?php echo $valores_activos['id_centro']?>">
                                            <input type="hidden" name="vacio_centro" value="2">
                                          </div>
                                          <input type="submit" class="btn btn-success" value="Guardar" name="btn_centro">
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