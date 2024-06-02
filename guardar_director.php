<?php
include("conexion.php");

if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);   
    $sql = "INSERT INTO director (nombre, apellido) VALUES ('$nombre', '$apellido')";
      
    if ($conexion->query($sql)) {
        $id = $conexion->insert_id;
        //Mensaje de agregado exitoso
    } else {
        // Manejo de error si la inserción falla
    }
} elseif (isset($_POST['director']) && !empty($_POST['director'])) {
    $director_id = $conexion->real_escape_string($_POST['director']);
    $sql = "DELETE FROM director WHERE id_director = '$director_id'";
      
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