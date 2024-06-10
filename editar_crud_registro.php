<?php
include("conexion.php");

    //si no esta vacio
    if(!empty($_POST['id_peli'])){

        if (!empty($_POST['nombre']) || !empty($_POST['descripcion']) || !empty($_POST['estreno']) || !empty($_POST['duracion'])) {  
        $id_pelicula = $conexion->real_escape_string($_POST['id_peli']);
        $titulo_pelicula = $conexion->real_escape_string($_POST['nombre']);
        $descripcion_pelicula = $conexion->real_escape_string($_POST['descripcion']);
        $estreno_pelicula = $conexion->real_escape_string($_POST['estreno']);
        $duracion_pelicula = $conexion->real_escape_string($_POST['duracion']); 

        $consulta = ("UPDATE peliculas
                        SET titulo = '$titulo_pelicula',
                            descripcion = '$descripcion_pelicula',
                                estreno = '$estreno_pelicula',
                                    duracion = '$duracion_pelicula'
                                        WHERE id_peli= '$id_pelicula'");               
            
        $conexion->query($consulta);

        header('Location: crud_peliculas.php?status=success');
        exit();
        }
    } 

?>