<?php

include("conexion.php");

if (!empty($_POST['nombre']) && empty($_POST['genero'])) { 
    // Si se ha enviado un nombre y no se ha enviado un género para eliminar
    $nombre = $conexion->real_escape_string($_POST['nombre']);   
    $sql = "INSERT INTO genero (nombre_genero) VALUES ('$nombre')";
    
    if ($conexion->query($sql)) {
        header('Location: crud_peliculas.php?status=success');
        exit();
    } else {
        // Manejo de error si la inserción falla
        header('Location: crud_peliculas.php?status=error_insert');
        exit();
    }
} elseif (!empty($_POST['genero']) && empty($_POST['nombre'])) {
    // Si se ha enviado un género para eliminar y no se ha enviado un nombre
    $genero = $conexion->real_escape_string($_POST['genero']); 
    $conexion->query("START TRANSACTION");
    // Eliminar las relaciones en la tabla peli_genero
    if ($conexion->query("DELETE FROM peli_genero WHERE id_genero = $genero") && 
        $conexion->query("DELETE FROM genero WHERE id_genero = $genero")) {
        // Confirmar la transacción solo si ambas consultas se ejecutan correctamente
        $conexion->query("COMMIT");
        header('Location: crud_peliculas.php?status=success');
        exit();
    } else {
        // Manejo de error si la eliminación falla
        $conexion->query("ROLLBACK");
        header('Location: crud_peliculas.php?status=error_delete');
        exit();
    }
} else {
    // Si ambas condiciones se cumplen o ninguna
    header('Location: crud_peliculas.php?status=danger');
    exit();
}
?>







