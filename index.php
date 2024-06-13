<?php session_start();
include ('conexion.php');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <title>Home</title>
</head>

<body>
    <div class="container showcase">
        <?php

        include ("header.php");
        require_once ("loginVerification.php");
        require_once ("CCarousel.php");

        echo '
        <main class="main-principal">
            <section class="movies-containerp movies" id="movies-container movies">';

            $titles = array("Películas más valoradas", "Recientes");

        $carouseles = new CCarousel($conexion);

        for ($i = 0; $i < count($titles); $i++) {
            $carouseles->generateMovieSection($conexion, $titles[$i]);
        }
            

        ?>

        <?php

        if (isset($_SESSION["id_cuenta"])) {


            $id_cuenta = $_SESSION["id_cuenta"];

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
            $title = $titles[2];
            $result = mysqli_query($conexion, $q);

            echo "
                                        <section class='movies-container x-carousel' id='movies-container-$title'>
                                            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                                                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                                                    <h2 class='x-tittle' id='x-tittle-$title'> - $title - </h2>
                                                    <hr>
                                                </div>
                                                <div class='x-carousel-container'>
                                                    <button class='carousel-prev'>&#60</button>
                                                    <div class='carousel-slide'>";

            /* Ordenar por puesto */
            $puesto = 1;

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = $row["poster"];
                    echo "
                                                    <div class='x-carousel-movie'>
                                                    <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                                        <img src=' " . $imagePath . " ' alt='Movie Posters'>
                                                        <div class='x-carousel-rank'>
                                                        <p># " . $puesto . " </p>
                                                        </div>
                                                    </a>
                                                    </div>
                                                    ";
                    $puesto++;
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

            $hayGeneros = mysqli_query($conexion,"SELECT gf.id_genero, gf.id_cuenta, ge.nombre_genero 
                                                    FROM genero_favorito gf JOIN genero ge ON gf.id_genero = ge.id_genero 
                                                    WHERE gf.id_cuenta = $id_cuenta");

            if($hayGeneros && $hayGeneros->num_rows > 0){
                while ($row = $hayGeneros->fetch_assoc()) {
                    $id_genero = $row["id_genero"];
                    $q = "SELECT 
                                p.id_peli AS id, 
                                p.path_poster AS poster, 
                                p.titulo AS titulo 
                                FROM peliculas p
                                JOIN peli_genero pg ON p.id_peli = pg.id_peli AND pg.id_genero = $id_genero"
                                ;

                    $title = "Según tu genero favorito - ". $row['nombre_genero'] . " ";
                    $result = mysqli_query($conexion, $q);
        
                    echo "
                                                <section class='movies-container x-carousel' id='movies-container-$title'>
                                                    <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                                                        <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                                                            <h2 class='x-tittle' id='x-tittle-$title'> - $title - </h2>
                                                            <hr>
                                                        </div>
                                                        <div class='x-carousel-container'>
                                                            <button class='carousel-prev'>&#60</button>
                                                            <div class='carousel-slide'>";
        
                    /* Ordenar por puesto */
                    $puesto = 1;
        
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = $row["poster"];
                            echo "
                                                            <div class='x-carousel-movie'>
                                                            <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                                                <img src=' " . $imagePath . " ' alt='Movie Posters'>
                                                                <div class='x-carousel-rank'>
                                                                <p># " . $puesto . " </p>
                                                                </div>
                                                            </a>
                                                            </div>
                                                            ";
                            $puesto++;
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
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>