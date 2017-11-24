<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);
require_once("../../../model/modelo_resultado_encuesta.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Resultado encuestas</title>
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
    
    <link href="../vendor/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="../js/plugins/cropper/cropper.min.js"></script>
    <script src="../js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
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
					<h1 class="page-header">Resultados Encuesta</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="col-lg-7"><br>
                            	<div class="form-group">
                                    <form method="POST" action="">
                                    	<h4>Selecione un rango de fechas para generar los datos</h4><br>
                                        <div class="form-group" id="calendario_inicio" >
                                            <label class="col-sm-2 control-label">Fecha Inicio</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control" name="fecha_inicio" required >
                                            </div>
                                        </div>
                                        <div class="form-group" id="calendario_final" >
                                            <label class="col-sm-2 control-label">Fecha Final</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control" name="fecha_fin" required >
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-success" name="btn_respuesta" value="Generar">
                                    </form>
                                </div>
                            </div>
						</div>
						<div class="panel-body">
							<div class="row">
								<?php
									if (isset($_POST['btn_respuesta'])) {
										$fecha_inicio = $_POST['fecha_inicio'];
										$fecha_fin = $_POST['fecha_fin'];

										$respuestas = new Resultados();
										$total_respuestas = $respuestas->select_respuestas("2017-10-28", "2017-10-28");
								?>
								        <div class="row">
								            <div class="col-lg-12">
								                <div class="ibox float-e-margins">
								                    <div class="ibox-content">
								                        <div class="table-responsive">
															<table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
																<thead>
																	<tr>
																		<th>Regional</th>
																		<th>Centro</th>
																		<th>Sede</th>
																		<th>Ambiente</th>
																		<th>Ficha</th>
																		<th>Jornada</th>
																		<th>Programa</th>
																		<th>Pregunta</th>
																		<th>Respuesta</th>
																		<th>Fecha</th>
																		<th>Observación</th>
																		<th>Usuario</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		

																		foreach ($total_respuestas as $valores_activos) {
																	?>
																		<tr class="odd gradeX">
																			<td><?php echo utf8_encode($valores_activos['nombre_regional'] . " | " . $valores_activos['cod_regional']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['nombre_centro'] . " | " . $valores_activos['cod_centro']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['nombre_sede']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['numero_ambiente']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['numero_ficha']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['nombre_jornada']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['nombre_programa'] . " | " . $valores_activos['siglas']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['pregunta']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['respuesta']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['fecha']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['observacion']) ?></td>
																			<td><?php echo utf8_encode($valores_activos['nombre'] . " | " . $valores_activos['apellido']) ?></td>
																		</tr>
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
								<?php
									}
								?>
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
	<script>
        $(document).ready(function(){
            $('#calendario_inicio .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });
            $('#calendario_final .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });
        });
    </script>
</body>
</html>