<?php session_start(); ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Home</title>
</head>

<body>
    <div class="container showcase">
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");
        require_once("generate_carousel.php");

        echo '
        <main class="main-principal">
            <section class="container movies-container movies">';
                generateMovieSection($conexion, 'Películas más valoradas');
                generateMovieSection($conexion, 'Recientes');

            echo'
            </section>
            
        </main>
        ';
        ?>
        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>
    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>