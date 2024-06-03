<?php session_start(); ?>
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
    <title>Resultados de Busqueda</title>


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
        <?php
       $busqueda= $_GET["buscar"];
        
     
       $consulta="SELECT * FROM peliculas INNER JOIN peli_director ON peliculas.id_peli = peli_director.id_peli
       INNER JOIN director ON peli_director.id_director = director.id_director
       INNER JOIN peli_actor ON peliculas.id_peli = peli_actor.id_peli
       INNER JOIN actor ON peli_actor.id_actor = actor.id_actor
       INNER JOIN peli_genero ON peliculas.id_peli = peli_genero.id_peli
       INNER JOIN genero ON peli_genero.id_genero = genero.id_genero
       WHERE peliculas.titulo LIKE '%$busqueda%'
       OR director.nombre LIKE '%$busqueda%'
       OR director.apellido LIKE '%$busqueda%'
       OR actor.nombre LIKE '%$busqueda%'
       OR actor.apellido LIKE '%$busqueda%'
       OR genero.nombre_genero LIKE '%$busqueda%'
       GROUP BY peliculas.id_peli, peliculas.titulo";
     
       $buscar = mysqli_query($conexion, $consulta);
     
       if ($buscar-> num_rows > 0){
         $resultado='<div class="volver-atras">';
         $resultado.='<a href="index.php" class="h2-animate"><i class="fas fa-arrow-left"></i> Resultados de la Busqueda</a>';
         $resultado.='</div>';
         $resultado .= '<section class="peliculas-container animate-from-bottom">';
         while ($row = mysqli_fetch_assoc($buscar)) {
           $resultado .= '<div class="pelicula-item">';
           $resultado .= '<a href="detalle_peli.php?id_peli=' . $row["id_peli"] . '">';
           $resultado .= '<img src="' . $row["path_poster"] . '" alt="">';
           $resultado .= '</a>';
           $resultado .= '</div>';
         }
         $resultado .= '</section>';
       }
      else {
       $resultado ='<p>No se encontraron resultados.</p>';
         
      }
      echo $resultado;

      ?>
        <script src="script/jquery.js"></script>
        <script src="slick/slick.min.js"></script>
        <script src="script/script.js"></script>
        <script src="script/botonTop.js"></script>
        <script>
                $('#busca').val("<?= $busqueda ?>");

        </script>
    
    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>


    </div>
</body>
</html>