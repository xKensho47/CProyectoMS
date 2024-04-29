<?php session_start();?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
        <title>Peliculas</title>
    </head>

    <body>
        <div class="container">
            <?php
                include("conexion.php");
                include("opciones.php");

                if(isset($_SESSION['id_usuario']))
                {
                    $id_usuario = $_SESSION['id_usuario'];
                    
                    $q = "SELECT * from usuario where id_usuario = '$id_usuario' and administrador =1";
                    $resultado=mysqli_num_rows(mysqli_query($conexion,$q));
                    if($resultado!=0){echo $opciones_admin; $_SESSION['administrador'] = 1;}
                    else{
                        echo $opciones;
                        $_SESSION['administrador'] = 0;
                    } 
                }
                else {
                    echo $opciones_sin_sesion;
                    $_SESSION['administrador'] = 0;
                }

            ?>
            <main>

            </main>
        
           

            <script src="script/jquery.js"></script>
            <script src="slick/slick.min.js"></script>
            <script src="script/script.js"></script>
            <script src="script/botonTop.js"></script>
        </div>
    </body>
    <footer>
        <div class="menu__item"><a href="contacto.php">Contacto</a></div>
    </footer>
    <p>&copy; CineFlow 2024</p>
    
</html>