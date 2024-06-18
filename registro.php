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
    <title>Registro</title>
</head>

<body>
    <div class="container">
        <?php
        include("header.php");
        ?>
        <main class="main-form">
            <article class="article-form">
                <div class="div-form">
                    <form class="formulario-login" action="registro_process.php" method="post">
                        <h1>Registrate</h1>
                            <?php if (isset($_GET['status'])) {
                                // Verificar si el parámetro 'status' tiene el valor 'success'
                                if ($_GET['status'] === 'ocupado') {
                                    echo '<div class="mensaje-exito"> EL NOMBRE DE USUARIO O CORREO YA ESTA REGISTRADO.</div>';
                                }
                            }
                        ?>
                        <input class="input-login" type="text" name="nombre" required placeholder="Ingrese su nombre" />
                        <input class="input-login" type="text" name="apellido" required placeholder="Ingrese su apellido" />
                        <input class="input-login" type="email" name="mail" required placeholder="Ingrese su email" />
                        <input class="input-login" type="text" name="nombre_usuario" maxlength="12" placeholder="Ingrese su nombre de usuario" />
                        <input class="input-login" type="password" name="contraseña" maxlength="12" placeholder="Ingrese su contraseña" />
                        <br>
                        <input class="boton-login" type="submit" value="Registrarse" name="registro" />
                        <a class="link-registro" href="login.php">¿Ya tenes usuario? Inicia sesion.</a>
                    </form>
                </div>
            </article>
        </main>

    </div>
        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>

        <?php include('footer.php'); ?>
</body>

</html>