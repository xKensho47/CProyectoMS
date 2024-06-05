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
    <title>CRUD Peliculas</title>
</head>


<body class="body-crud">
    <main>

        <div class="  container-crud py-3">
            <?php
            include("conexion.php");
            include("header.php");
            require_once("loginVerification.php");

            /*DEVUELVE TODA LA INFORMACION DE UNA PELICULA*/
            $sqlBase = "SELECT p.id_peli, p.titulo, p.descripcion, p.estreno, p.path_poster, p.duracion, 
            p.video_iframe, p.video_mp4, gen.nombres_generos, act.nom_ape_actor, dir.nom_ape_director 
            FROM peliculas AS p 
            LEFT JOIN (SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
            FROM peli_genero pg INNER JOIN genero g ON g.id_genero = pg.id_genero GROUP BY pg.id_peli) AS gen 
            ON p.id_peli = gen.id_peli 
            LEFT JOIN (SELECT pa.id_peli, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) 
            SEPARATOR ', ') AS nom_ape_actor FROM peli_actor pa INNER JOIN actor a ON a.id_actor = pa.id_actor GROUP BY 
            pa.id_peli) AS act ON p.id_peli = act.id_peli 
            LEFT JOIN (SELECT pd.id_peli, GROUP_CONCAT(CONCAT(d.nombre, ' ', d.apellido) SEPARATOR ', ') AS nom_ape_director FROM peli_director pd INNER JOIN 
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
                <div class="animate-from-bottom">
                    <!-- BOTONES DE REGISTRO Y MODIFICACIONES-->

                    <div class="row justify-content-end mt-5 ">

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
                    <form action="" method="get" class="mt-4 form-inline justify-content-center">
                        <div class="input-group">
                            <input type="text" name="busqueda" placeholder="Buscar..." class="form-control  mr-sm-2 fs-5">
                            <div class="input-group-append ">
                                <button type="submit" class="btn btn-primary fs-5">Buscar</button>
                            </div>
                        </div>
                    </form>

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
                            <?php while ($row = $peliculas->fetch_object()) { ?>
                                <tr>
                                    <td><?= $row->id_peli; ?></td>
                                    <td><?= $row->titulo; ?></td>
                                    <td><?= $row->descripcion; ?></td>
                                    <td><?= $row->estreno; ?></td>
                                    <td><img src="<?= $row->path_poster; ?>" width="80"></td>
                                    <td><?= $row->duracion; ?></td>
                                    <td><?= $row->nombres_generos; ?></td>
                                    <td><?= $row->nom_ape_actor; ?></td>
                                    <td><?= $row->nom_ape_director; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning mt-5 fs-6" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row->id_peli; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <a href="#" class="btn btn-sm btn-danger mt-4 fs-6" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row->id_peli; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>

                <!--MODALES-->
                <?php include 'nuevo_modal.php'; ?>
                <?php include 'nuevo_modal_genero.php'; ?>
                <?php include 'nuevo_modal_actor.php'; ?>
                <?php include 'nuevo_modal_director.php'; ?>
                <?php include 'editar_modal.php'; ?>
                <?php include 'elimina_modal.php'; ?>


                <script>
                    let editaModal = document.getElementById('editaModal')
                    let eliminaModal = document.getElementById('eliminaModal')

                    editaModal.addEventListener('shown.bs.modal', event => {

                        let button = event.relatedTarget
                        let id = button.getAttribute('data-bs-id')

                        let inputId = editaModal.querySelector('.modal-body #id')
                        let inputNombre = editaModal.querySelector('.modal-body #nombre')
                        let inputDescripcion = editaModal.querySelector('.modal-body #descripcion')
                        let inputEstreno = editaModal.querySelector('.modal-body #estreno')
                        let inputDuracion = editaModal.querySelector('.modal-body #duracion')
                        let inputPath_poster = editaModal.querySelector('.modal-body #Path_poster')
                        let inputGenero = editaModal.querySelector('.modal-body #genero')
                        let inputActores = editaModal.querySelector('.modal-body #actores')
                        let inputDirectores = editaModal.querySelector('.modal-body #directores')
                        let inputVideo_mp4 = editaModal.querySelector('.modal-body #video_mp4')
                        let inputVideo_iframe = editaModal.querySelector('.modal-body #video_iframe')

                        let url = "get_pelicula.php"
                        let formData = new FormData()
                        formData.append('id', id)

                        fetch(url, {
                                method: "POST",
                                body: formData
                            }).then(response => response.json())
                            .then(data => {

                                inputId.value = data.id
                                inputNombre.value = data.nombre
                                inputDescripcion.value = data.descripcion
                                inputEstreno.value = data.estreno
                                inputDuracion.value = data.duracion
                                inputPath_poster.value = data.Path_poster
                                inputGenero.value = data.id_genero
                                inputActores.value = data.actores
                                inputDirectores.value = data.directores
                                inputVideo_mp4.value = data.video_mp4
                                inputVideo_iframe.value = data.video_iframe


                            }).catch(err => console.log(err))

                    })

                    eliminaModal.addEventListener('shown.bs.modal', event => {
                        let button = event.relatedTarget
                        let id = button.getAttribute('data-bs-id')
                        eliminaModal.querySelector('.modal-footer #id').value = id
                    })
                </script>







                <script src="script/jquery.js"></script>
                <script src="slick/slick.min.js"></script>
                <script src="script/script.js"></script>
                <script src="script/botonTop.js"></script>
                <script src="script/bootstrap.bundle.min.js"></script>
            </div>
        </div>
    </main>

    <footer>
        <p class="p">&copy; CineFlow 2024</p>
    </footer>
</body>

</html>