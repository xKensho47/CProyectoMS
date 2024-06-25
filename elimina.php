<?php
include('conexion.php');

$id = $conexion->real_escape_string($_POST['pelicula_eliminar']);

// Iniciar la transacción
$conexion->begin_transaction();

try {
    // Eliminar las relaciones en las tablas relacionadas
    $conexion->query("DELETE FROM peli_like WHERE id_peli = $id");
    $conexion->query("DELETE FROM mas_tarde WHERE id_peli = $id");
    $conexion->query("DELETE FROM valoracion_peliculas WHERE id_peli = $id");
    $conexion->query("DELETE FROM peli_estrellas WHERE id_peli = $id");
    $conexion->query("DELETE FROM notificacion WHERE id_peli = $id");
    $conexion->query("DELETE FROM peli_favorita WHERE id_peli = $id");
    $conexion->query("DELETE FROM peli_genero WHERE id_peli = $id");
    $conexion->query("DELETE FROM peli_actor WHERE id_peli = $id");
    $conexion->query("DELETE FROM peli_director WHERE id_peli = $id");

    // Eliminar la película en la tabla peliculas
    $conexion->query("DELETE FROM peliculas WHERE id_peli = $id");

    // Confirmar la transacción
    $conexion->commit();

    // Redirigir con éxito
    header('Location: crud_peliculas.php?status=success');
    exit();
} catch (Exception $exception) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    // Redirigir con mensaje de error genérico
    header("Location: crud_peliculas.php?status=error");
    exit();
}

// Cerrar la conexión
$conexion->close();
?>
