<?php session_start(); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
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
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <?php
        include("header.php");
        echo '
        <main class="main-form">
            <article class="article-form-login">
                <div class="div-form">
                    <form class="formulario-login log" action="login_process.php" method="post">
                        <h1 class="h2-animate">Iniciar sesión</h1>';
                        if (isset($_GET['status'])) {
                            // Verificar si el parámetro 'status' tiene el valor 'success'
                            if ($_GET['status'] === 'usuario_contra') {
                                echo '<div class="mensaje-exito ">LA CONTRASEÑA O EL NOMBRE DE USUARIO ES INCORRECTO.</div>';
                            }elseif ($_GET['status'] === 'no_existe'){
                                echo '<div class="mensaje-exito ">CUENTA NO REGISTRADA.</div>';
                            }
                        }
                        echo' <input class="input-login" name="nombre_usuario" type="text" maxlength="12" placeholder="Ingrese su nombre de usuario" required>
                        <input class="input-login" type="password" name="contraseña" maxlength="12" placeholder="Ingrese su contraseña" required>
                        <input class="boton-login" type="submit" value="Login" name="login">
                        <a class="link-registro" href="registro.php">¿Todavia no sos usuario? Registrate.</a>
                    </form>
                </div>
            </article>
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </main>  
        ';
        ?>
    </div>
    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>

    <?php include('footer.php'); ?>
</body>

</html>