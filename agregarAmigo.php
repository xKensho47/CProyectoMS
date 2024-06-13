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

    // Selecciona un id_peli existente de la tabla de peliculas
    $peliculaQuery = "SELECT id_peli FROM peliculas ORDER BY RAND() LIMIT 1"; // Selecciona un id_peli aleatorio
    $peliculaResult = mysqli_query($conexion, $peliculaQuery);

    if ($peliculaResult && mysqli_num_rows($peliculaResult) > 0) {
        $peliculaRow = mysqli_fetch_assoc($peliculaResult);
        $idPeli = $peliculaRow['id_peli'];
    } else {
        echo "No se encontraron películas.";
        exit();
    }

    // Insertar la notificación con el id_peli seleccionado
    $mensaje = TRUE;
    $query = "INSERT INTO notificacion (usuario_envia, usuario_recibe, mensaje, id_peli, fecha) VALUES ($userId, $friendId, '$mensaje', '$idPeli', NOW())";
    $result = mysqli_query($conexion, $query);

    if (!$result) {
        echo "Error al enviar la notificación.";
        exit();
    }

    // Redirigir a profile.php después de enviar la notificación
    header('Location: profile.php');
} else {
    echo "Método de solicitud no válido.";
}
?>

