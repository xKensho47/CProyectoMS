<?php 
session_start();
include("conexion.php");
if(isset($_SESSION['id_cuenta'])){

    $id_cuenta = $_SESSION['id_cuenta'];

    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    LEFT JOIN 
        peli_favorita pf 
    ON 
        p.id_peli = pf.id_peli
    RIGHT JOIN 
        cuenta_usuario cu 
    ON 
        pf.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_cuenta
    ";

    $result = mysqli_query($conexion, $q);


} else{
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title>Ver más tarde</title>
</head>
<body>
    <div class="container">
        <?php
        include("header.php");
        ?>
    </div>
            <div class="volver-atras" style="float: left; margin-left: 20px;">
                <a href="profile.php" id="back-link" class="h2-animate"><i class="fas fa-arrow-left"></i>Perfil</a>
            </div>
        <main class="contenedor-principal-main animate-from-bottom">
            <h2 class="h2-animate">Favoritos</h2>
            <div class="contenedor-peliculas">
                <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = $row["poster"];
                            echo "
                                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                    <img src=' " . $imagePath . " ' alt='Movie Posters' class='imagen-deslizar'>
                                </a>
                                ";
                        }
                    } else {
                        echo '<p>No movies found.</p>';
                    }
                ?>
            </div>
        </main>  
</body>
</html>