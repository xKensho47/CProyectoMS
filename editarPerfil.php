<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cuenta = $_POST['id_cuenta'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $id_img = $_POST['id_img'];

    // Verificar si el nombre de usuario ya existe en la base de datos
    $sql_check_user = "SELECT id_cuenta FROM cuenta_usuario WHERE nombre_usuario = ? AND id_cuenta != ?";
    $stmt_check_user = $conexion->prepare($sql_check_user);
    $stmt_check_user->bind_param('si', $nombre_usuario, $id_cuenta);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if ($result_check_user->num_rows > 0) {
        // Si el nombre de usuario ya existe, mostrar una alerta y redireccionar
        echo "<script>alert('Ya existe otro usuario con ese nombre.'); window.location.href = 'profile.php';</script>";
        exit();
    } else {
        if (!empty($contraseña)) {
            // Encriptar la contraseña antes de guardarla
            $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);
            // Actualizar todos los datos, incluyendo la contraseña
            $sql = "UPDATE cuenta_usuario SET nombre_usuario = ?, contraseña = ?, id_img = ? WHERE id_cuenta = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('ssii', $nombre_usuario, $contraseña_hashed, $id_img, $id_cuenta);
        } else {
            // Actualizar todos los datos excepto la contraseña
            $sql = "UPDATE cuenta_usuario SET nombre_usuario = ?, id_img = ? WHERE id_cuenta = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('sii', $nombre_usuario, $id_img, $id_cuenta);
        }

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }

        $stmt->close();
    }

    $stmt_check_user->close();
    $conexion->close();
}
?>
