<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peli = $conexion->real_escape_string($_POST['movieId']);
    $titulo = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $estreno = $conexion->real_escape_string($_POST['estreno']);
    $duracion = $conexion->real_escape_string($_POST['duracion']);
    $path_poster = $conexion->real_escape_string($_POST['Path_poster']);
    $genero = $conexion->real_escape_string($_POST['genero']);
    $actores = $conexion->real_escape_string($_POST['actores']);
    $directores = $conexion->real_escape_string($_POST['directores']);
    $video_mp4 = $conexion->real_escape_string($_POST['video_mp4']);
    $video_iframe = $conexion->real_escape_string($_POST['video_iframe']);

    $sql = "UPDATE peliculas SET 
                titulo = '$titulo', 
                descripcion = '$descripcion', 
                estreno = '$estreno', 
                path_poster = '$path_poster', 
                duracion = '$duracion', 
                genero = '$genero', 
                actores = '$actores', 
                directores = '$directores', 
                video_mp4 = '$video_mp4', 
                video_iframe = '$video_iframe'
            WHERE id_peli = $id_peli";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }

    $conexion->close();
}
?>
