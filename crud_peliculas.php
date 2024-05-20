<?php session_start(); ?>
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
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
        <link rel="stylesheet" href="../../../css/bootstrap.min.css">
        <title>CRUD Peliculas</title>
    </head>

    <body>
        <div class="container  py-3">
            <?php
                include("conexion.php");
                include("comprobar_usuario.php");
            ?>
            <h2 class="text-center">Peliculas</h2>
            <!-- BOTON DE REGISTRO-->
            <div class="row justify-content-end">
                <div class="col-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
                </div>
            </div>

            <!-- ENCABEZADO DE LA TABLA-->
            <table class="table table-sm table-striped table-hover mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th width="10%">Descripción</th>
                        <th>Estreno</th>
                        <th>Path_poster</th>
                        <th>Duracion</th>
                        <th>Género</th>
                        <th>Poster</th>
                        <th>video_iframe</th>
                        <th>video_mp4</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>

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
        </div>

        <footer>
            <p>&copy; CineFlow 2024</p>
        </footer>
        <script src="../../../script/bootstrap.bundle.min.js"></script>
    </body>
</html>