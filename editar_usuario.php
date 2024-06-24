<?php

session_start();
include("conexion.php");
include 'loginVerification.php'; 

    //si el campo esta completo
    if(!empty($_POST['tipo_usuario'])){              
        $tipo_usuario = $conexion->real_escape_string($_POST['tipo_usuario']);
        $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);
        $cuenta_usuario_activo = $conexion->real_escape_string($_SESSION['id_cuenta']); 

        $sql = "UPDATE usuarios
                    SET id_tipo= $tipo_usuario
                    WHERE id_usuario= $id_usuario"; 

        //busco coincidencia para saber si quiero modificar mi tipo de usuario
        $consulta = "SELECT *
                        FROM cuenta_usuario
                            WHERE id_cuenta = $cuenta_usuario_activo
                                AND id_usuario = $id_usuario";
            
        $conexion->query($sql);
        $encontro_coincidencia = $conexion->query($consulta);

        if($encontro_coincidencia->num_rows > 0){
            header('Location: index.php');
            exit(); 
        } else {
            header('Location: admin_usuarios.php?status=success');
            exit();
        } 
    }
?>