<?php

include("conexion.php");

    //si recibo el ID del usuario
    if(!empty($_POST['id_usuario'])) {   

        $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);
    
        //primero lo borro de la tabla cuenta_usuario xq se relacionan las 2 tablas
        $borrar_cuenta_usuario = " DELETE 
                                      FROM cuenta_usuario
                                        WHERE id_usuario = '$id_usuario'";

        $conexion->query($borrar_cuenta_usuario);
                          
       //dp de la cuenta usuarios                                      
        $sql = " DELETE 
                    FROM usuarios
                        WHERE id_usuario = '$id_usuario'";
        
        $conexion->query($sql);

        header('Location: admin_usuarios.php');
    } 

?>