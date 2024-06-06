<?php
include("conexion.php");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_genero = $conexion->real_escape_string($_POST['id_genero']);
    $user_id = $conexion->real_escape_string($_POST['user_id']);

    // Verificamos si el checkbox fue marcado
    if (isset($_POST['genero_fav'])) {
        // Verificamos cuántos géneros favoritos tiene la cuenta
        $consulta = "SELECT COUNT(*) AS total FROM genero_favorito WHERE id_cuenta='$user_id'";
        $resultado = $conexion->query($consulta);

        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $total_generos = $fila['total'];

            // Si la cuenta ya tiene 3 géneros favoritos, mostramos un mensaje
            if ($total_generos >= 3) {
                header('Location: generos.php?status=success');
                exit();
            } else {
                // Si no ha alcanzado el límite, insertamos el nuevo género favorito
                $consulta_insertar = "INSERT INTO genero_favorito (id_genero, id_cuenta) VALUES ('$id_genero', '$user_id')";
                if ($conexion->query($consulta_insertar) === TRUE) {
                    header('Location: generos.php');
                    exit();
                } else {
                    echo "Error al insertar el género favorito: " . $conexion->error;
                }
            }
        } else {
            echo "Error al contar los géneros favoritos: " . $conexion->error;
        }
    } else {
        // Si el checkbox no está marcado, eliminamos el género favorito
        $consulta_eliminar = "DELETE FROM genero_favorito WHERE id_genero='$id_genero' AND id_cuenta='$user_id'";
        if ($conexion->query($consulta_eliminar) === TRUE) {
            header('Location: generos.php');
            exit();
        } else {
            echo "Error al eliminar el género favorito: " . $conexion->error;
        }
    }
} else {
    echo "El método de solicitud no es POST.";
}
?>






