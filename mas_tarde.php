<?php

    include("conexion.php");

    // Obtener los datos del formulario
    $pelicula_id = intval($_POST['pelicula_id']);
    $usuario_id = intval($_POST['usuario_id']);

    // Insertar los datos en la tabla me_gusta
    $sql = "SELECT * FROM mas_tarde WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado->num_rows > 0) {
        // Ya existe un registro
        mysqli_query($conexion,"DELETE FROM mas_tarde WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id");
    } 
    else {
        // Insertar los datos en la tabla
        $sql = "INSERT INTO mas_tarde (id_cuenta, id_peli) VALUES ($usuario_id,$pelicula_id)";
        $resultado = mysqli_query($conexion, $sql);
    }

    mysqli_close($conexion);

    // Redirigir de vuelta a la página de detalles de la película
    header("Location: detalle_peli.php?id_peli=" . $pelicula_id);
    exit;

?>