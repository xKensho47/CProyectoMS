<!-- ESTA BIEN-->
<?php
session_start();

include("conexion.php");
$id = $_GET['id_peli'];
$peli = mysqli_query($conexion, "SELECT * FROM peliculas WHERE id_peli = $id");
$actores = mysqli_query($conexion, "SELECT nombre, apellido FROM actor JOIN peli_actor WHERE peli_actor.id_actor = actor.id_actor AND peli_actor.id_peli = $id");
$directores = mysqli_query($conexion, "SELECT nombre, apellido FROM director JOIN peli_director WHERE peli_director.id_director = director.id_director AND peli_director.id_peli = $id");
$generos = mysqli_query($conexion, "SELECT nombre_genero FROM genero JOIN peli_genero WHERE peli_genero.id_genero = genero.id_genero AND peli_genero.id_peli = $id");

if ($peli->num_rows > 0) {
    $row = mysqli_fetch_assoc($peli);
} else {
    // Manejo si la película no existe
    echo "La película no existe.";
    exit;
}

$fechaEstreno = $row["estreno"];
$anoEstreno = date("Y", strtotime($fechaEstreno));

$cant_estrellas = mysqli_query($conexion, "SELECT SUM(estrellas) AS cant_estrellas FROM peli_estrellas WHERE id_peli = $id");
$cant_registros = mysqli_query($conexion, "SELECT COUNT(*) AS cant_registros FROM peli_estrellas WHERE id_peli = $id");

// Verificar si el usuario ha iniciado sesión
$id_cuenta = isset($_SESSION['id_cuenta']) ? $_SESSION['id_cuenta'] : null;

// Consultas para verificar si existen registros en tablas relacionadas
$existe_mastarde = $id_cuenta ? mysqli_query($conexion, "SELECT * FROM mas_tarde WHERE id_cuenta = $id_cuenta AND id_peli = $id") : null;
$existe_favorito = $id_cuenta ? mysqli_query($conexion, "SELECT * FROM peli_favorita WHERE id_cuenta = $id_cuenta AND id_peli = $id") : null;
$existe_like = $id_cuenta ? mysqli_query($conexion, "SELECT * FROM peli_like WHERE id_cuenta = $id_cuenta AND id_peli = $id") : null;

