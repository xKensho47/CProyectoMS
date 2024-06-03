<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar las credenciales del usuario
    $q = "SELECT 
            c.id_cuenta, 
            c.nombre_usuario, 
            c.contraseña, 
            t.tipo_usuario 
        FROM 
            cuenta_usuario c
        JOIN  
            usuarios u 
        ON 
            c.id_usuario = u.id_usuario
        JOIN
            tipo_usuario t
        ON
            u.id_tipo = t.id_tipo
        WHERE 
            c.nombre_usuario = ?";

    $stmt = $conexion->prepare($q);
    if (!$stmt) {
        echo "Error de preparación de consulta: " . $conexion->error;
        exit();
    }
    $stmt->bind_param('s', $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_cuenta, $nombre_usuario_db, $contraseña_hash, $tipo_usuario);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($contraseña, $contraseña_hash)) {
            // Autenticación exitosa, almacenar datos en la sesión
            $_SESSION['id_cuenta'] = $id_cuenta;
            $_SESSION['nombre_usuario'] = $nombre_usuario_db;
            $_SESSION['tipo_usuario'] = $tipo_usuario;

            // Redirigir a la página principal o panel de usuario
            header('Location: index.php');
            exit();
        } else {
            echo 'Error de ingreso! No coinciden los datos. Revise el usuario o contraseña.';
        }
    } else {
        echo 'Parece que no existe este Usuario!';
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
