<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['id_cuenta'];
    $genero_fav =$_POST['id_genero']; 

    // Procesar la información y guardar en la base de datos
    $consulta = "INSERT INTO genero_favorito (id_genero, id_cuenta) VALUES (?, ?)"; // Esto evita duplicados
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param('ii', $genero_fav,$user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Género favorito guardado exitosamente.";
    } else {
        echo "Error al guardar el género favorito.";
    }

    $stmt->close();
    $conexion->close();
}
?>