
<?php
include("conexion.php");

// Escapar los datos recibidos del formulario
$nombre = $conexion->real_escape_string($_POST['nombre']);
$descripcion = $conexion->real_escape_string($_POST['descripcion']);
$estreno = $conexion->real_escape_string($_POST['estreno']);
$duracion = $conexion->real_escape_string($_POST['duracion']);
$Path_poster = $conexion->real_escape_string($_POST['Path_poster']);
$video_mp4 = $conexion->real_escape_string($_POST['video_mp4']);
$video_iframe = $conexion->real_escape_string($_POST['video_iframe']);

// Insertar la película en la base de datos
$sql = "INSERT INTO peliculas (titulo, descripcion, estreno, Path_poster, duracion, video_iframe, video_mp4, fecha_subida) 
        VALUES ('$nombre', '$descripcion', '$estreno', '$Path_poster', '$duracion', '$video_iframe', '$video_mp4', NOW())";

if ($conexion->query($sql)) {
    $id_peli = $conexion->insert_id;

    // Guardar los géneros en peli_genero
    if (isset($_POST['generoSeleccionado'])) {
        $generosSeleccionados = $_POST['generoSeleccionado'];
        $stmt = $conexion->prepare("INSERT INTO peli_genero (id_peli, id_genero) VALUES (?, ?)");
        foreach ($generosSeleccionados as $id_genero) {
            $stmt->bind_param("ii", $id_peli, $id_genero);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Guardar los actores en peli_actor
    if (isset($_POST['actorSeleccionados'])) { // Nombre correcto del campo
        $actoresSeleccionados = $_POST['actorSeleccionados'];
        $stmt = $conexion->prepare("INSERT INTO peli_actor (id_peli, id_actor) VALUES (?, ?)");
        foreach ($actoresSeleccionados as $id_actor) {
            $stmt->bind_param("ii", $id_peli, $id_actor);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Guardar los directores en peli_director
    if (isset($_POST['directoresSeleccionados'])) { // Nombre correcto del campo
        $directoresSeleccionados = $_POST['directoresSeleccionados'];
        $stmt = $conexion->prepare("INSERT INTO peli_director (id_peli, id_director) VALUES (?, ?)");
        foreach ($directoresSeleccionados as $id_director) {
            $stmt->bind_param("ii", $id_peli, $id_director);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Redirigir con mensaje de éxito
    header('Location: crud_peliculas.php?status=success');
    exit();
} else {
    // Redirigir con mensaje de error
    header('Location: crud_peliculas.php?status=error');
    exit();
}

$conexion->close();
?>


