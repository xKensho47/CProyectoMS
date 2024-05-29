<?php session_start(); ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <title>Peliculas</title>
</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("comprobar_usuario.php");

        ?>
        <main class="main-genres">
            <section class="genres-container">
                <div class="container-card">
                    <?php
                    $consulta = "select id_genero,nombre_genero from genero order by nombre_genero asc";
                    $result = $conexion->query($consulta);
                    if ($result->num_rows > 0) {
                        $index = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="card">
                                <div class="card-body">
                                    <a href="peliculas.php?id=' . $row["id_genero"] . '">' . $row["nombre_genero"] . '</a>
                                </div>
                            </div>';
                            $index++;
                        }
                    } else {
                        echo "0 resultados";
                    }
                    ?>
                </div>
            </section>
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </main>




        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>

    </div>
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>