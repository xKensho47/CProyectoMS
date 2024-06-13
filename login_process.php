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
    <title>Overlay Login</title>
</head>

<script src="script/jquery.js"></script>
<script src="slick/slick.min.js"></script>
<script src="script/script.js"></script>
<script src="script/botonTop.js"></script>
';

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
            header('Location: login.php?status=usuario_contra');
            exit();
        }
    } else {
        header('Location: login.php?status=no_existe');
        exit();
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
