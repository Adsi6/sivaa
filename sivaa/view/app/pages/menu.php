<?php
error_reporting(0);
session_start();
?>
<?php 
    if ($_SESSION['nombre_rol'] == "Administrador") {
?>

<ul class="nav" id="side-menu">
    <br>
    <li>
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-home"></i>Inicio</a>
    </li>
    <li>
        <a href="Admin_control_usuarios.php"><i class="fa fa-user-plus"></i> Control Usuarios</a>
    </li>
    <li>
        <a href="Admin_control_encuesta.php"><i class="fa fa-file-text-o"></i> Control Encuesta</a>
    </li>
    <li>
        <a href="Lista_de_chequeo.php"><i class="fa fa-check-square-o"></i> Lista de Chequeo</a>
    </li>
    <li>
        <!--<a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>-->
        <a href="Resultado_encuesta.php"><i class="fa fa-bar-chart-o fa-fw"></i>Resultado Encuesta</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Administración<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="Admin_control_regional.php"><i class="fa fa-caret-right"></i>Control Regionales</a>
            </li>
            <li>
                <a href="Admin_control_centro.php"><i class="fa fa-caret-right"></i>Control Centros</a>
            </li>
            <li>
                <a href="Admin_control_sede.php"><i class="fa fa-caret-right"></i>Control Sedes</a>
            </li>
            <li>
                <a href="Admin_control_ambiente.php"><i class="fa fa-caret-right"></i>Control Ambientes</a>
            </li>
            <li>
                <a href="Admin_control_programa.php"><i class="fa fa-caret-right"></i>Control Programas</a>
            </li>
            <li>
                <a href="Admin_control_ficha.php"><i class="fa fa-caret-right"></i>Control Fichas</a>
            </li>
            <!--<li>
                <a href="#">Control Jornadas</a>
            </li>-->
        </ul>
    </li>
</ul>
<?php
    } else if ($_SESSION['nombre_rol'] == "Instructor") {
?>
<ul class="nav" id="side-menu">
    <br>
    <li>
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-home"></i>Inicio</a>
    </li>
    <li>
        <a href="Lista_de_chequeo.php"><i class="fa fa-check-square-o"></i> Lista de Chequeo</a>
    </li>
    <li>
        <!--<a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>-->
        <a href="Resultado_encuesta.php"><i class="fa fa-bar-chart-o fa-fw"></i>Resultado Encuesta</a>
    </li>
    <li>
        <a href="Menu_instructor.php"><i class="fa fa-folder-open"></i>Menu Fichas Instructor</a>
    </li>
</ul>
<?php
    } else if ($_SESSION['nombre_rol'] == "Consultor") {
?>
<ul class="nav" id="side-menu">
    <br>
    <li>
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-home"></i>Inicio</a>
    </li>
    <li>
        <!--<a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>-->
        <a href="Resultado_encuesta.php"><i class="fa fa-bar-chart-o fa-fw"></i>Resultado Encuesta</a>
    </li>
</ul>
<?php
    }
?>