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

    // Inserta al amigo en la lista de amigos
    $q = "INSERT INTO lista_amigos VALUES ($userId, $friendId)";
    $result = mysqli_query($conexion, $q);

} else {
    echo "Método de solicitud no válido.";
}

header("Location: profile.php");
?>
