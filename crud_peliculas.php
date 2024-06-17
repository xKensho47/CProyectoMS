<?php session_start();

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
    <title>CRUD Peliculas</title>
</head>


<body class="body-crud">
    <div class="crud-container container showcase">
    <?php
    include("conexion.php");
    include("header.php");
    require_once("loginVerification.php");
    ?>
        <main class="main-crud">
            <?php

            /*DEVUELVE TODA LA INFORMACION DE UNA PELICULA*/
            $sqlBase = "SELECT p.id_peli, p.titulo, p.descripcion, p.estreno, p.path_poster, p.duracion,
             p.video_mp4, gen.nombres_generos, act.nom_ape_actor, dir.nom_ape_director 
            FROM peliculas AS p 
            LEFT JOIN (SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
            FROM peli_genero pg INNER JOIN genero g ON g.id_genero = pg.id_genero GROUP BY pg.id_peli) AS gen 
            ON p.id_peli = gen.id_peli 
            LEFT JOIN (SELECT pa.id_peli, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) 
            SEPARATOR ', ') AS nom_ape_actor FROM peli_actor pa INNER JOIN actor a ON a.id_actor = pa.id_actor GROUP BY 
            pa.id_peli) AS act ON p.id_peli = act.id_peli 
            LEFT JOIN (SELECT pd.id_peli, GROUP_CONCAT(CONCAT(d.nombre, ' ', d.apellido) SEPARATOR ', ') AS nom_ape_director 
            FROM peli_director pd INNER JOIN 
            director d ON d.id_director = pd.id_director GROUP BY pd.id_peli) AS dir ON p.id_peli = dir.id_peli
            GROUP BY p.id_peli";

            // Verifica si se envió una solicitud de búsqueda y la búsqueda no está vacía
            if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
                $busqueda = $conexion->real_escape_string($_GET['busqueda']);

                // Consulta para la búsqueda
                $sqlBusqueda = "SELECT * FROM ($sqlBase) AS resultados WHERE resultados.titulo LIKE '%$busqueda%' ";
            } else {
                // Si no hay búsqueda, usar la consulta base
                $sqlBusqueda = $sqlBase;
            }

            // Ejecutar la consulta
            $peliculas = $conexion->query($sqlBusqueda);
            /*LLAMA A LA TABLA ACTORES*/
            $actores = $conexion->query("SELECT id_actor, nombre, apellido FROM actor");
            /*LLAMA A LA TABLA DIRECTORES*/
            $directores = $conexion->query("SELECT id_director, nombre, apellido FROM director");
            ?>

            <div class="crud  ">
                <div class="animate-from-bottom ajuste-crud">
                    <!-- BOTONES DE REGISTRO Y MODIFICACIONES-->

                    <div class="row justify-content-end mt-0 ">

                        <div class="col-auto me-auto mt-5">
                            <h2 class="text-left pi h2-animate">Peliculas</h2>
                        </div>
                        <div class="col-auto mt-5 animate-from-bottom">
                            <a href="#" class="btn btn-color fs-5" data-bs-toggle="modal" data-bs-target="#nuevoModalGenero"><i class="fa-solid fa-circle-plus"></i> Administrar Genero</a>
                        </div>

                        <div class="col-auto mt-5 animate-from-bottom">
                            <a href="#" class="btn btn-color2 fs-5" data-bs-toggle="modal" data-bs-target="#nuevoModalActor"><i class="fa-solid fa-circle-plus"></i> Administrar Actor</a>
                        </div>

                        <div class="col-auto mt-5 animate-from-bottom">
                            <a href="#" class="btn btn-color fs-5" data-bs-toggle="modal" data-bs-target="#nuevoModalDirector"><i class="fa-solid fa-circle-plus"></i> Administrar Director</a>
                        </div>

                        <div class="col-auto mt-5 animate-from-bottom">
                            <a href="#" class="btn btn-color2 fs-5" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
                        </div>
                    </div>

                    <!--BUSCADOR-->
                    <form action="" method="get" class="mt-4 form-inline justify-content-center mb-1">
                        <div class="input-group">
                            <input type="text" name="busqueda" placeholder="Buscar..." class="form-control  mr-sm-2 fs-5">
                            <div class="input-group-append ">
                                <button type="submit" class="btn guardar fs-5">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET['status'])) {
                        // Verificar si el parámetro 'status' tiene el valor 'success'
                        if ($_GET['status'] === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show fs-5" role="alert"> Cambios Guardados.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        } elseif ($_GET['status'] === 'danger') {
                            echo '<div class="alert alert-danger alert-dismissible fade show fs-5" role="alert"> no pueden realizarse dos acciones a la vez, ni tener ambos campos vacios.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    } ?>

                    <!-- ENCABEZADO DE LA TABLA-->
                    <table class="table table-xl table-striped table-hover mt-3 ">
                        <thead class="table-dark fs-4">
                            <tr class="color-titulo-tabla">
                                <th width="1">#</th>
                                <th width="1">Titulo</th>
                                <th width="1">Descripción</th>
                                <th width="2">Estreno</th>
                                <th width="5">Path_poster</th>
                                <th width="1">Duracion</th>
                                <th width="2">Genero</th>
                                <th width="1">Actor</th>
                                <th width="1">Director</th>
                                <!--<th width="5">video_iframe</th>
                                <th width="5">video_mp4</th>-->
                                <th width="1">Acción</th>
                            </tr>
                        </thead>
                        <!--BODY DE LA TABLA-->
                        <tbody class="fs-5">
                            <!-- TRAE LOS GENEROS, DIRECTORES Y ACTORES-->
                            <?php
                            $sqlGenero = "SELECT id_genero, nombre_genero FROM genero";
                            $generos = $conexion->query($sqlGenero);

                            $sqlDirector = "SELECT id_director, nombre, apellido FROM director";
                            $directores = $conexion->query($sqlDirector);

                            $sqlActor = "SELECT id_actor, nombre, apellido FROM actor";
                            $actores = $conexion->query($sqlActor);
                            ?>
                            <?php while ($row = $peliculas->fetch_object()) {
                                $id_peli = $row->id_peli;
                                $titulo = $row->titulo;
                                $descripcion = $row->descripcion;
                                $estreno = $row->estreno;
                                $duracion = $row->duracion;
                                $path_poster = $row->path_poster;
                                $nombre_genero = $row->nombres_generos;
                                $nombre_actor = $row->nom_ape_actor;
                                $nombre_director = $row->nom_ape_director;
                            ?>

                                <tr>
                                    <td><?= $id_peli; ?></td>
                                    <td><?= $titulo; ?></td>
                                    <td><?= $descripcion; ?></td>
                                    <td><?= $estreno; ?></td>
                                    <td><img src="<?= $path_poster; ?>" width="80"></td>
                                    <td><?= $duracion; ?></td>
                                    <td><?= $nombre_genero; ?></td>
                                    <td><?= $nombre_actor; ?></td>
                                    <td><?= $nombre_director; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning mt-5 fs-6" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $id_peli; ?>" onclick="IdPeliculaEditarEnModal('<?= $id_peli ?>',
                                                                    '<?= $titulo ?>',
                                                                    '<?= $descripcion ?>',
                                                                    '<?= $estreno ?>',
                                                                    '<?= $duracion ?>',
                                                                    '<?= $nombre_genero ?>',
                                                                    '<?= $nombre_actor ?>',
                                                                    '<?= $nombre_director ?>')">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar </a>
                                        <a href="#" class="btn btn-sm btn-danger mt-4 fs-6" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $id_peli; ?>" onclick="IdPeliculaEliminarEnModal('<?= $id_peli ?>')"><i class="fa-solid fa-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>

                <!--MODALES-->
                <?php include 'nuevo_modal.php'; ?>
                <?php include 'editar_modal.php'; ?>
                <?php include 'nuevo_modal_genero.php'; ?>
                <?php include 'nuevo_modal_actor.php'; ?>
                <?php include 'nuevo_modal_director.php'; ?>
                <?php include 'elimina_modal.php'; ?>


                <script>
                    function IdPeliculaEditarEnModal(id_peli, titulo, descripcion, estreno, duracion, nombre_genero, nombre_actor, nombre_director) {
                        // Busca dentro del formulario los checkbox para limpiarlos
                        document.querySelectorAll('#formulario_peliculas input[type="checkbox"]').forEach(function(checkElement) {
                            checkElement.checked = false;
                        });

                        // Conversión de string a array
                        let arrayGeneros = nombre_genero.split(", "); // Se divide con la , manera de separar género por género
                        let arrayActores = nombre_actor.split(", ");
                        let arrayDirectores = nombre_director.split(", "); // Se ajusta para múltiples directores

                        // Busca los input del form
                        let inputIdEncontrado = document.getElementById("id_peli");
                        let inputTituloEncontrado = document.getElementById("nombre_pelicula");
                        let inputDescripcionEncontrada = document.getElementById("descripcion_pelicula");
                        let inputEstrenoEncontrado = document.getElementById("estreno_pelicula");
                        let inputDuracionEncontrado = document.getElementById("duracion_pelicula");

                        // Marca los checkbox de géneros
                        arrayGeneros.forEach(function(genero) {
                            let inputGeneroEncontrado = document.getElementById("genero_" + genero);
                            if (inputGeneroEncontrado) {
                                inputGeneroEncontrado.checked = true;
                            }
                        });

                        // Marca los checkbox de actores
                        arrayActores.forEach(function(actor) {
                            let inputActoresEncontrado = document.getElementById("actor_" + actor);
                            if (inputActoresEncontrado) {
                                inputActoresEncontrado.checked = true;
                            }
                        });

                        // Marca los checkbox de directores
                        arrayDirectores.forEach(function(director) {
                            let inputDirectoresEncontrado = document.getElementById("director_" + director);
                            if (inputDirectoresEncontrado) {
                                inputDirectoresEncontrado.checked = true;
                            }
                        });

                        // Asignación de valores a los inputs del modal
                        inputIdEncontrado.value = id_peli;
                        inputTituloEncontrado.value = titulo;
                        inputDescripcionEncontrada.value = descripcion;
                        inputEstrenoEncontrado.value = estreno;
                        inputDuracionEncontrado.value = duracion;
                    }

                    function IdPeliculaEliminarEnModal(id_peli){
                        let inputIdPeliEncontrado = document.getElementById("id_pelicula_eliminar");
                        inputIdPeliEncontrado.value = id_peli;  
                    }
                </script>

                <script src="script/jquery.js"></script>
                <script src="slick/slick.min.js"></script>
                <script src="script/script.js"></script>
                <script src="script/botonTop.js"></script>
                <script src="script/bootstrap.bundle.min.js"></script>
            </div>
        
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </main>
    </div>

    <script src="./script/jquery.js"></script>
    <script src="./slick/slick.min.js"></script>
    <script src="./script/script.js"></script>
    <script src="./script/botonTop.js"></script>

    <footer>
        <p class="p">&copy; CineFlow 2024</p>
    </footer>
</body>

</html>