<?php
include("conexion.php");

//si el campo no esta completo 
    if(!empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['mail']) || !empty($_POST['tipo_usuario'])){              
        $nombre = $conexion->real_escape_string($_POST['nombre']);
        $apellido = $conexion->real_escape_string($_POST['apellido']);
        $mail = $conexion->real_escape_string($_POST['mail']);
        $tipo_usuario = $conexion->real_escape_string($_POST['tipo_usuario']);
        $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);

        $sql = "UPDATE usuarios
                    SET nombre= '$nombre', apellido= '$apellido', mail='$mail', id_tipo= $tipo_usuario
                    WHERE id_usuario= $id_usuario"; 
            
        $conexion->query($sql);
        header('Location: admin_usuarios.php');
    }

?>