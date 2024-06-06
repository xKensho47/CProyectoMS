<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && empty($_POST['director'])) {
    // Si se han enviado nombre y apellido, y no se ha enviado un director para eliminar
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
} elseif (isset($_POST['director']) && !empty($_POST['director']) && empty($_POST['nombre']) && empty($_POST['apellido'])) {
    // Si se ha enviado un director para eliminar y no se han enviado nombre y apellido
    $director_id = $conexion->real_escape_string($_POST['director']);
    $sql = "DELETE FROM director WHERE id_director = '$director_id'";
    
    if ($conexion->query($sql)) {
        header('Location: crud_peliculas.php?status=success');
        exit();
    } else {
        // Manejo de error si la eliminación falla
        header('Location: crud_peliculas.php?status=error_delete');
        exit();
    }
} else {
    // Si ambas condiciones se cumplen o ninguna
    header('Location: crud_peliculas.php?status=danger');
    exit();
}

$conexion->close();
?>

<script>
    history.replaceState(null, null, location.pathname)
</script>