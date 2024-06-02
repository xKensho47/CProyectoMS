<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);   
    $sql = "INSERT INTO actor (nombre, apellido) VALUES ('$nombre', '$apellido')";
      
    if ($conexion->query($sql)) {
        $id = $conexion->insert_id;
        //Mensaje de agregado exitoso
    } else {
        // Manejo de error si la inserción falla
    }
} elseif (isset($_POST['actor']) && !empty($_POST['actor'])) {
    $actor_id = $conexion->real_escape_string($_POST['actor']);
    $sql = "DELETE FROM actor WHERE id_actor = '$actor_id'";
      
    if ($conexion->query($sql)) {
        // Éxito en la eliminación
    } else {
        // Manejo de error si la eliminación falla
    }
} else {
    // Mensaje de error si los campos están vacíos
}

$conexion->close();
header('Location: crud_peliculas.php');
?>
<script>
    history.replaceState(null, null, location.pathname)
</script>

