<?php
//echo "<br>" . $_SERVER['PHP_SELF'];
//error_reporting(0);
session_start();
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
    <title>Estadisticas</title>
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
                    <h1 class="page-header">Estadisticas <?php echo $_SESSION['nombre_rol']?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-heading">
                                <form method="POST" action="">
                                    <label>Generar archivo de respuestas sin filtro</label><br>
                                    <input type="hidden" name="hidden_estadisticas" value="1">
                                    <input type="submit" class="btn btn-success" name="btn_sin_filtro" value="Generar">
                                    <div class="hr-line-dashed"></div>
                                </form>
                            </div>
                            <div class="panel-heading">
                                <button type="button" class="btn btn-success">Crear ficha</button>
                                <div class="hr-line-dashed"></div>
                            </div>
                            <?php
                                if (isset($_POST['btn_sin_filtro'])) {
                                    if ($_POST['hidden_estadisticas'] == 1) {
                                        $estadisticas = new Estadisticas();
                                        $valor_estadisticas = $estadisticas->select_sin_filtro();    
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
                                                                                    <th>Editar</th>
                                                                                    <th>Inactivar</th>
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