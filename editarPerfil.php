<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos del formulario
    $nuevo_nombre_usuario = trim($_POST["nombre_usuario"]);
    $nuevo_email = trim($_POST["email"]);
    $nueva_contrasena = trim($_POST["password"]);

    // Validar que los campos no estén vacíos
    if (empty($nuevo_nombre_usuario) || empty($nuevo_email) || empty($nueva_contrasena)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Aquí puedes agregar más validaciones, como la longitud mínima de la contraseña o el formato del correo electrónico

    // Conectar a la base de datos (reemplaza los valores con los de tu configuración)
    $servername = "localhost";
    $username = "nombre_usuario";
    $password = "contraseña";
    $dbname = "nombre_base_de_datos";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta para actualizar el perfil
    $consulta = "UPDATE cuenta_usuario SET nombre_usuario=?, email=?, contraseña=? WHERE id_cuenta=?";

    // Preparar la declaración
    $stmt = $conexion->prepare($consulta);

    // Enlazar los parámetros
    $stmt->bind_param("sssi", $nuevo_nombre_usuario, $nuevo_email, $nueva_contrasena, $_SESSION['id_cuenta']);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Perfil actualizado correctamente.";
    } else {
        echo "Error al actualizar el perfil: " . $stmt->error;
    }

    // Cerrar la conexión y la declaración
    $stmt->close();
    $conexion->close();
}
?>
