
<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && empty($_POST['actor'])) { 
    // Verifica si se ha enviado un nombre y apellido
    $nombre = $conexion->real_escape_string($_POST['nombre']); 
    $apellido = $conexion->real_escape_string($_POST['apellido']);  
    $sql = "INSERT INTO actor (nombre, apellido) VALUES ('$nombre', '$apellido')";
    
    if ($conexion->query($sql)) {
        header('Location: crud_peliculas.php?status=success');
        exit();
    } else {
        // Manejo de error si la inserción falla
        header('Location: crud_peliculas.php?status=error_insert');
        exit();
    }
}elseif (!empty($_POST['actor']) && empty($_POST['nombre']) && empty($_POST['apellido'])){
          // Verifica si se ha enviado un director para eliminar
        $actor = $conexion->real_escape_string($_POST['actor']); 
        $conexion->query("START TRANSACTION");
        if ( $conexion->query("DELETE FROM peli_actor WHERE id_actor = $actor") && 
            $conexion->query("DELETE FROM actor WHERE id_actor = $actor")) {
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


