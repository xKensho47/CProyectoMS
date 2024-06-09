<?php
include("conexion.php");

//si no esta vacio
    if(!empty($_POST['nombre'])){   

        $titulo_pelicula = $conexion->real_escape_string($_POST['nombre']);
        $id_pelicula = $conexion->real_escape_string($_POST['id_peli']);

        $consulta = ("UPDATE peliculas
                       SET titulo= '$titulo_pelicula'
                       WHERE id_peli= '$id_pelicula'"); 
            
        $conexion->query($consulta);
        header('Location: crud_peliculas.php?status=success');
        exit();
    }

?>