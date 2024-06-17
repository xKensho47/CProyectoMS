<?php
if (!function_exists('mostrarfooter')) {
    function mostrarfooter($tipo_usuario){
        switch($tipo_usuario){
            case 'admin':
                echo'
                <footer>
                    <div class="info_footer">
                    <div class="elementos_footer">
                        <a href="index.php">Inicio</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="generos.php">Generos</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="notificaciones.php">Notificaciones</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="profile.php">Perfil</a>
                    </div>
                    <div>
                    <h4>Redes Sociales</h4>
                    <div class="redes_sociales">
                        <a><img class="red_social" src="./images/twitter.png"/></a>
                        <a><img class="red_social" src="./images/facebook.png"/></a>
                        <a><img class="red_social" src="./images/instagram.png"/></a>
                    </div>
                    </div>
                    </div>
                    <p class="copyright">&copy; 2024 CineFlow </p>
                </footer>
                ';
            break;

            case 'autenticado':
                echo'
                <footer>
                <footer>
                    <div class="info_footer">
                    <div class="elementos_footer">
                        <a href="index.php">Inicio</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="generos.php">Generos</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="notificaciones.php">Notificaciones</a>
                    </div>
                    <div class="elementos_footer">
                        <a href="profile.php">Perfil</a>
                    </div>
                    <div>
                    <h4>Redes Sociales</h4>
                    <div class="redes_sociales">
                        <a><img class="red_social" src="./images/twitter.png"/></a>
                        <a><img class="red_social" src="./images/facebook.png"/></a>
                        <a><img class="red_social" src="./images/instagram.png"/></a>
                    </div>
                    </div>
                    </div>
                    <p class="copyright">&copy; 2024 CineFlow </p>
                </footer>
                </footer>
                ';

                break;
            
            case 'invitado':
                echo'
                <footer>
                    <div class="info_footer">
                    <div class="elementos_footer">
                    <a href="login.php">Iniciar Sesión</a>
                    </div>
                    <div class="elementos_footer">
                    <a href="registro.php">Registrarse</a>
                    </div>
                    <div>
                        <h4>Redes Sociales</h4>
                        <div class="redes_sociales">
                            <a><img class="red_social" src="./images/twitter.png"/></a>
                            <a><img class="red_social" src="./images/facebook.png"/></a>
                            <a><img class="red_social" src="./images/instagram.png"/></a>
                        </div>
                    </div>
                    </div>
                    <p class="copyright">&copy; 2024 CineFlow </p>
                </footer>
                ';
                break;

        }
    }
}