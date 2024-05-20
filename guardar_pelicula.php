<?php
 include("conexion.php");

    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $genero = $conexion->real_escape_string($_POST['genero']);

    $sql = "INSERT INTO peliculas (titulo, descripcion, fecha_subida)
    VALUES ('$nombre', '$descripcion', NOW())";

if ($conn->query($sql)) {
    $id = $conexion->insert_id;
}

header('Location: crud_peliculas.php');
?>