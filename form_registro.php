
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Registro</title>
    </head>
    <body >
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
                               
            ?>
         
            <form class="formulario-login" action="" method="post" >
               <h1>Registrate</h1>
               <?php
               include("conexion.php");
               include("registro.php");
               ?>
                <input class="input-login" type="text" name="nombre" required placeholder="Ingrese su nombre"/>

                <input class="input-login" type="text" name="apellido" required placeholder="Ingrese su apellido"/>
                
                <input class="input-login" type="email" name="mail" required placeholder="Ingrese su email"/>
                
                <input class="input-login" name="usuario" type="text" maxlength="12" placeholder="Ingrese su nombre de usuario"/>
                
                <input class="input-login" type="password" name="password" maxlength="12" placeholder="Ingrese su contraseña"/>
                
                <br>
                <input class="boton-login" type="submit" value="Registrarse" name="registro"/>	
            </form>
            <a class="link-registro" href="login.php">¿Ya tenes usuario? Inicia sesion.</a>
        </div>   
        <script src="script/jquery.js"></script>
        <script src="script/pop-ups.js"></script>
        <script src="script/botonTop.js"></script>     
    </body>
    <footer>
       <a href="#" class="a"><i class="fa-brands fa-youtube item" style="color: #ffffff;"></i></a>
        <a href="#" class="a"><i class="fa-brands fa-facebook item" style="color: #ffffff;"></i></a>
        <a href="#" class="a"><i class="fa-brands fa-instagram item" style="color: #ffffff;"></i></a>
        <a href="#" class="a"><i class="fa-brands fa-twitter item" style="color: #ffffff;"></i></a>
    </footer>
</html>