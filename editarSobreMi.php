<?php
session_start();
include("conexion.php");

// Verificar si la sesión está iniciada y si 'id_cuenta' está definida
if (!isset($_SESSION['id_cuenta'])) {
    die("Error: No se ha iniciado sesión.");
}

// Consulta para obtener la información del usuario
$id_cuenta = $_SESSION['id_cuenta'];
$sql = "SELECT about_me FROM cuenta_usuario WHERE id_cuenta = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id_cuenta);
$stmt->execute();
$resultado = $stmt->get_result();
$row = $resultado->fetch_assoc();

// Manejar el formulario POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cuenta = $_POST['id_cuenta'];
    $about_me = $_POST['about_me'];

    $sql = "UPDATE cuenta_usuario SET about_me = ? WHERE id_cuenta = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('si', $about_me, $id_cuenta);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
