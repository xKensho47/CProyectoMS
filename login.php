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
                include("opciones.php");

                if(isset($_SESSION['id_usuario']))
                {
                    header('Location: Index.php');                                    
                }
                else {echo $opciones_sin_sesion;
                    $_SESSION['administrador'] = 0;
                } 

                echo '
                <main class="main-login">

                    <div class="div-form">
                        <form class="formulario-login" action="" method="post">
                            <h1>Iniciar sesión</h1>
                            <input class="input-login" name="usuario" type="text" maxlength="12" placeholder="Ingrese su nombre de usuario" required>
                            <input class="input-login" type="password" name="password" maxlength="12" placeholder="Ingrese su contraseña" required>
                            <input class="boton-login" type="submit" value="Login" name="login">
                            <a class="link-registro" href="registro.php">¿Todavia no sos usuario? Registrate.</a>
                        </form>
                    </div>
                    ';

                    if(isset($_POST['login'])){
                        $usuario = $_POST['usuario'];
                        $contra= md5($_POST['password']);
            
                        $usuario_regis = mysqli_query($conexion,"SELECT id_usuario from usuario where nombre_usuario = '$usuario'");
                        $pregunta = mysqli_query($conexion,"SELECT id_usuario , nombre_usuario, mail from usuario where nombre_usuario = '$usuario' and contraseña = '$contra'");
                        if($usuario_regis->num_rows == 0 ){
                            echo'
                            <div class="overlay show" id="overlay-mail-nuevo">
                                <div class="popup">
                                    <span class="popup-close" id="pop-mail-nuevo">&times;</span>
                                    <div class="popup-content">
                                        <div class="descripcion_accion">
                                            <p>Parece que no existe este Usuario! 😮</p>
                                        </div>
                                    </div>
                                    <div class="popup-buttons">
                                        <form method="POST" action="registro.php">
                                            <button>Crear Cuenta</button>
                                        </form>
                                        <button id="boton-mail-nuevo">Intentar denuevo con otro Usuario</button>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        else if ( $pregunta->num_rows == 0){
                            echo'
                            <div class="overlay show" id="overlay-incorrecto">
                                <div class="popup">
                                    <span class="popup-close" id="pop-incorrecto">&times;</span>
                                    <div class="popup-content">
                                        <div class="descripcion_accion"><p>Error de ingreso! No coinciden los datos 😢<br>Revise el usuario o contraseña</p></div>
                                    </div>
                                    <div class="popup-buttons">
                                        <button id="boton-incorrecto">Intentar denuevo</button>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        else if ( $pregunta->num_rows == 1){
                            $row = $pregunta->fetch_assoc();
                            $_SESSION['id_usuario'] = $row['id_usuario'];
                            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
                            $_SESSION['mail_usuario'] = $row['mail'];
                            header('Location: index.php');                            
                        }
                    }
                    
                    echo'
                    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
                </main>
                <footer>
                    <p>&copy; SPELIS 2024 </p>
                </footer>
                        '; 
            ?>
        </div>
        <script src="script/jquery.js"></script>
        <script src="script/pop-ups.js"></script>
        <script src="script/botonTop.js"></script>
    </body>
</html>