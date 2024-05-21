<?php
include("conexion.php");

$nombre = $conexion->real_escape_string($_POST['nombre']);
$descripcion = $conexion->real_escape_string($_POST['descripcion']);
$estreno = $conexion->real_escape_string($_POST['estreno']);
$duracion = $conexion->real_escape_string($_POST['duracion']);
$Path_poster = $conexion->real_escape_string($_POST['Path_poster']);
$video_mp4 = $conexion->real_escape_string($_POST['video_mp4']);
$video_iframe = $conexion->real_escape_string($_POST['video_iframe']);

$genero = $conexion->real_escape_string($_POST['genero']);

$sql = "INSERT INTO peliculas (titulo, descripcion, estreno,Path_poster,duracion,video_iframe,
            video_mp4,fecha_subida) VALUES ('$nombre', '$descripcion', '$estreno', '$Path_poster','$duracion',
             '$video_iframe','$video_mp4',NOW())";

if ($conexion->query($sql)) {
    $id = $conexion->insert_id;
}

header('Location: crud_peliculas.php');
