<?php
session_start();

include("conexion.php");
$id_peli = $_POST['pelicula_id'];
$id_usuario = $_POST['usuario_id'];
$id_amigo = $_POST['amigo_id'];
$fecha=date("Y-m-d");

$q = "SELECT 
    la1.id_cuenta AS usuario1,
    la1.amigo AS usuario2
FROM 
    lista_amigos la1
JOIN 
    lista_amigos la2 ON la1.id_cuenta = la2.amigo AND la1.amigo = la2.id_cuenta
WHERE 
    (la1.id_cuenta = $id_usuario AND la1.amigo = $id_amigo)
    OR (la1.id_cuenta = $id_amigo AND la1.amigo = $id_usuario)";

$son_amigos = mysqli_query($conexion,$q);


if(mysqli_num_rows($son_amigos) > 1){
    //son amigos mutuamente

    $datos_usuario = mysqli_query($conexion,"SELECT nombre_usuario FROM cuenta_usuario WHERE id_cuenta = $id_usuario");
    $usuario = mysqli_fetch_assoc($datos_usuario);
    

    $datos_pelicula = mysqli_query($conexion,"SELECT titulo FROM peliculas WHERE id_peli = $id_peli");
    $pelicula = mysqli_fetch_assoc($datos_pelicula);

    $mensaje = FALSE;

    $q_noti = "INSERT INTO notificacion (usuario_envia, usuario_recibe, mensaje,id_peli,fecha) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($q_noti);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("iiiss", $id_usuario, $id_amigo, $mensaje, $id_peli, $fecha);

    $stmt->execute();
        
    $stmt->close();


}


$conexion->close();

header("Location: detalle_peli.php?id_peli=" . $id_peli);


?>