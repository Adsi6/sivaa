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
    <title>Estadisticas</title>
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
    <!--<link href="../vendor/css/font-awesome.css" rel="stylesheet">-->



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
    <script>
        function habilitar(value)
        {
            if(value=="centro" )
            {
                document.getElementById('centro').style.display = "block";
                document.getElementById('sede').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('programa').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('jornada').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }else if(value=="sede" ){
                document.getElementById('sede').style.display = "block";
                document.getElementById('sede_1').style.display = "block";
                document.getElementById('centro').style.display = "none";
                document.getElementById('programa').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('jornada').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }else if(value=="programa" ){
                document.getElementById('programa').style.display = "block";
                document.getElementById('centro').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('sede').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('jornada').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }else if(value=="ambiente" ){
                document.getElementById('ambiente').style.display = "block";
                document.getElementById('sede_2').style.display = "block";
                document.getElementById('ambiente_1').style.display = "block";
                document.getElementById('programa').style.display = "none";
                document.getElementById('centro').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('sede').style.display = "none";
                document.getElementById('jornada').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }else if(value=="jornada" ){
                document.getElementById('jornada').style.display = "block";
                document.getElementById('programa').style.display = "none";
                document.getElementById('centro').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('sede').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }else if(value=="ficha" ){
                document.getElementById('ficha').style.display = "block";
                document.getElementById('programa').style.display = "none";
                document.getElementById('centro').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('sede').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('jornada').style.display = "none";
            }else{
                document.getElementById('centro').style.display = "none";
                document.getElementById('sede_1').style.display = "none";
                document.getElementById('sede').style.display = "none";
                document.getElementById('programa').style.display = "none";
                document.getElementById('ambiente').style.display = "none";
                document.getElementById('sede_2').style.display = "none";
                document.getElementById('ambiente_1').style.display = "none";
                document.getElementById('jornada').style.display = "none";
                document.getElementById('ficha').style.display = "none";
            }
        }
    </script>
    <script language="javascript">
    $(document).ready(function(){
            $("#sede").change(function () {
                $("#sede option:selected").each(function () {
                    id_centro = $(this).val();
                    $.post("../../../controller/controlador_administrador.php", { id_centro: id_centro, cascada: 2, opcion: 1 }, function(data){
                        $("#sede_1").html(data);
                    });            
                });
            })
        });
  </script>
  <script type="text/javascript">
      $(document).ready(function(){
            $("#ambiente").change(function () {
                $("#ambiente option:selected").each(function () {
                    id_centro = $(this).val();
                    $.post("../../../controller/controlador_administrador.php", { id_centro: id_centro, cascada: 2, opcion: 1 }, function(data){
                        $("#sede_2").html(data);
                    });            
                });
            })

             $("#sede_2").change(function () {
                $("#sede_2 option:selected").each(function () {
                    id_sede = $(this).val();
                    $.post("../../../controller/controlador_administrador.php", { id_sede: id_sede, cascada: 3, opcion: 1 }, function(data){
                        $("#ambiente_1").html(data);
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
                    <h1 class="page-header">Estadisticas <?php echo $_SESSION['nombre_rol']?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-heading">
                                    <div class="col-lg-7"><br>
                                        <div class="form-group">
                                            <form method="POST" action="">
                                                <label>Filtrar informacion por:</label>
                                                    <select id="select_filtro" name="select_filtro" class="form-control" onchange="habilitar(this.value);" required >
                                                        <option value="">Seleccione un filtro</option>
                                                        <option value="centro">Centro</option>
                                                        <option value="sede">Sede</option>
                                                        <option value="programa">Programa</option>
                                                        <option value="ambiente">Ambiente</option>
                                                        <option value="jornada">Jornada</option>
                                                        <option value="ficha">Ficha</option>
                                                    </select><br>
                                                    <div>
                                                        <select class="form-control" name="centro" id="centro" style="display: none;" required>
                                                            <option value="0">Seleccione el centro</option>
                                                                <?php
                                                                  $centro_act = new consultas_admin();
                                                                  $centro_activo = $centro_act->select_centro(1);

                                                                  foreach ($centro_activo as $centro) {
                                                                    echo "<option value='" . $centro['id_centro'] . "'>" . $centro['nombre_centro'] . " | " . $centro['cod_centro'] . "</option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        <select class="form-control" name="sede" id="sede" style="display: none;" required>
                                                            <option value="0">Seleccione el Centro</option>
                                                                <?php
                                                                  $centro_act = new consultas_admin();
                                                                  $centro_activo = $centro_act->select_centro(1);

                                                                  foreach ($centro_activo as $centro) {
                                                                    echo "<option value='" . $centro['id_centro'] . "'>" . $centro['nombre_centro'] . " | " . $centro['cod_centro'] . "</option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        <select id="sede_1" name="sede_1" class="form-control" style="display: none;" required>
                                                                <option value="0">Seleccione sede</option>
                                                        </select>
                                                        <select class="form-control" name="programa" id="programa" style="display: none;" required>
                                                            <option value="0">Seleccione el Programa</option>
                                                                <?php
                                                                  $programa_act = new consultas_admin();
                                                                  $programa_activo = $programa_act->select_programa(1);

                                                                  foreach ($programa_activo as $programa) {
                                                                    echo "<option value='" . $programa['id_programa'] . "'>" . $programa['nombre_programa'] . " | " . $programa['siglas'] . "</option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        <select class="form-control" name="ambiente" id="ambiente" style="display: none;" required >
                                                            <option value="0">Seleccione el Centro</option>
                                                                <?php
                                                                  $centro_act = new consultas_admin();
                                                                  $centro_activo = $centro_act->select_centro(1);

                                                                  foreach ($centro_activo as $centro) {
                                                                    echo "<option value='" . $centro['id_centro'] . "'>" . $centro['nombre_centro'] . " | " . $centro['cod_centro'] . "</option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        <select id="sede_2" name="sede_2" class="form-control" style="display: none;" required >
                                                                <option value="0">Seleccione sede</option>
                                                        </select>
                                                        <select id="ambiente_1" name="ambiente_1" class="form-control" style="display: none;" required >
                                                                <option value="0">Seleccione Ambiente</option>
                                                        </select>
                                                        <select class="form-control" name="jornada" id="jornada" style="display: none;" required >
                                                            <option value="0">Seleccione el Jornada</option>
                                                                <?php
                                                                  $jornada_act = new consultas_admin();
                                                                  $jornada_activo = $jornada_act->select_jornada(1);

                                                                  foreach ($jornada_activo as $jornada) {
                                                                    echo "<option value='" . $jornada['id_jornada'] . "'>" . $jornada['nombre_jornada'] . "</option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        <select class="form-control" name="ficha" id="ficha" style="display: none;" required>
                                                            <option value="0">Seleccione el Ficha</option>
                                                                <?php
                                                                  $ficha_act = new consultas_admin();
                                                                  $ficha_activo = $ficha_act->select_ficha(1);

                                                                  foreach ($ficha_activo as $ficha) {
                                                                    echo "<option value='" . $ficha['id_ficha'] . "'>" . $ficha['numero_ficha'] . " </option>";
                                                                  }
                                                                ?>
                                                        </select>
                                                        
                                                    </div><br>
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
                                                            <input type="text" class="form-control" name="fecha_final" required >
                                                        </div>
                                                    </div>
                                                <input type="submit" class="btn btn-success" name="btn_filtro" value="Generar">
                                            </form>
                                        </div>
                                    </div><br>
                                     <?php
                                if (isset($_POST['btn_filtro'])) {
                                    $select_filtro = $_POST['select_filtro'];
                                    $centro = $_POST['centro'];
                                    $sede_1 = $_POST['sede_1'];
                                    $programa = $_POST['programa'];
                                    $ambiente_1 = $_POST['ambiente_1'];
                                    $jornada = $_POST['jornada'];
                                    $ficha = $_POST['ficha'];
                                    $fecha_inicio = $_POST['fecha_inicio'];
                                    $fecha_final = $_POST['fecha_final'];
                                    if ($select_filtro == 'centro') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_centro($centro,$fecha_inicio,$fecha_final);*/
                                        echo centro ; 
                                    }else if ($select_filtro == 'sede') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_sede($sede_1,$fecha_inicio,$fecha_final);  */
                                        echo sede ; 
                                    }else if ($select_filtro == 'programa') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_programa($programa,$fecha_inicio,$fecha_final);  */
                                        echo programa ; 
                                    }else if ($select_filtro == 'ambiente') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_ambiente($ambiente_1,$fecha_inicio,$fecha_final);  */
                                        echo ambiente ; 
                                    }else if ($select_filtro == 'jornada') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_jornada($jornada,$fecha_inicio,$fecha_final);  */
                                        echo jornada ; 
                                    }else if ($select_filtro == 'ficha') {
                                        /*$estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_ficha($ficha,$fecha_inicio,$fecha_final);  */
                                        echo ficha ; 
                                    }

                                    //foreach ($valor_estadisticas as $resul_estadisticas) {       
                                    
                            ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button id="btn_1" name="btn_1" class="btn btn-default">Tabla respuestas</button>
                                            <button id="btn_2" name="btn_2" class="btn btn-default">Graficas respuestas</button>

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
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr class="odd gradeX">
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
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
                                                <?php include'grafica.php';?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    //}
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/sivaa/view/app/js/validate/jquery.validate.js"></script>

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