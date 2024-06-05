<?php session_start(); ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Notificaciones</title>
</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("header.php");
        require_once("loginVerification.php");
        ?>
    </div>
        <main class="notificaciones-main">
            <h2>Notificaciones</h2>
            <div class="notificaciones">
                <div class="notificacion">
                    <p class="mensaje">¡Nueva película añadida a la categoría de Acción!</p>
                    <span class="fecha">02/06/2024</span>
                </div>
                <div class="notificacion">
                    <p class="mensaje">Pepe te añadió como amigo.</p>
                    <span class="fecha">02/06/2024</span>
                </div>
                <div class="notificacion">
                    <p class="mensaje">¡No te pierdas el estreno de la semana!</p>
                    <span class="fecha">01/06/2024</span>
                </div>
                
            </div>
            <div class="contacto">
                <h2>¿Tenés alguna duda o consulta?,</h2>
                <h2> ¡Contactanos!</h2>
                <a href="contacto.php">Contacto</a>
            </div>
        </main>
    


    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>