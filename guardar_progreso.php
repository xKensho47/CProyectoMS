<?php
session_start();
include("conexion.php");

$id_cuenta = $_SESSION['id_cuenta'];
$id_peli = $_POST['id_peli'];
$progreso = $_POST['progreso'];
$duracion_total = $_POST['duracion_total'];

$consulta = "SELECT * FROM seguir_viendo WHERE id_cuenta = $id_cuenta AND id_peli = $id_peli";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {

    $consulta = "UPDATE seguir_viendo SET tiempo_visto = $progreso, duracion_total = $duracion_total WHERE id_cuenta = $id_cuenta AND id_peli = $id_peli";
    mysqli_query($conexion, $consulta);

} else {

    $consulta = "INSERT INTO seguir_viendo (id_cuenta, id_peli, tiempo_visto, duracion_total) VALUES ($id_cuenta, $id_peli, $progreso, $duracion_total)";
    mysqli_query($conexion, $consulta);

}

mysqli_close($conexion);
?>