<?php
if (!function_exists('mostrarfooter')) {
    function mostrarfooter($tipo_usuario){
        switch($tipo_usuario){
            case 'admin':
                echo'
                <footer>
                    <div class="footer-toggle">
                        <p class="copyright h2-animate"><span class="arrow-up h2-animate">&#9650;</span>&copy; 2024 CineFlow <span class="arrow-up h2-animate">&#9650;</span></p>
                    </div>
                    <nav class="info_footer">
                        <ul class="footer-links">
                            <li class="elementos_footer">
                                <a href="index.php">Inicio</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="generos.php">Generos</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="notificaciones.php">Notificaciones</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="crud_peliculas.php">CRUD</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="admin_usuarios.php">Usuarios</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="profile.php">Perfil</a>
                            </li>
                        </ul>
                        <section class="social-media">
                            <h4>Redes Sociales</h4>
                            <div class="redes_sociales">
                                <a href="#"><img class="red_social" src="./images/twitter.png" alt="Twitter"/></a>
                                <a href="#"><img class="red_social" src="./images/facebook.png" alt="Facebook"/></a>
                                <a href="#"><img class="red_social" src="./images/instagram.png" alt="Instagram"/></a>
                            </div>
                        </section>
                    </nav> 
                </footer>

                ';
            break;

            case 'autenticado':
                echo'                
                <footer>
                    <div class="footer-toggle">
                        <p class="copyright h2-animate"><span class="arrow-up h2-animate">&#9650;</span>&copy; 2024 CineFlow <span class="arrow-up h2-animate">&#9650;</span></p>
                    </div>
                    <nav class="info_footer">
                        <ul class="footer-links">
                            <li class="elementos_footer">
                                <a href="index.php">Inicio</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="generos.php">Generos</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="notificaciones.php">Notificaciones</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="profile.php">Perfil</a>
                            </li>
                        </ul>
                        <section class="social-media">
                            <h4>Redes Sociales</h4>
                            <div class="redes_sociales">
                                <a href="#"><img class="red_social" src="./images/twitter.png" alt="Twitter"/></a>
                                <a href="#"><img class="red_social" src="./images/facebook.png" alt="Facebook"/></a>
                                <a href="#"><img class="red_social" src="./images/instagram.png" alt="Instagram"/></a>
                            </div>
                        </section>
                    </nav>   
                </footer>     
                ';

                break;
            
            case 'invitado':
                echo'
                <footer>
                    <div class="footer-toggle">
                        <p class="copyright h2-animate"><span class="arrow-up h2-animate">&#9650;</span>&copy; 2024 CineFlow <span class="arrow-up h2-animate">&#9650;</span></p>
                    </div>
                    <nav class="info_footer">
                        <ul class="footer-links">
                            <li class="elementos_footer">
                                <a href="login.php">Iniciar Sesión</a>
                            </li>
                            <li class="elementos_footer">
                                <a href="registro.php">Registrarse</a>
                            </li>
                        </ul>
                        <section class="social-media">
                            <h4>Redes Sociales</h4>
                            <div class="redes_sociales">
                                <a href="#"><img class="red_social" src="./images/twitter.png" alt="Twitter"/></a>
                                <a href="#"><img class="red_social" src="./images/facebook.png" alt="Facebook"/></a>
                                <a href="#"><img class="red_social" src="./images/instagram.png" alt="Instagram"/></a>
                            </div>
                        </section>
                    </nav>
                </footer>
                ';
                break;

        }
    }
}