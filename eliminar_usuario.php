<?php

session_start();
include("conexion.php");
include 'loginVerification.php'; 

if (!empty($_POST['id_usuario'])) {   

    $id_usuario = $conexion->real_escape_string($_POST['id_usuario']);

    try {
        //inicio una transacción
        $conexion->begin_transaction();

        //obtengo el id de cuenta del usuario a eliminar
        $stmt = $conexion->prepare("SELECT id_cuenta FROM cuenta_usuario WHERE id_usuario = ?");
        $stmt->bind_param("s", $id_usuario);
        $stmt->execute();
        $resultado_query = $stmt->get_result();
        $id_cuenta_eliminar = $resultado_query->fetch_assoc()['id_cuenta'];
        $stmt->close();

        //empiezo a eliminar registros relacionados al usuario previo a su eliminación
        //genero_favorito
        $stmt = $conexion->prepare("DELETE FROM genero_favorito WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

         //peli_favorita
        $stmt = $conexion->prepare("DELETE FROM peli_favorita WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //peli_like
        $stmt = $conexion->prepare("DELETE FROM peli_like WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //peli_estrellas
        $stmt = $conexion->prepare("DELETE FROM peli_estrellas WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //mas_tarde
        $stmt = $conexion->prepare("DELETE FROM mas_tarde WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //notificaciones que envia
        $stmt = $conexion->prepare("DELETE FROM notificacion WHERE usuario_envia = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //notificaciones que recibe
        $stmt = $conexion->prepare("DELETE FROM notificacion WHERE usuario_recibe = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //lista_amigos donde el usuario es amigo
        $stmt = $conexion->prepare("DELETE FROM lista_amigos WHERE amigo = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //lista_amigos donde el id_cuenta es el amigo
        $stmt = $conexion->prepare("DELETE FROM lista_amigos WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();

        //form contacto
        $stmt = $conexion->prepare("DELETE FROM contacto WHERE id_cuenta = ?");
        $stmt->bind_param("s", $id_cuenta_eliminar);
        $stmt->execute();
        $stmt->close();


        //elimino de cuenta_usuario
        $stmt = $conexion->prepare("DELETE FROM cuenta_usuario WHERE id_usuario = ?");
        $stmt->bind_param("s", $id_usuario);
        $stmt->execute();
        $stmt->close();

        //elimino de usuarios
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("s", $id_usuario);
        $stmt->execute();
        $stmt->close();


        //confirmo la transacción
        $conexion->commit();

        //verifico si el usuario eliminado es el mismo que está en sesión
        if ($_SESSION['id_cuenta'] == $id_cuenta_eliminar) {
            // Redirigir a la página de inicio (index.php)
            header('Location: index.php');
            exit();
        } else {
            //redirigir a la página de administración con estado de éxito
            header('Location: admin_usuarios.php?status=success');
            exit(); 
        }
    } catch (Exception $e) {
        // En caso de error, hacer rollback (deshacer cambios) en la transacción
        $conexion->rollback();
        echo "Error al eliminar usuario: " . $e->getMessage();
    }
}

?>