mysqli_close($conexion);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
    <div class="container-header-peli">
        <?php
        require_once("loginVerification.php");
        include("header.php");
        ?>
    </div>
    <main class="main-detallepeli">
        <article class="detalle-container">

            <?php if ($id_cuenta) : ?>
            <div class="volver-atras flecha-detalle" style="float: left;">
                <a href="#" id="back-link" class="h2-animate"><i class="fas fa-arrow-left"></i></a>
            </div>
            <?php endif; ?>

            <?php if (!$id_cuenta) : ?>
                <a href="index.php" class="animate-from-bottom btn btn-color fs-5" style="margin-bottom:30px;">Ir a inicio</a>
                <div class="animate-from-bottom">
                    <p class="no-autenticado">Para visualizar la película <a href="login.php">inicie sesión</a></p>
                </div>
            <?php endif; ?>

            <div class="contenedor-detalle_peli animate-from-bottom">
                <div class="detallepeli-poster">
                    <img src="<?php echo $row['path_poster'] ?>" alt="<?php echo $row['titulo'] ?>" class="imagen-deslizar">
                </div>

                <div class="detallepeli-info">
                    <div class="info-titulo">
                        <div class="info-titulo_titulo">
                            <h1><?php echo $row['titulo'] ?></h1>
                            <h3>(<?php echo $anoEstreno ?>)</h3>
                        </div>

                        <?php if ($id_cuenta) : ?>
                            <div class="contenedor-estrellas">
                                <form class="star-rating" action="estrellas.php?form_submitted=true" method="post">
                                    <button type="submit" class="botonEstrellas"><i class="fa-solid fa-share"></i></button>

                                    <?php
                                    // obtengo cuantas estrellas dio un usuario
                                    $query = "SELECT estrellas FROM peli_estrellas WHERE id_cuenta = $id_cuenta AND id_peli = $id LIMIT 1";
                                    $result = mysqli_query($conexion, $query);
                                    $user_rating = mysqli_fetch_assoc($result)['estrellas'] ?? 0;

                                    ?>

                                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                                        <input id="star-<?php echo $i; ?>" type="radio" name="rating" value="<?php echo $i; ?>" <?php if ($user_rating == $i) echo 'checked'; ?>>
                                        <label for="star-<?php echo $i; ?>" title="<?php echo $i; ?> estrellas">★</label>
                                    <?php endfor; ?>

                                    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_cuenta']; ?>">
                                    <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                </form>
                                </form>
                                <div>
                                    <p>
                                        <?php
                                        $estrellas = mysqli_fetch_assoc($cant_estrellas);
                                        $registros = mysqli_fetch_assoc($cant_registros);

                                        if ($registros['cant_registros'] != 0) {
                                            $promedio = $estrellas['cant_estrellas'] / $registros['cant_registros'];
                                        } else {
                                            $promedio = 0;
                                        }

                                        echo round($promedio, 1);
                                        ?> / 5 <span class="estrella">★</span>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="info-detalles">
                        <p><?php echo $fechaEstreno ?></p>
                        <p>-</p>
                        <?php if ($generos->num_rows > 0) : ?>
                            <?php while ($r_generos = $generos->fetch_assoc()) : ?>
                                <p><?php echo $r_generos["nombre_genero"] ?></p>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>-</p>
                        <?php endif; ?>
                        <p>-</p>
                        <p><?php echo $row['duracion'] ?> Mins</p>
                    </div>
                    <?php if ($id_cuenta) : ?>
                        <div class="info-botones">
                            <div>
                                <a href="visualizarpelicula.php?id_peli=<?= $id; ?>" class="info-boton boton-play">
                                    <i class="fa-solid fa-play"></i>
                                    <span class="tooltiptext">Reproducir</span>
                                </a>
                            </div>
                            <div>
                                <form id="form-mas-tarde" action="mas_tarde.php?form_submitted=true" method="post">
                                    <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                    <input type="hidden" name="usuario_id" value="<?php echo $id_cuenta; ?>">
                                    <button type="submit" class="info-boton <?php if ($existe_mastarde && $existe_mastarde->num_rows > 0) echo 'existe'; ?>">
                                        <i class="fa-solid fa-list"></i>
                                        <span class="tooltiptext">Ver más tarde</span>
                                    </button>
                                </form>
                                <form action="favoritos.php?form_submitted=true" method="post">
                                    <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                    <input type="hidden" name="usuario_id" value="<?php echo $id_cuenta; ?>">
                                    <button type="submit" class="info-boton <?php if ($existe_favorito && $existe_favorito->num_rows > 0) echo 'existe'; ?>">
                                        <i class="fa-solid fa-star"></i>
                                        <span class="tooltiptext">Favoritos</span>
                                    </button>
                                </form>
                                <form action="like.php?form_submitted=true" method="post">
                                    <input type="hidden" name="pelicula_id" value="<?php echo $id ?>">
                                    <input type="hidden" name="usuario_id" value="<?php echo $id_cuenta; ?>">
                                    <button type="submit" class="info-boton <?php if ($existe_like && $existe_like->num_rows > 0) echo 'existe'; ?>">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <span class="tooltiptext">Me gusta</span>
                                    </button>
                                </form>
                                <button class="info-boton" data-bs-toggle="modal" data-bs-target="#modalRecomendarPeli">
                                    <i class="fa-solid fa-users"></i>
                                    <span class="tooltiptext">Recomendar a amigo</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="info-descripcion">
                        <h2>Descripción</h2>
                        <hr class="hr-descripcion">
                        <p><?php echo $row['descripcion'] ?></p>
                    </div>
                    <div class="info-elenco">
                        <div class="elenco-director">
                            <h3 >Director/es</h3>
                            <?php if ($directores->num_rows > 0) : ?>
                                <?php while ($r_directores = $directores->fetch_assoc()) : ?>
                                    <p><?php echo $r_directores['nombre'] . ' ' . $r_directores['apellido']; ?></p>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="elenco-actores">
                            <h3 >Actores</h3>
                            <?php if ($actores->num_rows > 0) : ?>
                                <?php while ($r_actores = $actores->fetch_assoc()) : ?>
                                    <p><?php echo $r_actores['nombre'] . ' ' . $r_actores['apellido']; ?></p>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>



    <!-- Modal -->
    <div class="modal fade" id="modalRecomendarPeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content recomendar-peli-content">
                <div class="modal-header recomendar-peli-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Recomendar a un amigo</h1>
                </div>
                <div class="modal-body">
                    <div class="modal-body-amigos">
                        <?php


                        $q = " SELECT 
                        cu.id_cuenta as id_cuenta_amigo,
                        cu.nombre_usuario,
                        img.img as id_img
                    FROM 
                        lista_amigos la
                    JOIN 
                        cuenta_usuario cu
                    ON 
                        la.amigo = cu.id_cuenta
                    LEFT JOIN
                        img_perfil AS img ON cu.id_img = img.id_img
                    WHERE 
                        la.id_cuenta = $id_cuenta";
                        $resultado = mysqli_query($conexion, $q);

                        //$defaultImg es una imagen negra de 1x1 píxel codificada en base64.
                        $defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';

                        if ($resultado->num_rows > 0) {
                            while ($listado_amigos = $resultado->fetch_assoc()) {

                                echo '
                        <form action="recomendar_peli.php?form_submitted=true" method="post" class="contenedor-amigo">
                            <input type="hidden" name="pelicula_id" value="' . $id . '">
                            <input type="hidden" name="usuario_id" value="' . $id_cuenta . '">
                            <input type="hidden" name="amigo_id" value="' . $listado_amigos["id_cuenta_amigo"] . '">
                            <div class="amigo-imagen">
                                <img src="'.(!empty($listado_amigos["id_img"]) ? $listado_amigos["id_img"] : $defaultImg).'" alt="' . $listado_amigos["nombre_usuario"] . '">
                            </div>
                            <div class="amigo-nombre">
                                <h2>' . $listado_amigos["nombre_usuario"] . '</h2>
                                <button type="submit" class="amigo-enviar">Enviar</button>
                            </div>
                        </form>
                                
                            ';
                            }
                        } else {
                            echo '';
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
    
    <script src="script/jquery.js"></script>
    <script src="script/volverAtras.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>
    <script src="https://kit.fontawesome.com/81c8161a36.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>