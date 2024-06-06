<?php session_start();
// Verifica si $_SESSION['user_id'] está definida antes de usarla
if (isset($_SESSION['id_cuenta'])) {
    $user_id = $_SESSION['id_cuenta']; // Obtener el ID del usuario de la sesión

    // Tu código continúa aquí...
} else {
    // Si $_SESSION['user_id'] no está definida, muestra un mensaje de error o redirige al usuario
    echo "Error: Usuario no identificado. Por favor, inicie sesión.";
    // o redirige al usuario a la página de inicio de sesión
    // header("Location: login.php");
    // exit(); // Finaliza el script para evitar que se ejecute el código restante
} ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-Tz66Ovr4uSly5Yz0oSnWIbge5iQZ1IYbYi8POE1DbTFHl2aW+7p2G+MTkpaDLfN/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Peliculas</title>


</head>

<body class="body-peli">
    <div>
        <div class="container">
            <?php
            include("conexion.php");
            include("header.php");
            require_once("loginVerification.php");

            ?>
        </div>

        <main class="main-peliculas">
            <div class="contenedor-horizontal">
                <div class="volver-atras">
                    <?php
                    $id = $_GET['id'];
                    $consulta = "SELECT nombre_genero FROM genero WHERE id_genero=$id";
                    $resultado = $conexion->query($consulta);
                    $fila = $resultado->fetch_assoc();
                    $nombre_genero = $fila['nombre_genero'];
                    ?>
                    <a href="generos.php" class="h2-animate"><i class="fas fa-arrow-left"></i> <?= $nombre_genero ?></a>
                </div>
        
                <form action="genero_fav.php" method="post" class="formulario">
                    <input type="hidden" name="id_genero" value="<?= $id ?>">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="checkbox" id="genero_fav" name="genero_fav" value="yes">
                    <label for="genero_fav">Marcar como género favorito</label>
                </form>

            </div>
            <section class="peliculas-container animate-from-bottom">

                <?php
                $sql = "SELECT p.id_peli, path_poster FROM peliculas p INNER JOIN peli_genero g ON p.id_peli = g.id_peli WHERE id_genero='$id'";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="pelicula-item">';
                        echo '<a href="detalle_peli.php?id_peli=' . $row["id_peli"] . '">';
                        echo '<img src="' . $row["path_poster"] . '" alt="">';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "0 resultados";
                }
                ?>
            </section>

            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </main>



        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>
        <script>
            $(document).ready(function() {
                $("#genero_seleccionado").val("<?= $nombre_genero; ?>");
            });
        </script>

    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>