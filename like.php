<?php

    include("conexion.php");

    // Obtener los datos del formulario
    $pelicula_id = intval($_POST['pelicula_id']);
    $usuario_id = intval($_POST['usuario_id']);

    // Insertar los datos en la tabla me_gusta
    $sql = "SELECT * FROM peli_like WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id ";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado->num_rows > 0) {
        // Ya existe un registro
        mysqli_query($conexion,"DELETE FROM peli_like WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id");
    } 
    else {
        // Insertar los datos en la tabla
        $sql = "INSERT INTO peli_like (id_cuenta, id_peli) VALUES ($usuario_id,$pelicula_id)";
        $resultado = mysqli_query($conexion, $sql);
    }

    // tabla valoracion_peliculas :

    $cant_likes = mysqli_query($conexion,"SELECT COUNT(*) AS likes FROM peli_like WHERE id_peli = $pelicula_id");

    $existe_registro = mysqli_query($conexion,"SELECT * FROM valoracion_peliculas WHERE id_peli = $pelicula_id");

    $row = $cant_likes->fetch_assoc();
    $likes = $row['likes'];

    if($existe_registro->num_rows > 0){
        mysqli_query($conexion,"UPDATE valoracion_peliculas SET cant_like = $likes WHERE id_peli = $pelicula_id");
        
        $q = "SELECT * FROM valoracion_peliculas WHERE id_peli = $pelicula_id AND cant_estrellas = 0 AND calificacion = 0 AND cant_like = 0";
        $resultado = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultado) > 0){
            mysqli_query($conexion,"DELETE FROM valoracion_peliculas WHERE id_peli = $pelicula_id");
        }
    } 
    else{
        mysqli_query($conexion,"INSERT INTO valoracion_peliculas (id_peli,cant_like) VALUES($pelicula_id,$likes)");
    }

    mysqli_close($conexion);

    // Redirigir de vuelta a la página de detalles de la película
    header("Location: detalle_peli.php?id_peli=" . $pelicula_id);
    exit;

?>