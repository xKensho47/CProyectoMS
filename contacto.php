<?php session_start(); ?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <title>Formulario de Contacto</title>
</head>

<body>
    
    <div class="container">
        
        <?php
        include("conexion.php");
        include("header.php");

            echo '
                <main>
                    <div class="volver-atras contacto-flecha ">
                        <a href="#" id="back-link" class="h2-animate"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="div-form">
                        <form class="formulario-login log" action="guardar_form_contacto.php" method="post">
                            <h1>Contáctate con Nosotros</h1>
                            <input type="hidden" name="id_cuenta" value='.($_SESSION['id_cuenta']).'>
                             <div class="input-with-icon">
                                <input class="input-login" name="asunto" type="text" maxlength="40" placeholder="Asunto" required>
                                <i class="fi fi-sr-file-edit"></i>
                            </div>
                             <div class="input-with-icon">
                                <textarea class="input-login" name="mensaje" type="text" maxlength="300" placeholder="Mensaje" required cols="30" rows="5"></textarea>
                                <i class="fi fi-sr-comment-alt-dots"></i>
                            </div>
                            <input class="boton-login" type="submit" value="Enviar" name="enviar">
                        </form>
                    </div>
                    
                </main>  
            ';

        ?>
    </div>  

    <?php include('footer.php'); ?>
    <script src="script/volverAtras.js"></script>
</body>

</html>