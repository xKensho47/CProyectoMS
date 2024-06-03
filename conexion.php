<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_de_datos = 'cineflow';

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos) or die('No se pudo conectar a la base de datos, por favor comuníquese con el administrador del sistema');

$conexion->set_charset("utf8");

?>
