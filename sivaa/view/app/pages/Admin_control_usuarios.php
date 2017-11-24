<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
session_start();
if ($_SESSION['nombre_rol'] != "Administrador") {
    header("location:/sivaa/index.php");
}

error_reporting(0);
require_once("../../../model/modelo_administrador.php");

if ($_GET['update']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Usuario Modificado');
		  </script>";
}

if ($_GET['insert']) {
	echo "<script language='JavaScript' type='text/javascript'>
			alert('Usuario creado');
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
	<title>Control Usuarios</title>
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

	<script language=Javascript>
		function justNumbers(e) {
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
				return true;
				return /\d/.test(String.fromCharCode(keynum));
		}
   </script>

   <script>
		$(document).ready(function(){
			$("#btn_1").click(function(){
				$("#mostrar_2").hide();
				$("#mostrar_3").hide();
				$("#mostrar_1").show();
			});

			$("#btn_2").click(function(){
				$("#mostrar_1").hide();
				$("#mostrar_3").hide();
				$("#mostrar_2").show();
			});

			$("#btn_3").click(function(){
				$("#mostrar_1").hide();
				$("#mostrar_2").hide();
				$("#mostrar_3").show();
			});
		});
	</script>

	<script language="javascript">
		$(document).ready(function(){
			$("#regional").change(function () {                
				$("#regional option:selected").each(function () {
					id_region = $(this).val();
					$.post("../../../controller/controlador_administrador.php", { id_region: id_region, cascada: 1, opcion: 1 }, function(data){
						$("#centro").html(data);
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
					<h1 class="page-header">Control Usuarios</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Lista de usuarios</h3>

							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#usuario">Crear Usuario</button>

							<div class="modal fade" id="usuario" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-body">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<form action="../../../controller/controlador_administrador.php" method="POST" id="crear_user">
															<div class="modal-header">
																<h4 class="modal-title">Creación de Usuario</h4>
															</div>
															<div class="form-group">
																<br>
																<label for="documento">Documento</label>
																<input class="form-control" name="documento" id="documento" autofocus="" maxlength="12" onkeypress="return justNumbers(event);" placeholder="Ingrese el numero de documento" required>
																<br>
																<label for="regional">Regional</label>
																<select class="form-control" name="regional" id="regional" required>
																	<option value="">Seleccione la Regional</option>
																	<?php
																		$region_act = new consultas_admin();
																		$region_activo = $region_act->select_regional(1);

																		foreach ($region_activo as $region) {
																			echo "<option value='" . $region['id_regional'] . "'>" . $region['nombre_regional'] . "</option>";
																		}
																	?>
																</select>
																<br>
																<label for="centro">Centro</label>
																<select id="centro" name="centro" class="form-control" required>
																	<option value="">Seleccione centro</option>
																</select>
																<br>
																<label for="perfil">Perfil</label>
																<select class="form-control" name="perfil" id="perfil" required>
																	<option value=''>Selecione el prefil</option>
																	<?php
																		$perfil = new consultas_admin();
																		$perfil_activo = $perfil->roles();

																		foreach ($perfil_activo as $valor_perfil) {
																			echo "<option value='".$valor_perfil['id_rol']."'>".$valor_perfil['nombre_rol']."</option>";
																		}
																	?> 
																</select>
																<input type="hidden" name="crear_usuario" value="1">
															</div>
															<input type="submit" class="btn btn-success" value="Guardar" name="btn_guardar">
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
												            if(document.frmcargararchivo.usuario_masivo.value==""){
												              alert("Debe seleccionar un archivo");
												              document.frmcargararchivo.usuario_masivo.focus();
												              return false;
												            }   
												            document.frmcargararchivo.action = "../../../controller/controlador_cargue_masivo.php";
												            document.frmcargararchivo.submit();
												          }
													</script>
													<!-- Modal content-->
												        <div class="modal-header">
												          <button type="button" class="close" data-dismiss="modal">&times;</button>
												          <h4 class="modal-title">Subir archivos con Usuario.</h4>
												        </div>
												          <div class="modal-body">
												            <form name="frmcargararchivo" method="post" enctype="multipart/form-data">
												              <p>Seleccione el archivo (.csv) para Subir (Cedula,Codigo_centro,Rol) </p>
												              <p><input type="file" name="usuario_masivo" id="usuario_masivo" /></p>
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
						<div class="modal fade" id="<?php echo $valores_activos['cedula'] ?>" role="dialog">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<form action="../../../controller/controlador_administrador.php" method="POST">
										<div class="modal-body" style="text-align: center;">
											<h3>Inactivar el usuario</h3><br>
											<input type="hidden" name="documento" value="<?php echo $valores_activos['cedula']?>">
											<input type="hidden" name="opcion" value="0">
											<input type="hidden" name="elimina_usuario" value="1">
											<button type="submit" class="btn btn-success">Confirmar</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">                                    
									<button id="btn_1" name="btn_1" class="btn btn-default">Usuarios Activos</button>
									<button id="btn_2" name="btn_2" class="btn btn-default">Usuarios Inactivos</button>
									<button id="btn_3" name="btn_3" class="btn btn-default">Usuarios pendientes</button>

									<div id="mostrar_1">
										<div class="wrapper wrapper-content animated fadeInRight">
									        <div class="row">
									            <div class="col-lg-12">
									                <div class="ibox float-e-margins">
									                    <div class="ibox-content">
									                        <div class="table-responsive">
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_activos" style="text-align: center;">
																 	<!--<table width="100%" class="table table-striped table-bordered table-hover dataTables-example" id="tabla_activos" style="text-align: center;">-->
																	<thead>
																		<tr>
																			<th>Documento</th>
																			<th>Nombre</th>
																			<th>Apellido</th>
																			<th>Correo</th>
																			<th>Sexo</th>
																			<th>Direccion</th>
																			<th>Telefono</th>
																			<th>Centro</th>
																			<th>Perfil</th>
																			<th>Editar</th>
																			<th>Inactivar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$usuarios_act = new consultas_admin();
																			$usuarios_activos = $usuarios_act->usuarios(1);

																			foreach ($usuarios_activos as $valores_activos) {
																				if ($valores_activos['sexo'] == "M") {
																					$valor_sexo = "Masculino";
																				} else {
																					$valor_sexo = "Femenino";
																				}
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['cedula'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['apellido']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['correo']) ?></td>
																				<td><?php echo $valor_sexo ?></td>
																				<td><?php echo utf8_encode($valores_activos['direccion']) ?></td>
																				<td><?php echo $valores_activos['telefono'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_centro']) ?></td>
																				<td><?php echo $valores_activos['nombre_rol'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar<?php echo $valores_activos['cedula'] ?>"><i class="fa fa-pencil-square-o"></i></button>
																				</td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#<?php echo $valores_activos['cedula'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
																				</td>
																			</tr>
																				<script language="javascript">
																					$(document).ready(function(){
																						$("#regional<?php echo $valores_activos['cedula'] ?>").change(function () {                
																							$("#regional<?php echo $valores_activos['cedula'] ?> option:selected").each(function () {
																								id_region = $(this).val();
																								$.post("../../../controller/controlador_administrador.php", { id_region: id_region, cascada: 1, opcion: 1 }, function(data){
																									$("#centro<?php echo $valores_activos['cedula'] ?>").html(data);
																								});            
																							});
																						})
																					});
																				</script>
																				<div class="modal fade" id="editar<?php echo $valores_activos['cedula'] ?>" role="dialog">
																					<div class="modal-dialog modal-md">
																						<div class="modal-content">
																							<div class="modal-body">
																								<div class="panel-body">
																									<div class="row">
																										<div class="col-lg-12">
																											<form action="../../../controller/controlador_administrador.php" method="POST" id="edita_user">
																												<div class="modal-header">
																													<h4 class="modal-title">Editar Usuario</h4>
																												</div>
																												<div class="form-group">
																													<br>
																													<label for="documento">Documento</label>
																													<input class="form-control" name="documento" id="documento" value="<?php echo $valores_activos['cedula'] ?>" disabled required>
																													<br>
																													<label for="regional">Regional</label>
																													<select class="form-control" name="regional" id="regional<?php echo $valores_activos['cedula'] ?>" required>
																														<option value="<?php echo $valores_activos['id_regional'] ?>"><?php echo utf8_encode($valores_activos['nombre_regional']) ?></option>
																														<?php
																															$region_act = new consultas_admin();
																															$region_activo = $region_act->select_regional(1);

																															foreach ($region_activo as $region) {
																																echo "<option value='" . $region['id_regional'] . "'>" . $region['nombre_regional'] . "</option>";
																															}
																														?>
																													</select>
																													<br>
																													<label for="centro">Centro</label>
																													<select id="centro<?php echo $valores_activos['cedula'] ?>" name="centro" class="form-control" required>
																														<option value="<?php echo $valores_activos['id_centro'] ?>"><?php echo utf8_encode($valores_activos['nombre_centro']) ?></option>
																													</select>
																													<br>
																													<label for="perfil">Perfil</label>
																													<select class="form-control" name="perfil" id="perfil" required>
																														<option value="<?php echo $valores_activos['id_rol'] ?>"><?php echo $valores_activos['nombre_rol'] ?></option>
																														<?php
																															$perfil = new consultas_admin();
																															$perfil_activo = $perfil->roles();
																															foreach ($perfil_activo as $valor_perfil) {
																																if ($valores_activos['id_rol'] == $valor_perfil['id_rol']) {

																																} else {
																																	echo "<option value='".$valor_perfil['id_rol']."'>".$valor_perfil['nombre_rol']."</option>";
																																}
																															}
																														?> 
																													</select>
																													<input type="hidden" name="editar_usuario" value="1">
																													<input type="hidden" name="cedula" value="<?php echo $valores_activos['cedula'] ?>">
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
																				<div class="modal fade" id="<?php echo $valores_activos['cedula'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<form action="../../../controller/controlador_administrador.php" method="POST">
																								<div class="modal-body" style="text-align: center;">
																									<h3>Inactivar el usuario</h3><br>
																									<input type="hidden" name="documento" value="<?php echo $valores_activos['cedula']?>">
																									<input type="hidden" name="opcion" value="0">
																									<input type="hidden" name="elimina_usuario" value="1">
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
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_inactivos" style="text-align: center;">
																	<thead>
																		<tr>
																			<th>Documento</th>
																			<th>Nombre</th>
																			<th>Apellido</th>
																			<th>Correo</th>
																			<th>Sexo</th>
																			<th>Direccion</th>
																			<th>Telefono</th>
																			<th>Centro</th>
																			<th>Perfil</th>
																			<th>Activar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$usuarios_act = new consultas_admin();
																			$usuarios_activos = $usuarios_act->usuarios(0);

																			$valores_activos['id_regional'];
																			$valores_activos['nombre_regional'];
																			$valores_activos['id_centro'];
																			$valores_activos['id_rol'];

																			foreach ($usuarios_activos as $valores_activos) {
																				if ($valores_activos['sexo'] == "M") {
																					$valor_sexo = "Masculino";
																				} else {
																					$valor_sexo = "Femenino";
																				}
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['cedula'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['apellido']) ?></td>
																				<td><?php echo utf8_encode($valores_activos['correo']) ?></td>
																				<td><?php echo $valor_sexo ?></td>
																				<td><?php echo utf8_encode($valores_activos['direccion']) ?></td>
																				<td><?php echo $valores_activos['telefono'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_centro']) ?></td>
																				<td><?php echo $valores_activos['nombre_rol'] ?></td>
																				<td><button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#<?php echo $valores_activos['cedula'] ?>"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></td>
																			</tr>
																			<div class="modal fade" id="<?php echo $valores_activos['cedula'] ?>" role="dialog">
																				<div class="modal-dialog modal-sm">
																					<div class="modal-content">
																						<form action="../../../controller/controlador_administrador.php" method="POST">
																							<div class="modal-body" style="text-align: center;">
																								<h3>Activar el registro</h3><br>
																								<input type="hidden" name="documento" value="<?php echo $valores_activos['cedula']?>">
																								<input type="hidden" name="opcion" value="1">
																								<input type="hidden" name="elimina_usuario" value="1">
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

									<div id="mostrar_3" style="display: none;">
										<div class="wrapper wrapper-content animated fadeInRight">
									        <div class="row">
									            <div class="col-lg-12">
									                <div class="ibox float-e-margins">
									                    <div class="ibox-content">
									                        <div class="table-responsive">
																<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_pendientes" style="text-align: center;">
																	<thead>
																		<tr>
																			<th>Documento</th>
																			<th>Fecha Creación</th>
																			<th>Centro</th>
																			<th>Perfil</th>
																			<th>Editar</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$usuarios_act = new consultas_admin();
																			$usuarios_activos = $usuarios_act->usuarios_pendientes(0);

																			$valores_activos['id_regional'];
																			$valores_activos['nombre_regional'];
																			$valores_activos['id_centro'];
																			$valores_activos['id_rol'];

																			foreach ($usuarios_activos as $valores_activos) {
																		?>
																			<tr class="odd gradeX">
																				<td><?php echo $valores_activos['cedula'] ?></td>
																				<td><?php echo $valores_activos['fecha'] ?></td>
																				<td><?php echo utf8_encode($valores_activos['nombre_centro']) ?></td>
																				<td><?php echo $valores_activos['nombre_rol'] ?></td>
																				<td>
																					<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#editar_2<?php echo $valores_activos['cedula'] ?>"><i class="fa fa-pencil-square-o"></i></button>
																				</td>
																			</tr>
																			<script language="javascript">
																				$(document).ready(function(){
																					$("#regional<?php echo $valores_activos['cedula'] ?>").change(function () {                
																						$("#regional<?php echo $valores_activos['cedula'] ?> option:selected").each(function () {
																							id_region = $(this).val();
																							$.post("../../../controller/controlador_administrador.php", { id_region: id_region, cascada: 1, opcion: 1 }, function(data){
																								$("#centro<?php echo $valores_activos['cedula'] ?>").html(data);
																							});            
																						});
																					})
																				});
																			</script>
																			<div class="modal fade" id="editar_2<?php echo $valores_activos['cedula'] ?>" role="dialog">
																				<div class="modal-dialog modal-md">
																					<div class="modal-content">
																						<div class="modal-body">
																							<div class="panel-body">
																								<div class="row">
																									<div class="col-lg-12">
																										<form action="../../../controller/controlador_administrador.php" method="POST" id="edita">
																											<div class="modal-header">
																												<h4 class="modal-title">Editar Usuario</h4>
																											</div>
																											<div class="form-group">
																												<br>
																												<label for="documento" >Documento</label>
																												<input class="form-control" name="documento" id="documento" autofocus="" value="<?php echo $valores_activos['cedula'] ?>" disabled>
																												<br>
																												<label for="regional" >Regional</label>
																												<select class="form-control" name="regional" id="regional<?php echo $valores_activos['cedula'] ?>" required>
																													<option value="<?php echo $valores_activos['id_regional'] ?>"><?php echo utf8_encode($valores_activos['nombre_regional']) ?></option>
																													<?php
																														$region_act = new consultas_admin();
																														$region_activo = $region_act->select_regional(1);

																														foreach ($region_activo as $region) {
																															echo "<option value='" . $region['id_regional'] . "'>" . $region['nombre_regional'] . "</option>";
																														}
																													?>
																												</select>
																												<br>
																												<label for="centro">Centro</label>
																												<select id="centro<?php echo $valores_activos['cedula'] ?>" name="centro" class="form-control" required>
																													<option value="<?php echo $valores_activos['id_centro'] ?>"><?php echo utf8_encode($valores_activos['nombre_centro']) ?></option>
																												</select>
																												<br>
																												<label for="perfil">Perfil</label>
																												<select class="form-control" name="perfil" id="perfil" required>
																													<option value="<?php echo $valores_activos['id_rol'] ?>"><?php echo $valores_activos['nombre_rol'] ?></option>
																													<?php
																														$perfil = new consultas_admin();
																														$perfil_activo = $perfil->roles();
																														foreach ($perfil_activo as $valor_perfil) {
																															if ($valores_activos['id_rol'] == $valor_perfil['id_rol']) {

																															} else {
																																echo "<option value='".$valor_perfil['id_rol']."'>".$valor_perfil['nombre_rol']."</option>";
																															}
																														}
																													?> 
																												</select>
																												<input type="hidden" name="editar_usuario" value="1">
																												<input type="hidden" name="cedula" value="<?php echo $valores_activos['cedula'] ?>">
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
			$("#crear_user").validate({
				rules: {
					documento: {
						required: true
					},

					regional: {
						required: true
					},

					centro: {
						required: true
					},

					perfil: {
						required: true
					}
				},
			});

			$("#edita_user").validate({
				rules: {
					documento: {
						required: true
					},

					regional: {
						required: true
					},

					centro: {
						required: true
					},

					perfil: {
						required: true
					}
				},
			});

			$("#edita").validate({
				rules: {
					documento: {
						required: true
					},

					regional: {
						required: true
					},

					centro: {
						required: true
					},

					perfil: {
						required: true
					}
				},
			});
		});
	</script>

	<script>
	$(document).ready(function() {

		$('#tabla_activos').DataTable({
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

        $('#tabla_inactivos').DataTable({
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

        $('#tabla_pendientes').DataTable({
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