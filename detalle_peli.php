<?php session_start();
include("conexion.php");
include("header.php");

$id = intval($_GET['id_peli']);
$peli = mysqli_query($conexion,"SELECT * FROM peliculas WHERE id_peli = $id");
$actores = mysqli_query($conexion,"SELECT nombre, apellido FROM actor JOIN peli_actor WHERE peli_actor.id_actor = actor.id_actor AND peli_actor.id_peli = $id");
$directores = mysqli_query($conexion,"SELECT nombre, apellido FROM director JOIN peli_director WHERE peli_director.id_director = director.id_director AND peli_director.id_peli = $id");
$generos = mysqli_query($conexion,"SELECT nombre_genero FROM genero JOIN peli_genero WHERE peli_genero.id_genero = genero.id_genero AND peli_genero.id_peli = $id");

if ($peli->num_rows > 0) {
    $row = $peli->fetch_assoc();
} else {
    echo "Película no encontrada";
    exit;
}
$conexion->close();
?>
<!doctype html>
<html lang="es">
    <head>
        <title><?php echo $row['titulo'];?></title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" type="text/css" href="slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
        <link rel="stylesheet" href="css\font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>
        <?php
            $fechaEstreno = $row["estreno"];
            $anoEstreno = date("Y", strtotime($fechaEstreno));
        ?>
        <main class="main-detallepeli">
            <div class="detallepeli-poster">
                <img src="<?php echo $row['path_poster'] ?>" alt="<?php echo $row['titulo'] ?>">
            </div>
            <div class="detallepeli-info">
                <div class="info-titulo">
                    <div class="info-titulo_titulo">
                        <h1><?php echo $row['titulo'] ?></h1>
                        <p>(<?php echo $anoEstreno ?>)</p>
                    </div>
                    <div class="star-rating">
                        <input id="star-5" type="radio" name="rating" value="5" onclick="submitRating(5)">
                        <label for="star-5" title="5 estrellas">★</label>
                        <input id="star-4" type="radio" name="rating" value="4" onclick="submitRating(4)">
                        <label for="star-4" title="4 estrellas">★</label>
                        <input id="star-3" type="radio" name="rating" value="3" onclick="submitRating(3)">
                        <label for="star-3" title="3 estrellas">★</label>
                        <input id="star-2" type="radio" name="rating" value="2" onclick="submitRating(2)">
                        <label for="star-2" title="2 estrellas">★</label>
                        <input id="star-1" type="radio" name="rating" value="1" onclick="submitRating(1)">
                        <label for="star-1" title="1 estrella">★</label>
                    </div>
                    
                </div>
                <div class="info-detalles">
                    <p><?php echo $fechaEstreno ?></p>
                    <p>-</p>
                    <?php 

                        if ($generos->num_rows > 0) {
                            while ($r_generos = $generos->fetch_assoc()) {
                                echo '' . $r_generos['nombre_genero'] . ' ';
                            }
                        }else{
                            echo '';
                        }
                    
                    ?>
                    <p> </p>
                    <p>-</p>
                    <p><?php echo $row['duracion'] ?> Mins</p>
                </div>
                <div class="info-botones">
                    <div>
                        <a href="" class="info-boton boton-play"><i class="fa-solid fa-play"></i></a>
                    </div>
                    <div>
                        <form action="" method="post" class="">
                            <input type="hidden" name="pelicula_id" value="<?php echo $id?>">
                            <input type="hidden" name="user_id" value="">
                            <button type="submit" class="info-boton"><i class="fa-solid fa-clock"></i></i></button>
                        </form>
                        <form action="" method="post" class="">
                            <input type="hidden" name="pelicula_id" value="<?php echo $id?>">
                            <input type="hidden" name="user_id" value="">
                            <button type="submit" class="info-boton"><i class="fa-solid fa-star"></i></button>
                        </form>
                        <form action="" method="post" class="">
                            <input type="hidden" name="pelicula_id" value="<?php echo $id?>">
                            <input type="hidden" name="user_id" value="">
                            <button type="submit" class="info-boton"><i class="fa-solid fa-thumbs-up"></i></button>
                        </form>
                    </div>
                </div>
                <div class="info-descripcion">
                    <h2>Descripcion</h2>
                    <p><?php echo $row['descripcion'] ?></p>
                </div>
                <div class="info-elenco">
                    <div class="elenco-director">
                        <h3>Director/es</h3>
                        <?php

                            if ($directores->num_rows > 0) {
                                while ($r_directores = $directores->fetch_assoc()) {
                                    echo '' . $r_directores['nombre'] . ' ' . $r_directores['apellido'];
                                }
                            }
                            else{
                                echo '';
                            }
                        ?>
                    </div>  
                    <div class="elenco-actores">
                        <h3>Actor/es</h3>
                        <?php
                            $contadorActor = 0;
                            if ($actores->num_rows > 0) {
                                while ($r_actores = $actores->fetch_assoc()) {

                                    echo '' . $r_actores['nombre'] . ' ' . $r_actores['apellido'];
                                    $contadorActor++;

                                    if ($contadorActor != $actores->num_rows) {
                                        echo ' - ';
                                    } 
                                    else {
                                        echo '';
                                    }
                                }
                            }
                            else{
                                echo '';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://kit.fontawesome.com/81c8161a36.js" crossorigin="anonymous"></script>
    </body>
</html>