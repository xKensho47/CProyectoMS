<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("conexion.php");

    $estrellas = intval($_POST['rating']);
    $usuario_id = intval($_POST['usuario_id']);
    $pelicula_id = intval($_POST['pelicula_id']);


    $existe_registro = mysqli_query($conexion,"SELECT * FROM peli_estrellas 
    WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id");

    if($existe_registro->num_rows > 0){
        //si existe lo actualizo
        mysqli_query($conexion,"UPDATE peli_estrellas SET estrellas = $estrellas WHERE id_cuenta = $usuario_id AND id_peli = $pelicula_id");
    } 
    else{
        //como no existe, lo creo
        mysqli_query($conexion,"INSERT INTO peli_estrellas VALUES($usuario_id,$pelicula_id,$estrellas)");
    }

    // tabla valoracion_peliculas :

    $existe_registro = mysqli_query($conexion,"SELECT * FROM valoracion_peliculas WHERE id_peli = $pelicula_id");

    $cant_estrellas = mysqli_query($conexion,"SELECT SUM(estrellas) AS cant_estrellas FROM peli_estrellas WHERE id_peli = $pelicula_id");
    $cant_registros = mysqli_query($conexion,"SELECT COUNT(*) AS cant_registros FROM peli_estrellas WHERE id_peli = $pelicula_id");

    $estrellas = mysqli_fetch_assoc($cant_estrellas);
    $registros = mysqli_fetch_assoc($cant_registros);  

    $promedio = $estrellas['cant_estrellas'] / (float) $registros['cant_registros'];

    $totalEstrellas = $estrellas['cant_estrellas'];

    if($existe_registro->num_rows > 0){
        mysqli_query($conexion,"UPDATE valoracion_peliculas SET cant_estrellas = $totalEstrellas, calificacion = $promedio WHERE id_peli = $pelicula_id");

        $q = "SELECT * FROM valoracion_peliculas WHERE id_peli = $pelicula_id AND cant_estrellas = 0 AND calificacion = 0 AND cant_like = 0";
        $resultado = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultado) > 0){
            mysqli_query($conexion,"DELETE FROM valoracion_peliculas WHERE id_peli = $pelicula_id");
        }

    } 
    else{
        mysqli_query($conexion,"INSERT INTO valoracion_peliculas (id_peli,cant_estrellas,calificacion) VALUES($pelicula_id,$totalEstrellas,$promedio)");
    }

    mysqli_close($conexion);

    } else {
    echo "Método de solicitud no válido.";
}

header("Location: detalle_peli.php?id_peli=" . $pelicula_id);
exit;
?>