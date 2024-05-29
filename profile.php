<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Mi Perfil</title>
</head>
<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");
        include("generate_carousel.php");

        echo '
        <main class="main-profile">
            <section class="userinfo-container">
                <aside class="profile-userinfo">
                    <section class="userinfo-data">
                        <article class="data-user">
                            <aside class="user-container">
                                <div class="user-avatar">
                                    <img class="profile-img" src="/placeholder.svg" alt="User Avatar"/>
                                </div>
                                <div class="user-info">
                                    <h1 class="info-name">John Doe</h1>
                                    <p class="info-username">@johndoe</p>
                                </div>
                            </aside>
                            <aside class="user-button">
                                <a href="logout.php"><button class="button-logout">Logout</button></a>
                            </aside>
                        </article>
                    </section>
                    <section class="userinfo-genres">
                        <h2 class="genres-tittle">Géneros favoritos</h2>
                        <div class="user-genres">
                            <span class="genres-favorites">Drama</span>
                            <span class="genres-favorites">Acción</span>
                            <span class="genres-favorites">Sci-Fi</span>
                        </div>
                    </section>
                    <section class="userinfo-description">
                        <h2 class="description-tittle">Sobre mí</h2>
                        <p class="description-aboutme">
                            Soy un apasionado del cine al que le encanta explorar nuevas películas y 
                            compartir mis pensamientos con los demás. En mi tiempo libre, puedes encontrarme 
                            seleccionando mi colección de favoritos, descubriendo gemas ocultas y discutiendo 
                            los últimos lanzamientos con mis amigos.
                        </p>
                    </section>
                </aside>

                <aside class="profile-userinfo2">
                    <section class="userinfo2-container">
                        <article class="container-menu">
                            <nav class="userinfo2-menu">
                                <ul class="userinfo2-menu-list checkbox-container" name="userinfo2-menu-list">
                                    <li class="userinfo2-menu-item"><input class="radio-profile" type="radio" id="movies" name="option-menu" value="movies" checked><label for="movies">Resumen del perfil</label></li>
                                    <li class="userinfo2-menu-item"><input class="radio-profile" type="radio" id="friends" name="option-menu" value="friends"><label for="friends">Lista de Amigos</label></li>
                                    <li class="userinfo2-menu-item"><input class="radio-profile" type="radio" id="discover" name="option-menu" value="discover"><label for="discover">Descubrir Amigos</label></li>
                                </ul>
                            </nav>
                        </article>
                        <article class="userinfo2-screen">

                            <script src="script/profileCarousel.js"></script>

                            <section class="userinfo2-movies option" id="userinfo2-movies">
                            ';
                            generateMovieSection($conexion, 'Continuar viendo');
                            generateMovieSection($conexion, 'Ver más tarde');
                            generateMovieSection($conexion, 'Favoritas');
                            
                            echo'
                            </section>
                            <section class="userinfo2-friends option" id="userinfo2-friends">
                                <section class="friends-container">
                                    <article class="friends-grid-container">
                                        <div class="friends-grid-item">
                                            prueba
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                        <div class="friends-grid-item">
                                        
                                        </div>
                                    </article>
                                </section>
                            </section>
                            <section class="userinfo2-discover option" id="userinfo2-discover">
                                <section class="discover-container">
                                    <article class="discover-grid-container">
                                        <div class="discover-grid-item">
                                            prueba
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                        <div class="discover-grid-item">
                                        
                                        </div>
                                    </article>
                                </section>
                            </section>
                        </article>
                    </section>
                </aside>
                <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
            </section>
        </main>';
        ?>
        <script src="script/jquery.js"></script>
        <script src="script/pop-ups.js"></script>
        <script src="script/botonTop.js"></script>
        <script src="script/profileOptions.js"></script>
        <script src="script/profileCarousel.js"></script>
    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
    
</body>
</html>