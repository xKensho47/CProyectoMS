<?php session_start();
include('conexion.php');
?>
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
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title>Home</title>
</head>

<body>
    <div class="container showcase">
        <?php

        include("header.php");
        require_once("loginVerification.php");
        require_once("CCarousel.php");

        echo '
        <main class="main-principal">
            <section class="movies-containerp movies" id="movies-container movies">';

            $titles = array("Películas más valoradas", "Recientes");

            $carouseles = new CCarousel($conexion);
            
            for ($i = 0; $i < count($titles); $i++) {
                $carouseles->generateMovieSection($conexion, $titles[$i]);
                
            }

            include_once("profileFunctions.php");

            //continueCarousel($conexion);
            favoritesCarousel($conexion);
          
        echo '
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