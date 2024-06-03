<?php
session_start();
include("conexion.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $q = "SELECT id_cuenta, id_img, nombre_usuario, mail, contraseña FROM cuenta_usuario WHERE id_cuenta = ?";
    $stmt = $conexion->prepare($q);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No se encontraron datos']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}

$conexion->close();
?>
