<?php session_start();
include ('conexion.php');
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-thin-straight/css/uicons-thin-straight.css'>
    <title>Home</title>
</head>
<body class="<?php if (isset($_SESSION["id_cuenta"])) { echo 'logeado'; } ?>">
    <div class="container showcase">
        <?php
            include ("header.php");
            require_once ("loginVerification.php");
            require_once ("CCarousel.php");

            if (!isset($_SESSION["id_cuenta"])) { 
                echo'
                <script src="script/heroControl.js"></script>
                <div class="hero" id="hero">
                    <div class="hero-texto">
                        <h1>Bienvenidos a <span class="titulo-hero">CineFlow</span></h1>
                        <h2>la mejor plataforma gratuita</h2>
                    </div>
                    <div class="icono-flecha-hero flecha-hero h2-animate"><i class="fi fi-ts-chevron-double-down"></i></div>
                </div>
                ';
            }
            
            
          
            echo '
            <main class="main-principal '; if (isset($_SESSION["id_cuenta"])) echo "show"; echo' " id="mainContent">
                <section class="movies-containerp movies" id="movies-container movies">';
                if (isset($_SESSION["id_cuenta"])) {

                    $id_cuenta = $_SESSION["id_cuenta"];
                    $sql_nombre = $conexion->query("SELECT nombre_usuario FROM cuenta_usuario WHERE id_cuenta = $id_cuenta");
                    if ($sql_nombre->num_rows > 0) {
                        $nombre = $sql_nombre->fetch_assoc();
                        echo "
                        <div class='bienvenida animate-from-bottom' style='position: relative; display: inline-block;'>
                            <div class='flex-container'>
                                <h1 class='borde'>bienvenido <span>" . $nombre["nombre_usuario"] . "</span></h1>
                                <h1 class='wave' style='position: absolute; top: 0; left: 0;'>bienvenido <span>" . $nombre["nombre_usuario"] . "</span></h1>
                                <p class='h2-animate' id='dynamicPhrase'><i></i></p>
                            </div>
                        </div>
                        <script src='script/frasesAleatorias.js'></script>
                        ";
                    }
                }
                
                
                $titles = array("Películas más valoradas", "Recientes");

                $carouseles = new CCarousel($conexion);

                for ($i = 0; $i < count($titles); $i++) {
                    $carouseles->generateMovieSection($conexion, $titles[$i]);
                }

        ?>

        <?php

            if (isset($_SESSION["id_cuenta"])) {

                // carrusel 'ver mas tarde'
                $q =
                    "SELECT 
                    p.id_peli AS id, 
                    p.path_poster AS poster, 
                    p.titulo AS titulo
                    FROM 
                        peliculas p
                    JOIN 
                        mas_tarde mt
                    ON 
                        p.id_peli = mt.id_peli
                    JOIN 
                        cuenta_usuario cu 
                    ON 
                        mt.id_cuenta = cu.id_cuenta
                    WHERE 
                        cu.id_cuenta = $id_cuenta
                    ";
                $title = 'Ver más tarde';
                $result = mysqli_query($conexion, $q);

                echo "
                    <section class='movies-container x-carousel' id='movies-container-$title'>
                        <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                            <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                                <h2 class='x-tittle h2-animate animate-from-bottom' id='x-tittle-$title'>  $title  </h2>
                                <hr class='hr-carrusel'>
                            </div>
                            <div class='x-carousel-container'>
                                <button class='carousel-prev'>&#60</button>
                                <div class='carousel-slide'>";

                /* Ordenar por puesto */
                /*$puesto = 1;*/

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = $row["poster"];
                        echo "
                            <div class='x-carousel-movie'>
                            <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                <img src=' " . $imagePath . " ' alt='Movie Posters'>
                            
                            </a>
                            </div>
                            ";
                        /*$puesto++;*/
                    }
                } else {
                    echo '<p>No movies found.</p>';
                }
                echo "
                    </div>
                    <button class='carousel-next'>&#62</button>
                    </div>
                </article>
                </section>
                ";


                //carrusel de los generos favoritos
            
                $hayGeneros = mysqli_query($conexion, "SELECT gf.id_genero, gf.id_cuenta, ge.nombre_genero 
                                                        FROM genero_favorito gf JOIN genero ge ON gf.id_genero = ge.id_genero 
                                                        WHERE gf.id_cuenta = $id_cuenta");

                if ($hayGeneros && $hayGeneros->num_rows > 0) {
                    while ($row = $hayGeneros->fetch_assoc()) {
                        $id_genero = $row["id_genero"];
                        $q = "SELECT 
                            p.id_peli AS id, 
                            p.path_poster AS poster, 
                            p.titulo AS titulo 
                            FROM peliculas p
                            JOIN peli_genero pg ON p.id_peli = pg.id_peli AND pg.id_genero = $id_genero"
                        ;

                        $title = "Según tu genero favorito - " . $row['nombre_genero'] . " ";
                        $result = mysqli_query($conexion, $q);

                        echo "
                            <section class='movies-container x-carousel' id='movies-container-$title'>
                                <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                                    <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                                        <h2 class='x-tittle h2-animate animate-from-bottom' id='x-tittle-$title'>  $title  </h2>
                                        <hr class='hr-carrusel'>
                                    </div>
                                    <div class='x-carousel-container'>
                                        <button class='carousel-prev'>&#60</button>
                                        <div class='carousel-slide'>";

                        /* Ordenar por puesto */
                        /*$puesto = 1;*/
            
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $imagePath = $row["poster"];
                                echo "
                                    <div class='x-carousel-movie'>
                                    <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                        <img src=' " . $imagePath . " ' alt='Movie Posters'>
                                    
                                    </a>
                                    </div>
                                    ";
                                /*$puesto++;*/
                            }
                        } else {
                            echo '<p>No movies found.</p>';
                        }
                        echo "
                            </div>
                            <button class='carousel-next'>&#62</button>
                            </div>
                        </article>
                        </section>
                        ";


                    }

                }
            } else {
                echo "";
            }
        echo '
            </section>
        </main>
        ';

        ?>
        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>

