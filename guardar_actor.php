
<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && empty($_POST['actor'])) {
    // Si se han enviado nombre y apellido, y no se ha enviado un actor para eliminar
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
} elseif (isset($_POST['actor']) && !empty($_POST['actor']) && empty($_POST['nombre']) && empty($_POST['apellido'])) {
    // Si se ha enviado un actor para eliminar y no se han enviado nombre y apellido
    $actor_id = $conexion->real_escape_string($_POST['actor']);
    $sql = "DELETE FROM actor WHERE id_actor = '$actor_id'";
    
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

