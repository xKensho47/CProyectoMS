<?php session_start();

if (!isset($_SESSION['id_cuenta'])) {
    header("Location: index.php");
} 

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
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
    <title>Generos</title>
</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("header.php");
        require_once("loginVerification.php");
        
        if(isset($_GET['status'])) {
            // Verificar si el parámetro 'status' tiene el valor 'success'
            if($_GET['status'] === 'success') {
                echo '<div class="mensaje-exito genero-mensaje">Ya has seleccionado el máximo de 3 géneros favoritos.</div>';
            }
        }
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
                            <div class="card card2">
                                <div class="card-body">
                                    <a href="peliculas.php?id=' . $row["id_genero"] . '" >' . $row["nombre_genero"] . '</a>
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
    <?php include('footer.php'); ?>
</body>

</html>