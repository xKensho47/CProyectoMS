<?php 
session_start(); 
include("conexion.php");
?>

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
        include("header.php");
        require_once("CProfile.php");
        require_once("CCarousel.php");
        ?>
        <main class="main-profile">
            <section class="userinfo-container">
                <aside class="profile-userinfo">
                    <?php
                    /* PRIMER ASIDE */
                    $profile = new CProfile($conexion);

                    $profile->generateProfileData($conexion);

                    ?>                    
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
                            <section class="userinfo2-movies option" id="userinfo2-movies">
                                <?php
                                $carouseles = new CCarousel($conexion);
                                $carouseles->generateMovieSection($conexion, 'Continuar viendo');
                                $carouseles->generateMovieSection($conexion, 'Ver más tarde');
                                $carouseles->generateMovieSection($conexion, 'Favoritas');
                                ?>
                            </section>
                            <section class="userinfo2-friends option" id="userinfo2-friends">
                                <section class="friends-container">
                                    <article class="friends-grid-container">
                                        <?php
                                        $profile->FriendsList($conexion, $id_cuenta);
                                        ?>
                                    </article>
                                </section>
                            </section>
                            <section class="userinfo2-discover option" id="userinfo2-discover">
                                <section class="discover-container">
                                    <article class="discover-grid-container">
                                        <?php
                                        //$profile->discoverFriends($conexion);
                                        ?>
                                    </article>
                                </section>
                            </section>
                        </article>
                    </section>
                </aside>
                <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>
    <script src="script/profileOptions.js"></script>
    <script src="script/agregarAmigos.js"></script>
    <script src="script/profileEdit.js"></script>
</body>
</html>

<?php include("editarPerfil_modal.php") ?>
