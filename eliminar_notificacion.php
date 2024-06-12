<?php
// Verificar si la solicitud es por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario_envia = $_POST['usuario_envia'];
    $usuario_recibe = $_POST['usuario_recibe'];
    $tipo_mensaje = $_POST['tipo_mensaje'];
    $id_peli = $_POST['id_peli'];
    $fecha = $_POST['fecha'];
    
    // Verificar si la acción es para eliminar la notificación
    if ($_POST['accion'] == 'eliminar') {
        // Conectar a la base de datos (debes tener una conexión establecida)
        include("conexion.php");

        // Query para eliminar la notificación
        $query = "DELETE FROM notificacion 
                  WHERE usuario_envia = $usuario_envia 
                  AND usuario_recibe = $usuario_recibe 
                  AND mensaje = $tipo_mensaje 
                  AND id_peli = $id_peli 
                  AND fecha = '$fecha'";

        // Ejecutar la consulta
        if ($conexion->query($query) === TRUE) {
            // Devolver una respuesta HTTP 200 para indicar que la operación fue exitosa
            http_response_code(200);
            // Verificar si se presionó el botón "Ver" o "X" para redirigir a la página correspondiente
            if(isset($_POST['ver'])){
                header("Location: detalle_peli.php?id_peli=$id_peli");
            } else {
                header("Location: notificaciones.php");
            }
            exit; // Detener la ejecución del script después de la redirección
        } else {
            // Si hay un error, devolver una respuesta HTTP 500
            http_response_code(500);
            echo "Error al eliminar la notificación: " . $conexion->error;
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        // Si la acción no es para eliminar, redirigir a detalle_pelicula.php
        header("Location: detalle_peli.php?id_peli=$id_peli");
        exit; // Detener la ejecución del script después de la redirección
    }
} else {
    // Si no es una solicitud POST, devolver un error HTTP 405 (Método no permitido)
    http_response_code(405);
    echo "Método no permitido";
}
?>





