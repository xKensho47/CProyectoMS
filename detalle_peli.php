<?php session_start();

include("conexion.php");

$id_cuenta = $_SESSION['id_cuenta'];
$id = $_GET['id_peli'];
$peli = mysqli_query($conexion, "SELECT * FROM peliculas WHERE id_peli = $id");
$actores = mysqli_query($conexion, "SELECT nombre, apellido FROM actor JOIN peli_actor WHERE peli_actor.id_actor = actor.id_actor AND peli_actor.id_peli = $id");
$directores = mysqli_query($conexion, "SELECT nombre, apellido FROM director JOIN peli_director WHERE peli_director.id_director = director.id_director AND peli_director.id_peli = $id");
$generos = mysqli_query($conexion, "SELECT nombre_genero FROM genero JOIN peli_genero WHERE peli_genero.id_genero = genero.id_genero AND peli_genero.id_peli = $id");

    if ($peli->num_rows > 0) {
        $row = mysqli_fetch_assoc($peli);
    } else {
        echo
        exit;
    }

$existe_mastarde = mysqli_query($conexion, "SELECT * FROM mas_tarde WHERE id_cuenta = $id_cuenta AND id_peli = $id");
$existe_favorito = mysqli_query($conexion, "SELECT * FROM peli_favorita WHERE id_cuenta = $id_cuenta AND id_peli = $id");
$existe_like = mysqli_query($conexion, "SELECT * FROM peli_like WHERE id_cuenta = $id_cuenta AND id_peli = $id");

$fechaEstreno = $row["estreno"];
$anoEstreno = date("Y", strtotime($fechaEstreno));

$cant_estrellas = mysqli_query($conexion,"SELECT SUM(estrellas) AS cant_estrellas FROM peli_estrellas WHERE id_peli = $id");
$cant_registros = mysqli_query($conexion,"SELECT COUNT(*) AS cant_registros FROM peli_estrellas WHERE id_peli = $id");

    mysqli_close($conexion);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title><?php echo $row['titulo']; ?></title>
</head>

<body>
    <div class="container">
        <?php
        require_once("loginVerification.php");
        include("header.php");
        ?>
        <main class="main-detallepeli">
    
            <div class="volver-atras" style="float: left;">
                <a href="generos.php" class="h2-animate"><i class="fas fa-arrow-left"></i></a>
            </div>

            <div class="contenedor-detalle_peli animate-from-bottom">
                <div class="detallepeli-poster ">
                    <img src="<?php echo $row['path_poster'] ?>" alt="<?php echo $row['titulo'] ?>" class="imagen-deslizar ">
                </div>      
            <div class="detallepeli-info">
                <div class="info-titulo">
                    <div class="info-titulo_titulo">
                        <h1><?php echo $row['titulo'] ?></h1>
                        <p>(<?php echo $anoEstreno ?>)</p>
                    </div>
                    <div class="contenedor-estrellas">
                        <form class="star-rating" action="estrellas.php" method="post">
                            <button type="submit" class="botonEstrellas"><i class="fa-solid fa-share"></i></button>
                            <input id="star-5" type="radio" name="rating" value="5">
                            <label for="star-5" title="5 estrellas">★</label>
                            <input id="star-4" type="radio" name="rating" value="4">
                            <label for="star-4" title="4 estrellas">★</label>
                            <input id="star-3" type="radio" name="rating" value="3">
                            <label for="star-3" title="3 estrellas">★</label>
                            <input id="star-2" type="radio" name="rating" value="2">
                            <label for="star-2" title="2 estrellas">★</label>
                            <input id="star-1" type="radio" name="rating" value="1">
                            <label for="star-1" title="1 estrella">★</label>
                            <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_cuenta']; ?>">  
                            <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                        </form>
                        <div>
                            <p>
                                <?php
                                $estrellas = mysqli_fetch_assoc($cant_estrellas);
                                $registros = mysqli_fetch_assoc($cant_registros);
                                
                                if($registros['cant_registros'] != 0){
                                    $promedio = $estrellas['cant_estrellas'] / $registros['cant_registros'];
                                } 
                                else{
                                    $promedio = 0;
                                }
                                
                                echo $promedio;
                                ?> / 5 <span class="estrella">★</span>
                            </p>
                        </div>
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
                        } else {
                            echo '';
                        }

                        ?>
                        <p> </p>
                        <p>-</p>
                        <p><?php echo $row['duracion'] ?> Mins</p>
                    </div>
                    <div class="info-botones">
                        <div>
                        <a href="visualizarpelicula.php?id_peli=<?= $id;?>" class="info-boton boton-play"><i class="fa-solid fa-play"></i></a>
                        </div>
                        <div>
                            <form action="mas_tarde.php" method="post">
                                <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_cuenta']; ?>">
                                <button type="submit" class="info-boton <?php if ($existe_mastarde->num_rows > 0) {
                                                                            echo 'existe';
                                                                        } ?>"><i class="fa-solid fa-clock"></i></i></button>
                            </form>
                            <form action="favoritos.php" method="post">
                                <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_cuenta']; ?>">
                                <button type="submit" class="info-boton <?php if ($existe_favorito->num_rows > 0) {
                                                                            echo 'existe';
                                                                        } ?>"><i class="fa-solid fa-star"></i></button>
                            </form>
                            <form action="like.php" method="post">
                                <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_cuenta']; ?>">
                                <button type="submit" class="info-boton <?php if ($existe_like->num_rows > 0) {
                                                                            echo 'existe';
                                                                        } ?>"><i class="fa-solid fa-thumbs-up"></i></button>
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
                            } else {
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
                                    } else {
                                        echo '';
                                    }
                                }
                            } else {
                                echo '';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>
    <script src="https://kit.fontawesome.com/81c8161a36.js" crossorigin="anonymous"></script>
</body>

</html>