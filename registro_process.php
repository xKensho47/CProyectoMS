<?php
session_start();
include('conexion.php');

echo'
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Overlay Registro</title>
</head>

<script src="script/jquery.js"></script>
<script src="slick/slick.min.js"></script>
<script src="script/script.js"></script>
<script src="script/botonTop.js"></script>
';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $mail = $_POST['mail'];
    $contraseña = $_POST['contraseña'];
    // id_tipo correspondiente al rol "normal" para que le quede por defecto.
    $id_tipo = 2;
    // id_img por defecto para una imagen de perfil genérica.
    $id_img = null; // Asegúrate de que esta imagen exista en la tabla `img_perfil`.

    // Verificar si el correo electrónico o el nombre de usuario ya están en uso
    $q = "SELECT id_usuario FROM usuarios WHERE mail = ? OR id_usuario IN (SELECT id_usuario FROM cuenta_usuario WHERE nombre_usuario = ?)";
    $stmt = $conexion->prepare($q);
    if (!$stmt) {
        echo "Error de preparación de consulta: " . $conexion->error;
        exit();
    }
    $stmt->bind_param('ss', $mail, $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El email o el nombre de usuario ya están en uso
        echo "
        <div class='overlay show' id='overlay-usuario-repe'>
            <div class='popup'>
                <span class='popup-close' id='pop-usuario-repe'>&times;</span>
                <div class='popup-content'>
                    <div class='descripcion_accion'><p>Ups! este nombre de usuario o mail ya están ocupados 🙁 <br> Prueba con otro!</p></div>
                </div>
                <div class='popup-buttons'>
                    <a href='registro.php' id='boton-usuario-repe' class='boton-cancelo'>Intentar denuevo</a>
                </div>
            </div>
        </div>
        ";
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

            $q_insertar_cuenta = "INSERT INTO cuenta_usuario (about_me, cant_amigos, id_usuario, id_img, nombre_usuario, contraseña) VALUES ('', 0, ?, ?, ?, ?)";
            $stmt_insertar_cuenta = $conexion->prepare($q_insertar_cuenta);
            if (!$stmt_insertar_cuenta) {
                throw new Exception("Error de preparación de consulta: " . $conexion->error);
            }
            $stmt_insertar_cuenta->bind_param('iiss', $id_usuario, $id_img, $nombre_usuario, $contraseña_hash);
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
?>
