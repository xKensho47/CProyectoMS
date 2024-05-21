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
    <div class="container container2 py-3">
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");

        $sqlPeliculas = "SELECT p.id_peli, p.titulo, p.descripcion,p.estreno,p.path_poster,p.duracion,p.video_iframe,
                p.video_mp4 FROM peliculas AS p";
        $peliculas = $conexion->query($sqlPeliculas);
        ?>

        <h2 class="text-center">Peliculas</h2>
        <!-- BOTON DE REGISTRO-->
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
            </div>
        </div>

        <!-- ENCABEZADO DE LA TABLA-->
        <table class="table table-xl table-striped table-hover mt-4 ">
            <thead class="table-dark">
                <tr>
                    <th width="10">#</th>
                    <th width="10">Titulo</th>
                    <th width="100">Descripción</th>
                    <th width="20">Estreno</th>
                    <th width="5">Path_poster</th>
                    <th width="1">Duracion</th>
                    <th width="5">video_iframe</th>
                    <th width="5">video_mp4</th>
                    <th width="10">Acción</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row = $peliculas->fetch_object()) { ?>
                    <tr>
                        <td><?= $row->id_peli; ?></td>
                        <td><?= $row->titulo; ?></td>
                        <td><?= $row->descripcion; ?></td>
                        <td><?= $row->estreno; ?></td>
                        <td><img src="<?= $row->path_poster; ?>" width="80"></td>
                        <td><?= $row->duracion; ?></td>
                        <td><?= $row->video_iframe; ?></td>
                        <td><?= $row->video_mp4; ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row->id_peli; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row->id_peli; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>

        <!-- TRAE LOS GENEROS-->
        <?php
        $sqlGenero = "SELECT id_genero, nombre_genero FROM genero";
        $generos = $conexion->query($sqlGenero);
        ?>

        <?php include 'nuevo_modal.php'; ?>










        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>
        <script src="script/bootstrap.bundle.min.js"></script>
    </div>

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>