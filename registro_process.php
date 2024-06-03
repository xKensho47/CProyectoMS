<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $mail = $_POST['mail'];
    $contraseña = $_POST['contraseña'];
    // id_tipo correspondiente al rol "normal" para que le quede por defecto.
    $id_tipo = 2;
    // id_img por defecto para una imagen de perfil genérica.
    $id_img = ""; // Asegúrate de que esta imagen exista en la tabla `img_perfil`.

    // Verificar si el correo electrónico ya está en uso
    $q = "SELECT id_usuario FROM usuarios WHERE mail = ?";
    $stmt = $conexion->prepare($q);
    if (!$stmt) {
        echo "Error de preparación de consulta: " . $conexion->error;
        exit();
    }
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El email ya está en uso
        echo "El email ya está en uso. Por favor, elige otro.";
        $stmt->close(); // Cerrar aquí después de la verificación
    } else {
        // Insertar el nuevo usuario en la base de datos
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

        $conexion->begin_transaction();

        try {
            $q_insertar_usuario = "INSERT INTO usuarios (nombre, apellido, mail, id_tipo) VALUES (?, ?, ?, ?)";
            $stmt_insertar_usuario = $conexion->prepare($q_insertar_usuario);
            if (!$stmt_insertar_usuario) {
                throw new Exception("Error de preparación de consulta: " . $conexion->error);
            }
            $stmt_insertar_usuario->bind_param('sssi', $nombre, $apellido, $mail, $id_tipo);
            $stmt_insertar_usuario->execute();

            $id_usuario = $conexion->insert_id;

            $q_insertar_cuenta = "INSERT INTO cuenta_usuario (about_me, cant_amigos, id_usuario, nombre_usuario, contraseña) VALUES ('', 0, ?, ?, ?)";
            $stmt_insertar_cuenta = $conexion->prepare($q_insertar_cuenta);
            if (!$stmt_insertar_cuenta) {
                throw new Exception("Error de preparación de consulta: " . $conexion->error);
            }
            $stmt_insertar_cuenta->bind_param('iss', $id_usuario, $nombre_usuario, $contraseña_hash);
            $stmt_insertar_cuenta->execute();


            $conexion->commit();

            header('Location: login.php');
            exit();
        } catch (Exception $e) {
            $conexion->rollback();
            echo "Error en la inserción: " . $e->getMessage();
        }

        // Cerrar los statements después de las operaciones
        if (isset($stmt_insertar_usuario) && $stmt_insertar_usuario !== false) {
            $stmt_insertar_usuario->close();
        }
        if (isset($stmt_insertar_cuenta) && $stmt_insertar_cuenta !== false) {
            $stmt_insertar_cuenta->close();
        }
    }

    $conexion->close(); // Cerrar la conexión después de completar todas las operaciones
} else {
    echo "Método de solicitud no válido.";
}
