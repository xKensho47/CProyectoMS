<?php
include('conexion.php');

$id = $conexion->real_escape_string($_POST['id']);

$conexion->query("START TRANSACTION");

// Eliminar las relaciones en la tabla peli_genero
$conexion->query("DELETE FROM peli_genero WHERE id_peli = $id");

// Eliminar las relaciones en la tabla peli_actor
$conexion->query("DELETE FROM peli_actor WHERE id_peli = $id");

// Eliminar las relaciones en la tabla peli_director
$conexion->query("DELETE FROM peli_director WHERE id_peli = $id");

// Eliminar la película en la tabla peliculas
$conexion->query("DELETE FROM peliculas WHERE id_peli = $id");

// Confirmar la transacción
$conexion->query("COMMIT");

// Cerrar la conexión
$conexion->close();

header('Location: crud_peliculas.php?status=success');
exit();
?>