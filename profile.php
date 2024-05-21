<?php session_start(); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="moviely favicon.png" type="image/ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" href="css\font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Mi Perfil</title>
</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");

        echo '
                <main class="main-profile">
                    <section class="container profile-container profile">
                        <article class="profile-usser">
                            <div class="profile-avatar">
                                <img class="profile-img" src="/placeholder.svg" alt="User Avatar"/>
                            </div>
                            <div class="profile-data">
                                <h1 class="profile-name">John Doe</h1>
                                <p class="profile-ussername">@johndoe</p>
                            </div>

                            <div class="profile-button">
                                <a href="logout.php"><button class="button-logout">Logout</button></a>
                            </div>
                        </article>
                        <hr>
                        <article class="profile-info">
                            <aside class="profile-aboutme">
                                <h2 class="tittle">Sobre mí</h2>
                                <p class="profile-description">
                                    Soy un apasionado del cine al que le encanta explorar nuevas películas y 
                                    compartir mis pensamientos con los demás. En mi tiempo libre, puedes encontrarme 
                                    seleccionando mi colección de favoritos, descubriendo gemas ocultas y discutiendo 
                                    los últimos lanzamientos con mis amigos.
                                </p>
                            </aside>
                            <aside class="profile-generos">
                                <h2 class="tittle">Géneros favoritos</h2>
                                <div class="generos-container">
                                    <span class="generos-name">Drama</span>
                                    <span class="generos-name">Acción</span>
                                    <span class="generos-name">Sci-Fi</span>
                                    <span class="generos-name">Comedia</span>
                                </div>
                            </aside>
                        </article>
                        <article class="profile-friends">
                            <h2 class="tittle">Amigos</h2>
                            <div class="container friends-container">
                                <aside class="friends-data">
                                    <div class="friends-avatar">
                                        <img class="friends-img" src="/placeholder.svg" alt="Friend 1"/>
                                    </div>
                                    <p class="friends-name">Jane Doe</p>
                                </aside>
                                <aside class="friends-data">
                                    <div class="friends-avatar">
                                        <img class="friends-img" src="/placeholder.svg" alt="Friend 2"/>
                                    </div>
                                    <p class="friends-name">Bob Smith</p>
                                </aside>
                                <aside class="friends-data">
                                    <div class="friends-avatar">
                                        <img class="friends-img" src="/placeholder.svg" alt="Friend 3"/>
                                    </div>
                                    <p class="friends-name">Emily Johnson</p>
                                </aside>
                                <aside class="friends-data">
                                    <div class="friends-avatar">
                                        <img class="friends-img" src="/placeholder.svg" alt="Friend 4"/>
                                    </div>
                                    <p class="friends-name">Michael Brown</p>
                                </aside>
                            </div>
                        </article>
                    </section>
                    <section class="container profile-container favorite">
                        <article class="favorite-usser">
                            <h2 class="tittle">Favoritas</h2>
                            <div class="favorite-container">
                                <article class="favorite-data">
                                    <img class="favorite-img" src="/placeholder.svg" alt="Movie 1"/>
                                    <div class="favorite-name">
                                        <h3 class="favorite-tittle">The Shawshank Redemption</h3>
                                    </div>
                                </article>
                                <article class="favorite-data">
                                    <img class="favorite-img" src="/placeholder.svg" alt="Movie 2"/>
                                    <div class="favorite-name">
                                        <h3 class="favorite-tittle">Inception</h3>
                                    </div>
                                </article>
                                <article class="favorite-data">
                                    <img class="favorite-img" src="/placeholder.svg" alt="Movie 3"/>
                                    <div class="favorite-name">
                                        <h3 class="favorite-tittle">The Dark Knight</h3>
                                    </div>
                                </article>
                                <article class="favorite-data">
                                    <img class="favorite-img" src="/placeholder.svg" alt="Movie 4"/>
                                    <div class="favorite-name">
                                        <h3 class="favorite-tittle">Forrest Gump</h3>
                                    </div>
                                </article>
                            </div>
                        </article>
                    </section>
                    <section class="container profile-container later">
                        <article class="later-usser">
                            <h2 class="tittle">Ver más tarde</h2>
                            <div class="later-container">
                                <article class="later-data">
                                    <img class="later-img" src="/placeholder.svg" alt="Movie 5"/>
                                    <div class="later-name">
                                        <h3 class="later-tittle">The Godfather</h3>
                                    </div>
                                </article>
                                <article class="later-data">
                                    <img class="later-img" src="/placeholder.svg" alt="Movie 6"/>
                                    <div class="later-name">
                                        <h3 class="later-tittle">Pulp Fiction</h3>
                                    </div>
                                </article>
                                <article class="later-data">
                                    <img class="later-img" src="/placeholder.svg" alt="Movie 7"/>
                                    <div class="later-name">
                                        <h3 class="later-tittle">The Lord of the Rings</h3>
                                    </div>
                                </article>
                                <article class="later-data">
                                    <img class="later-img" src="/placeholder.svg" alt="Movie 8"/>
                                    <div class="later-name">
                                        <h3 class="later-tittle">The Silence of the Lambs</h3>
                                    </div>
                                </article>
                            </div>
                        </article>
                    </section>
                    <section class="container profile-container continue">
                        <article class="continue-usser">
                            <h2 class="tittle">Continuar viendo</h2>
                            <div class="continue-container">
                                <article class="continue-data">
                                    <img class="continue-img" src="/placeholder.svg" alt="Movie 9"/>
                                    <div class="continue-name">
                                        <h3 class="continue-tittle">The Shining</h3>
                                    </div>
                                </article>
                                <article class="continue-data">
                                    <img class="continue-img" src="/placeholder.svg" alt="Movie 10"/>
                                    <div class="continue-name">
                                        <h3 class="continue-tittle">Interstellar</h3>
                                    </div>
                                </article>
                                <article class="continue-data">
                                    <img class="continue-img" src="/placeholder.svg" alt="Movie 11"/>
                                    <div class="continue-name">
                                        <h3 class="continue-tittle">The Departed</h3>
                                    </div>
                                </article>
                                <article class="continue-data">
                                    <img class="continue-img" src="/placeholder.svg" alt="Movie 12"/>
                                    <div class="continue-name">
                                        <h3 class="continue-tittle">The Prestige</h3>
                                    </div>
                                </article>
                            </div>
                        </article>
                    </section>
                    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
                </main>
                ';
        ?>
        <script src="script/jquery.js"></script>
        <script src="script/pop-ups.js"></script>
        <script src="script/botonTop.js"></script>
    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>