<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) { 
    // Verifica si se ha enviado un nombre y apellido
    $nombre = $conexion->real_escape_string($_POST['nombre']); 
    $apellido = $conexion->real_escape_string($_POST['apellido']);  
    $sql = "INSERT INTO director (nombre, apellido) VALUES ('$nombre', '$apellido')";
    
    if ($conexion->query($sql)) {
        $id = $conexion->insert_id;
    } else {
        // Manejo de error si la inserción falla
        echo "Error al insertar el director: " . $conexion->error;
    }
}

if (!empty($_POST['director'])) {
    // Verifica si se ha enviado un director para eliminar
    $director = $conexion->real_escape_string($_POST['director']); 
    $conexion->query("START TRANSACTION");
    
    // Eliminar las relaciones en la tabla peli_director
    $conexion->query("DELETE FROM peli_director WHERE id_director = $director");
    $conexion->query("DELETE FROM director WHERE id_director = $director");
    
    // Confirmar la transacción
    $conexion->query("COMMIT");
}

$conexion->close();
header('Location: crud_peliculas.php');
?>