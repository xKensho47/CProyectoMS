<?php
include("conexion.php");
if (!empty($_POST['nombre'])) { 
    // Verifica si se ha enviado un nombre
    $nombre = $conexion->real_escape_string($_POST['nombre']);   
    $sql = "INSERT INTO genero (nombre_genero) VALUES ('$nombre')";
    
    if ($conexion->query($sql)) {
        $id = $conexion->insert_id;
    } else {
        // Manejo de error si la inserción falla
        echo "Error al insertar el género: ";
    }
}

if (!empty($_POST['genero'])) {
    // Verifica si se ha enviado un género para eliminar
    $genero = $conexion->real_escape_string($_POST['genero']); 
    $conexion->query("START TRANSACTION");
    // Eliminar las relaciones en la tabla peli_genero
    $conexion->query("DELETE FROM peli_genero WHERE id_genero = $genero");
    $conexion->query("DELETE FROM genero WHERE id_genero = $genero");
    // Confirmar la transacción
    $conexion->query("COMMIT");
}



$conexion->close();
header('Location: crud_peliculas.php');

?>