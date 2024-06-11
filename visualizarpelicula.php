<?php session_start(); 
include("conexion.php");

$id=$_GET['id_peli'];

$consulta="SELECT * FROM peliculas WHERE id_peli= $id";

$resultado=mysqli_query($conexion,$consulta);

$pelicula=mysqli_fetch_assoc($resultado);

?>
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
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title><?='Ver '. $pelicula['titulo'];?></title>
</head>

<body>
    <div class="container">
        <?php
        include("header.php");
        require_once("loginVerification.php");
        ?>
    </div>
    <div class="volverAdetalles">
        <a href="detalle_peli.php?id_peli=<?= $id;?>" class="h2-animate"><i class="fas fa-arrow-left"></i> <?= $pelicula['titulo'];?></a>
        </div>
        <input type="hidden" id="currentTime" name="currentTime" value="0">
        <main class="video-container">
        <?php if ($pelicula['video_iframe']){ ?>
        <div>
            <?php echo $pelicula['video_iframe']; ?>
        </div>
    <?php }elseif ($pelicula['video_mp4']){ ?>
        <video controls id="video">
            <source src="<?php echo htmlspecialchars($pelicula['video_mp4']); ?>" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    <?php }
    else{
    ?>
        <h2> Proximamente </h2>
    <?php 
    }
     ?>
    </main>

    <?php
    $id_cuenta = $_SESSION['id_cuenta'];
    $progresoQuery = "SELECT * FROM seguir_viendo WHERE id_cuenta = $id_cuenta AND id_peli = $id";
    $progresoResultado = mysqli_query($conexion, $progresoQuery);
    $progreso = mysqli_fetch_assoc($progresoResultado);
    $ultimo_punto = $progreso['tiempo_visto'] ?? 0;
    ?>

        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>

        <script>
            $(document).ready(function(){
                var video = $("#video")[0];
                var ultimo_punto = <?php echo json_encode($ultimo_punto); ?>;

                if(ultimo_punto > 0){
                    video.currentTime = ultimo_punto;
                }
                
                /* Actualiza el progreso de la peli cada 5 seg en la base de datos */
                var intervalo = setInterval(function() {
                    $.post('guardar_progreso.php', {
                    id_peli: <?= $id ?>,
                    progreso: video.currentTime,
                    duracion_total: video.duration
                    });
                }, 5000);

                /* Actualiza el progreso de la peli antes de actualizar la pagina o salir en la base de datos */
                $(window).on('beforeunload', function() {
                    clearInterval(intervalo);
                    $.post('guardar_progreso.php', {
                    id_peli: <?= $id ?>,
                    progreso: video.currentTime,
                    duracion_total: video.duration
                });
                });
            });
        
        </script>

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>