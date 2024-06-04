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
    <title>Formulario de Contacto</title>
</head>

<body>
    
    <div class="container">
        
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");

            echo '
                <main>

                    <div class="div-form">
                        <form class="formulario-login log" action="guardar_form_contacto.php" method="post">
                            <h1>Contáctate con Nosotros</h1>
                            <input type="hidden" name="id_usuario" value='.($_SESSION['id_usuario']).'>
                            <input class="input-login" name="nombre" type="text" maxlength="12" placeholder="Nombre" required>
                            <input class="input-login" name="asunto" type="text" maxlength="12" placeholder="Asunto" required>
                            <textarea class="input-login" name="mensaje" type="text" maxlength="100" placeholder="Mensaje" required cols="30" rows="5"></textarea>
                            <input class="boton-login" type="submit" value="Enviar" name="enviar">
                        </form>
                    </div>
                    
                </main>  
            ';

        ?>
    </div>  

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
    
</body>

</html>