<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cuenta = $_SESSION['id_cuenta'];
    $amigo_id = $_POST['amigo_id'];

    // Consulta para eliminar al amigo de la lista
    $q = "DELETE FROM lista_amigos WHERE id_cuenta = ? AND amigo = ?";

    $stmt = $conexion->prepare($q);
    if (!$stmt) {
        echo "Error de preparación de consulta: " . $conexion->error;
        exit();
    }

    $stmt->bind_param('ii', $id_cuenta, $amigo_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
