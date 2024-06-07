<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) { 
    // Verifica si se ha enviado un nombre y apellido
    $nombre = $conexion->real_escape_string($_POST['nombre']); 
    $apellido = $conexion->real_escape_string($_POST['apellido']);  
    $sql = "INSERT INTO actor (nombre, apellido) VALUES ('$nombre', '$apellido')";
    
    if ($conexion->query($sql)) {
        $id = $conexion->insert_id;
    } else {
        // Manejo de error si la inserción falla
        echo "Error al insertar el actor: " . $conexion->error;
    }
}

if (!empty($_POST['actor'])) {
    // Verifica si se ha enviado un actor para eliminar
    $actor = $conexion->real_escape_string($_POST['actor']); 
    $conexion->query("START TRANSACTION");
    
    // Eliminar las relaciones en la tabla peli_actor
    $conexion->query("DELETE FROM peli_actor WHERE id_actor = $actor");
    $conexion->query("DELETE FROM actor WHERE id_actor = $actor");
    
    // Confirmar la transacción
    $conexion->query("COMMIT");
}

$conexion->close();
header('Location: crud_peliculas.php');
?>


