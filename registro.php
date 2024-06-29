<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title>Registro</title>
    <script>
        function validarCorreo() {
            var email = document.querySelector('input[name="mail"]').value;
            if (!email.endsWith('.com')) {
                var mensajeExito = document.createElement('div');
                mensajeExito.textContent = 'El correo electrónico debe terminar con ".com"';
                mensajeExito.classList.add('mensaje-exito');
                var formulario = document.querySelector('.formulario-login');
                formulario.insertBefore(mensajeExito, formulario.firstChild);
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <?php include("header.php"); ?>
        <main class="main-form">
            <article class="article-form">
                <div class="div-form">
                    <form class="formulario-login" action="registro_process.php" method="post" onsubmit="return validarCorreo()">
                        <h1 class="h2-animate">Regístrate</h1>
                        <?php if (isset($_GET['error']) && $_GET['error'] === 'email') : ?>
                        <div class="mensaje-exito">El correo electrónico debe terminar con ".com"</div>
                        <?php endif; ?>
                        <input class="input-login" type="text" name="nombre" required placeholder="Ingrese su nombre" autocomplete="off" />
                        <input class="input-login" type="text" name="apellido" required placeholder="Ingrese su apellido" autocomplete="off" />
                        <input class="input-login" type="email" name="mail" required placeholder="Ingrese su email" autocomplete="off" />
                        <input class="input-login" type="text" name="nombre_usuario" maxlength="12"
                            placeholder="Ingrese su nombre de usuario" autocomplete="off" />
                        <input class="input-login" type="password" name="contraseña" maxlength="12"
                            placeholder="Ingrese su contraseña" />
                        <br>
                        <input class="boton-login" type="submit" value="Registrarse" name="registro" />
                        <a class="link-registro" href="login.php">¿Ya tienes usuario? Inicia sesión.</a>
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