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
	<title>Control Programas</title>
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
					<h1 class="page-header">Control Programas</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Gestion Programas</h3>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#programa">Crear programa</button>
							<div class="modal fade" id="programa" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12"><br>
													<form action="../../../controller/controlador_administrador.php" method="POST">
														<div class="form-group">
															<div class="modal-header">
	                                                        	<h4 class="modal-title">Control Programa</h4>
															</div>
															<br>
                              								<label>Acromimo</label>
															<input class="form-control" name="sigla" autofocus="" placeholder="Ingrese la sigla del programa" required>
															<br>
                             							    <label>Nombre del Programa</label>
															<input class="form-control" name="nom_programa" placeholder="Ingrese el nombre del programa" required>
															<input type="hidden" name="vacio_programa" value="1">
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
														<th>Acromimo</th>
														<th>Nombre Programa</th>
														<th>Editar</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$programa_act = new consultas_admin();
														$programa_activa = $programa_act->select_programa(1);

														foreach ($programa_activa as $valores_activos) {
															$valores_activos['id_programa'];
													?>
														<tr class="odd gradeX">
															<td><?php echo utf8_encode($valores_activos['siglas']) ?></td>
															<td><?php echo utf8_encode($valores_activos['nombre_programa']) ?></td>
															<td>
                                <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar<?php echo $valores_activos['id_programa']?>"><i class="fa fa-pencil-square-o"></i></button>
															</td>
														</tr>
                            <div class="modal fade" id="editar<?php echo $valores_activos['id_programa']?>" role="dialog">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="panel-body">
                                    <div class="row">
                                      <div class="col-lg-12"><br>
                                        <form action="../../../controller/controlador_administrador.php" method="POST">
                                          <div class="form-group">
                                            <label>Nombre Programa</label>
                                            <input class="form-control" name="nom_programa" value="<?php echo $valores_activos['nombre_programa']?>" required>
                                            <input type="hidden" name="id_programa" value="<?php echo $valores_activos['id_programa']?>">
                                            <input type="hidden" name="vacio_programa" value="2">
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