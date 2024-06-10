<?php

include("conexion.php");

    //si recibo el ID del usuario
    if(!empty($_POST['id_usuario'])) {   

        $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);

        //id de la cuenta del usuario a eliminar
        $idCuentaUsuario = "SELECT id_cuenta
                                FROM cuenta_usuario
                                    WHERE id_usuario = '$id_usuario'";

        $resultado_query = $conexion->query($idCuentaUsuario);

        //guardo el id en una variable
        $id_cuenta_eliminar = $resultado_query->fetch_assoc()['id_cuenta'];

        //primero lo borro de la tabla genero_fav
        $borrar_cuenta_genero_favorito = "DELETE
                                            FROM genero_favorito
                                                WHERE id_cuenta = '$id_cuenta_eliminar'";

        $conexion->query($borrar_cuenta_genero_favorito);

        //despues de la tabla cuenta_usuario
        $borrar_cuenta_usuario = " DELETE 
                                      FROM cuenta_usuario
                                        WHERE id_usuario = '$id_usuario'";

        $conexion->query($borrar_cuenta_usuario);
                          
       //por ultimo de la cuenta usuarios                                      
        $sql = " DELETE 
                    FROM usuarios
                        WHERE id_usuario = '$id_usuario'";

        $conexion->query($sql);

        header('Location: admin_usuarios.php?status=success');
        exit();  
    } 

?>