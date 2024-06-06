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
    $friendId = $_POST['amigo'];
    $userId = $_SESSION['id_cuenta']; // Id de la cuenta del usuario actual

    // Verifica que friendId no sea el mismo que userId para evitar que el usuario se agregue a sí mismo como amigo
    if ($friendId == $userId) {
        echo "No puedes agregarte a ti mismo como amigo.";
        exit();
    }

    // Verifica si ya son amigos
    $q = "SELECT COUNT(*) FROM lista_amigos WHERE id_cuenta = ? AND amigo = ?";
    $stmt = $conexion->prepare($q);
    $stmt->bind_param('ii', $userId, $friendId);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "Ya son amigos.";
        exit();
    }

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
