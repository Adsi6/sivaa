<?php
error_reporting(0);
session_start();
if ($_SESSION['nombre_usuario'] == "") {
    header("location:/sivaa/index.php");
}

?>

<!--
Autor: John Alexander Llarave
Desarrollador Web
-->

<div class="navbar-header">
        <a class="navbar-brand" href="/sivaa/view/app/pages/index.php">Sistema Verificación Ambientes de Aprendizaje</a>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <h4 class="dropdown-toggle"> <?php echo $_SESSION['nombre_rol'] . ": " . utf8_encode($_SESSION['nombre_usuario'] . " " . $_SESSION['apellido_usuario']); ?></h4>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>-->
            <li><a href="Actualizar_datos.php"><i class="fa fa-gear fa-fw"></i>Actualizar datos</a></li>
            <li><a href="Actualizar_password.php"><i class="fa fa-gear fa-fw"></i>Actualizar contraseña</a></li>
            <li class="divider"></li>
            <li><a href="cerrar_sesion.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a></li>
        </ul>
    </li>
</ul>
