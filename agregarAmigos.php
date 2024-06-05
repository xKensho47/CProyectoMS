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
    $friendId = $_POST['friend_id'];
    $userId = $_SESSION['id_cuenta']; // Id de la cuenta del usuario actual

    // Inserta al amigo en la lista de amigos
    $q = "INSERT INTO lista_amigos (id_cuenta, amigo) VALUES (?, ?)";
    $stmt = $conexion->prepare($q);
    $stmt->bind_param('ii', $userId, $friendId);
    if ($stmt->execute()) {
        // Redirige de vuelta a la página anterior
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Hubo un error al agregar al amigo. Por favor, inténtalo de nuevo más tarde.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
