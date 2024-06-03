<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $avatar = $_POST['id_img'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $mail = $_POST['mail'];
    $contraseña = $_POST['contraseña'];

    $q = "UPDATE cuenta_usuario SET id_img = ?, nombre_usuario = ?, mail = ?, contraseña = ? WHERE id_cuenta = ?";
    $stmt = $conexion->prepare($q);
    $stmt->bind_param('ssssi', $avatar, $nombre_usuario, $mail, $contraseña, $id);

    if ($stmt->execute()) {
        echo "Perfil actualizado correctamente.";
    } else {
        echo "Error al actualizar el perfil: " . $conexion->error;
    }

    $stmt->close();
}

$conexion->close();
header("Location: profile.php");
?>
