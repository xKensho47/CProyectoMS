<?php
include("conexion.php");

if(!empty($_POST['nombre']) && !empty($_POST['genero'])){
#mensaje de error

}else{

    if (!empty($_POST['nombre'])) { // Verifica si se ha enviado un nombre
        $nombre = $conexion->real_escape_string($_POST['nombre']);   
        $sql = "INSERT INTO genero (nombre_genero) VALUES ('$nombre')";
        
        if ($conexion->query($sql)) {
            $id = $conexion->insert_id;
        } else {
            // Manejo de error si la inserción falla
            echo "Error al insertar el género: ";
        }
    }
    if (empty($genero)) {
    
    }else{
        #eliminar el genero
    }
}
header('Location: crud_peliculas.php');
