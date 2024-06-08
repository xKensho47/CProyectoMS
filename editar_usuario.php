<?php
include("conexion.php");

//si el campo no esta completo 
    if(!empty($_POST['tipo_usuario'])){              
        $tipo_usuario = $conexion->real_escape_string($_POST['tipo_usuario']);
        $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);

        $sql = "UPDATE usuarios
                    SET id_tipo= $tipo_usuario
                    WHERE id_usuario= $id_usuario"; 
            
        $conexion->query($sql);
        header('Location: admin_usuarios.php?status=success');
        exit();
    }

?>