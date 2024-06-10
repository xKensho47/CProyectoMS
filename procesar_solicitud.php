<?php 
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si el usuario está autenticado
    if (!isset($_SESSION['id_cuenta'])) {
        echo "No se ha iniciado sesión.";
        exit();
    }

    // Obtiene el id de la cuenta del usuario actual
    $idCuenta = $_SESSION['id_cuenta'];
    
    // Verifica si se hizo clic en el botón de Aceptar o Rechazar
    if (isset($_POST['aceptar'])) {
        // Itera sobre cada solicitud aceptada
        foreach ($_POST['aceptar'] as $idAmigo) {
            // Inserta a la pareja de amigos en la tabla lista_amigos
            $insert_query = "INSERT INTO lista_amigos (id_cuenta, amigo) VALUES ($idAmigo, $idCuenta)";
            $result_insert = mysqli_query($conexion, $insert_query);

            if (!$result_insert) {
                echo "Error al aceptar la solicitud.";
                exit();
            }

            // Segundo insert con la misma información
            $second_insert_query = "INSERT INTO lista_amigos (id_cuenta, amigo) VALUES ($idCuenta, $idAmigo)";
            $result_second_insert = mysqli_query($conexion, $second_insert_query);

            if (!$result_second_insert) {
                echo "Error al insertar la segunda solicitud.";
                exit();
            }

            // Elimina la notificación de la tabla notificacion
            $delete_query = "DELETE FROM notificacion WHERE usuario_envia = $idAmigo AND usuario_recibe = $idCuenta";
            $result_delete = mysqli_query($conexion, $delete_query);

            if (!$result_delete) {
                echo "Error al eliminar la notificación.";
                exit();
            }
        }
        
        header('Location: notificaciones.php');
    } elseif (isset($_POST['rechazar'])) {
        // Itera sobre cada solicitud rechazada
        foreach ($_POST['rechazar'] as $idAmigo) {
            // Elimina la notificación de la tabla notificacion
            $delete_query = "DELETE FROM notificacion WHERE usuario_envia = $idAmigo AND usuario_recibe = $idCuenta";
            $result_delete = mysqli_query($conexion, $delete_query);

            if (!$result_delete) {
                echo "Error al eliminar la notificación.";
                exit();
            }
        }
        
        header('Location: notificaciones.php');
    } else {
        echo "Acción no válida.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>




