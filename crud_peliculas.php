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
            include("comprobar_usuario.php");
            /*DEVUELVE TODA LA INFORMACION DE UNA PELICULA*/
            $sqlPeliculas = " SELECT p.id_peli, p.titulo, p.descripcion, p.estreno, p.path_poster, p.duracion, 
            p.video_iframe, p.video_mp4,gen.nombres_generos, act.nom_ape_actor,dir.nom_ape_director FROM 
            peliculas AS p LEFT JOIN (SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
            FROM peli_genero pg INNER JOIN genero g ON g.id_genero = pg.id_genero GROUP BY pg.id_peli) AS gen 
            ON p.id_peli = gen.id_peli LEFT JOIN (SELECT pa.id_peli, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) 
            SEPARATOR ', ') AS nom_ape_actor FROM peli_actor pa INNER JOIN actor a ON a.id_actor = pa.id_actor GROUP BY 
            pa.id_peli) AS act ON p.id_peli = act.id_peli LEFT JOIN (SELECT pd.id_peli, GROUP_CONCAT(CONCAT(d.nombre, ' ', d.apellido) SEPARATOR ', ') AS nom_ape_director FROM peli_director pd INNER JOIN 
            director d ON d.id_director = pd.id_director GROUP BY pd.id_peli) AS dir ON p.id_peli = dir.id_peli
            GROUP BY p.id_peli";
            $peliculas = $conexion->query($sqlPeliculas);
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


                    <!-- ENCABEZADO DE LA TABLA-->
                    <table class="table table-xl table-striped table-hover mt-4 ">
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
                            <!-- TRAE LOS GENEROS-->
                            <?php
                            $sqlGenero = "SELECT id_genero, nombre_genero FROM genero";
                            $generos = $conexion->query($sqlGenero);
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
                                        <a href="#" class="btn btn-sm btn-warning mt-5 fs-6" data-bs-toggle="modal" data-bs-target="#editar_modal" data-bs-id="<?= $row->id_peli; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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


                <script>
                    /*let nuevoModal = document.getElementById('nuevoModal')*/
                    let editar_modal = document.getElementById('editar_modal')
                    /*let eliminaModal = document.getElementById('eliminaModal')*/

                   /* nuevoModal.addEventListener('shown.bs.modal', event => {
                        nuevoModal.querySelector('.modal-body #nombre').focus()
                    })

                    nuevoModal.addEventListener('hide.bs.modal', event => {
                        nuevoModal.querySelector('.modal-body #nombre').value = ""
                        nuevoModal.querySelector('.modal-body #descripcion').value = ""
                        nuevoModal.querySelector('.modal-body #genero').value = ""
                        nuevoModal.querySelector('.modal-body #poster').value = ""
                    })*/

                    editar_modal.addEventListener('hide.bs.modal', event => {
                        editar_modal.querySelector('.modal-body #nombre').value = ""
                        editar_modal.querySelector('.modal-body #descripcion').value = ""
                        editar_modal.querySelector('.modal-body #estreno').value = ""
                        editar_modal.querySelector('.modal-body #duracion').value = ""
                        editar_modal.querySelector('.modal-body #Path_poster').value = ""
                        editar_modal.querySelector('.modal-body #genero').value = ""
                        editar_modal.querySelector('.modal-body #actores').value = ""
                        editar_modal.querySelector('.modal-body #directores').value = ""
                        editar_modal.querySelector('.modal-body #video_mp4').value = ""
                        editar_modal.querySelector('.modal-body #video_iframe').value = ""
                    })

                    editar_modal.addEventListener('shown.bs.modal', event => {
                        let button = event.relatedTarget
                        let id = button.getAttribute('data-bs-id')
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

                   /* eliminaModal.addEventListener('shown.bs.modal', event => {
                        let button = event.relatedTarget
                        let id = button.getAttribute('data-bs-id')
                        eliminaModal.querySelector('.modal-footer #id').value = id
                    })*/
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
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>