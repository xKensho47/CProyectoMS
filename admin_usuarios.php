<?php session_start(); ?>

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
    <title>Usuarios</title>
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

            //si la variable busqueda no esta vacia
            if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
                $busqueda = $conexion->real_escape_string($_GET['busqueda']);

                //busco coincidencias
                $sqlBusqueda = ("SELECT * 
                                    FROM usuarios
                                     WHERE nombre LIKE '%$busqueda%' 
                                        OR apellido LIKE '%$busqueda%'
                                        OR mail LIKE '%$busqueda%'");
            } else { //si no hay coincidencias, muestro todo
                $sqlBusqueda = ("SELECT *
                    FROM usuarios");
            }

            $infoUsuarios = $conexion->query($sqlBusqueda);

            ?>
            <div class="crud animate-from-bottom ajuste-crud">
                <div class="col-auto me-auto mt-1">
                    <h2 class="text-left pi h2-animate">Administrar Usuarios</h2>
                </div>

                <form action="" method="get" class="mt-4 form-inline justify-content-center mb-2">
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
                }
                ?>

                <table class="table table-xl table-striped table-hover mt-3 ">
                    <thead class="table-dark fs-4">
                        <tr class="color-titulo-tabla">
                            <th width="1">#</th>
                            <th width="10">Nombre</th>
                            <th width="10">Apellido</th>
                            <th width="40">Mail</th>
                            <th width="10">Tipo de Usuario</th>
                            <th width="1">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="fs-5">

                        <?php while ($row = $infoUsuarios->fetch_object()) {

                            $id_usuario = $row->id_usuario;
                            $nombre = $row->nombre;
                            $apellido = $row->apellido;
                            $mail = $row->mail;
                            $id_tipo = $row->id_tipo; ?>
                            <tr>
                                <td><?= $id_usuario; ?></td>
                                <td><?= $nombre; ?></td>
                                <td><?= $apellido; ?></td>
                                <td><?= $mail; ?></td>

                                <?php if ($id_tipo == 1) { ?>
                                    <td><?= 'Administrador'; ?></td>
                                <?php } else { ?>
                                    <td><?= 'Normal'; ?></td>
                                <?php } ?>

                                <td>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <a href="#" class="btn btn-sm btn-warning mt-2 fs-6" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $id_usuario; ?>" onclick="IdUsuarioEditarEnModal(<?= $id_usuario ?>,
                                                                            '<?= $nombre ?>',
                                                                            '<?= $apellido ?>',
                                                                            '<?= $mail ?>')"> 
                                            <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                        <a href="#" class="btn btn-sm btn-danger mt-2 fs-6" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $id_usuario; ?>" onclick="IdUsuarioEliminarEnModal(<?= $id_usuario ?>)"><i class="fa-solid fa-trash"></i> Eliminar</a>
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <?php include 'edita_modal_usuario.php'; ?>
            <?php include 'elimina_modal_usuario.php'; ?>

            <script src="script/jquery.js"></script>
            <script src="slick/slick.min.js"></script>
            <script src="script/script.js"></script>
            <script src="script/botonTop.js"></script>
            <script src="script/bootstrap.bundle.min.js"></script>
            <script>
                function IdUsuarioEditarEnModal(idUsuario, nombre, apellido, mail) {
                    let inputEncontrado = document.getElementById("id_usuario"); //busca ese nombre en el form modal
                    let inputNombreEncontrado = document.getElementById("nombre");
                    let inputApellidoEncontrado = document.getElementById("apellido");
                    let inputMailEncontrado = document.getElementById("mail");
                    inputEncontrado.value = idUsuario; //modifica el valor del input con el id recibido
                    inputNombreEncontrado.value = nombre;
                    inputApellidoEncontrado.value = apellido;
                    inputMailEncontrado.value = mail;
                }

                function IdUsuarioEliminarEnModal(idUsuario) {
                    let inputEncontrado = document.getElementById("id_usuario_eliminar");
                    inputEncontrado.value = idUsuario;
                }
            </script>

            </div>
        </main>
    </div>

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>