<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si el usuario está autenticado
    if (!isset($_SESSION['id_cuenta'])) {
        echo "No se ha iniciado sesión.";
        exit();
    }

    // Obtiene el id de la cuenta del amigo desde la solicitud POST
    $friendId = $_POST['discover_id'];
    $userId = $_SESSION['id_cuenta']; // Id de la cuenta del usuario actual

    // Verifica que friendId no sea el mismo que userId para evitar que el usuario se agregue a sí mismo como amigo
    if ($friendId == $userId) {
        echo "No puedes agregarte a ti mismo como amigo.";
        exit();
    }

    // Insertar la notificación
    $mensaje = TRUE;
    $query = "INSERT INTO notificacion (usuario_envia, usuario_recibe, mensaje) VALUES ($userId, $friendId, '$mensaje')";
    $result = mysqli_query($conexion, $query);

    if (!$result) {
        echo "Error al enviar la notificación.";
        exit();
    }

    header('Location: profile.php');
} else {
    echo "Método de solicitud no válido.";
}

// No redirigir a profile.php para fines de depuración
// header("Location: profile.php");
?>
