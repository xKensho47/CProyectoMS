<?php session_start();?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Log in</title>
    </head>

    <body>
        <div class="container">
            <?php
                include("conexion.php");
                include("comprobar_usuario.php");
                include("login.php");
                
                echo'
                <main class="main-login">

                    <div class="div-form">
                        <form class="formulario-login" action="" method="post">
                            <h1>Iniciar sesión</h1>
                            <input class="input-login" name="usuario" type="text" maxlength="12" placeholder="Ingrese su nombre de usuario" required>
                            <input class="input-login" type="password" name="password" maxlength="12" placeholder="Ingrese su contraseña" required>
                            <input class="boton-login" type="submit" value="Login" name="login">
                            <a class="link-registro" href="form_registro.php">¿Todavia no sos usuario? Registrate.</a>
                        </form>
                    </div>
                    

                    
                    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
                </main>  
                ';
            ?>          
        </div>
        <script src="script/jquery.js"></script>
        <script src="script/pop-ups.js"></script>
        <script src="script/botonTop.js"></script>

        <footer>
            <p>&copy; CineFlow 2024</p>
        </footer>
    </body>
</html>