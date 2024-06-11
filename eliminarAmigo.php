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


    // Elimina al amigo en la lista de amigos
    $q = "DELETE FROM lista_amigos WHERE amigo = $friendId AND id_cuenta = $userId";
    $result = mysqli_query($conexion, $q);
    //borro los 2 registros
    $q = "DELETE FROM lista_amigos WHERE id_cuenta = $friendId AND amigo = $userId";
    $result = mysqli_query($conexion, $q);

} else {
    echo "Método de solicitud no válido.";
}

header("Location: profile.php");
?>
