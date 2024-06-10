<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && empty($_POST['director'])) { 
    // Verifica si se ha enviado un nombre y apellido
    $nombre = $conexion->real_escape_string($_POST['nombre']); 
    $apellido = $conexion->real_escape_string($_POST['apellido']);  
    $sql = "INSERT INTO director (nombre, apellido) VALUES ('$nombre', '$apellido')";
    
    if ($conexion->query($sql)) {
        header('Location: crud_peliculas.php?status=success');
        exit();
    } else {
        // Manejo de error si la inserción falla
        header('Location: crud_peliculas.php?status=error_insert');
        exit();
    }
}elseif (!empty($_POST['director']) && empty($_POST['nombre']) && empty($_POST['apellido'])){
          // Verifica si se ha enviado un director para eliminar
        $director = $conexion->real_escape_string($_POST['director']); 
        $conexion->query("START TRANSACTION");
        if ( $conexion->query("DELETE FROM peli_director WHERE id_director = $director") && 
            $conexion->query("DELETE FROM director WHERE id_director = $director")) {
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
}else {
    // Si ambas condiciones se cumplen o ninguna
    header('Location: crud_peliculas.php?status=danger');
    exit();
}
?>
