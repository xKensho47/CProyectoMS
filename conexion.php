<?php
$conexion = new mysqli("localhost", "root", "", "cineflow") or die('No se pudo conectar a la base de datos, por favor comuníquese con el administrador del sistema');
$conexion->set_charset("utf8");
