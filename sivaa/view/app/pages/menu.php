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
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
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
        <a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>                            
    </li>
    <li>
        <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Administración<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="Admin_control_regional.php">Control Regionales</a>
            </li>
            <li>
                <a href="Admin_control_centro.php">Control Centros</a>
            </li>
            <li>
                <a href="Admin_control_sede.php">Control Sedes</a>
            </li>
            <li>
                <a href="Admin_control_ambiente.php">Control Ambientes</a>
            </li>
            <li>
                <a href="Admin_control_programa.php">Control Programas</a>
            </li>
            <li>
                <a href="Admin_control_ficha.php">Control Fichas</a>
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
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
    </li>
    <li>
        <a href="Lista_de_chequeo.php"><i class="fa fa-check-square-o"></i> Lista de Chequeo</a>
    </li>
    <li>
        <a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>
    </li>
    <li>
        <a href="Menu_instructor.php"><i class="fa fa-bar-chart-o fa-fw"></i>Menu Fichas Instructor</a>
    </li>
</ul>
<?php
    } else if ($_SESSION['nombre_rol'] == "Consultor") {
?>
<ul class="nav" id="side-menu">
    <br>
    <li>
        <a href="/sivaa/view/app/pages/index.php"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
    </li>
    <li>
        <a href="Estadisticas.php"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>
    </li>
</ul>
<?php
    }
?>