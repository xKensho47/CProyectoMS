<?php
include('conexion.php');
include('footerOptions.php');

// Verificar si hay una sesión de usuario iniciada
if (isset($_SESSION['id_cuenta'])) {
    // Obtener el id_cuenta del usuario de la sesión
    $id_cuenta = $_SESSION['id_cuenta'];

    // Consultar el id_tipo del usuario en la tabla de cuenta_usuario y usuarios
    $consulta_tipo_usuario = 
    "SELECT 
        u.id_tipo 
    FROM 
        cuenta_usuario c
    JOIN
        usuarios u
    ON
        c.id_usuario = u.id_usuario
    WHERE 
        c.id_cuenta = ?
    ";
    $stmt_tipo_usuario = $conexion->prepare($consulta_tipo_usuario);
    $stmt_tipo_usuario->bind_param('i', $id_cuenta);
    $stmt_tipo_usuario->execute();
    $stmt_tipo_usuario->bind_result($id_tipo);
    $stmt_tipo_usuario->fetch();
    $stmt_tipo_usuario->close();

    // Mostrar el encabezado correspondiente según el tipo de usuario
    if ($id_tipo == 1) {
        mostrarfooter("admin");
    } elseif ($id_tipo == 2) {
        mostrarfooter("autenticado");
    } else {
        mostrarfooter("invitado");
    }
} else {
    // Si no hay sesión de usuario iniciada, mostrar el encabezado para invitados
    mostrarfooter("invitado");
}
?>
<script>
    // history.replaceState(null, null, location.pathname);
</script>
