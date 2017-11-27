<?php
error_reporting(0);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Inicio <?php echo $_SESSION['nombre_rol'];?></title>
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
        <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="../vendor/css/style.css" rel="stylesheet">

        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                    <div class="col-lg-12" style="text-align: center;">
                        <img src="../img/Sena_logo.png">
                        <h1> SERVICIO NACIONAL DE APRENDIZAJE SENA</h1>
                        <h5> SIVAA</h5>
                        <div class="page-header" ></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h1 >Bienvenido <?php echo utf8_encode($_SESSION['nombre_usuario'] . " " . $_SESSION['apellido_usuario']); ?></h1>
                </div>
            </div>
        </div>

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        <script src="../dist/js/sb-admin-2.js"></script>
    </body>
</html>
