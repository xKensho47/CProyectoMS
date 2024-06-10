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
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <title>Notificaciones</title>
</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("header.php");
        require_once("loginVerification.php");

        /*VERIFICA SI SE SUBIERON PELICULAS NUEVAS ESE MISMO DIA*/

        $consulta_peli_nueva = $conexion->query("SELECT p.titulo, p.fecha_subida, gen.nombres_generos
                                            FROM peliculas p
                                            LEFT JOIN (
                                            SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
                                            FROM peli_genero pg
                                            INNER JOIN genero g ON g.id_genero = pg.id_genero
                                            GROUP BY pg.id_peli
                                            ) AS gen ON p.id_peli = gen.id_peli
                                            WHERE p.fecha_subida= curdate()
                                            GROUP BY p.id_peli, p.titulo, p.fecha_subida;
                                        ");




        $userId = $_SESSION['id_cuenta'];

        // Consulta SQL para obtener las notificaciones
        $query_solicitud = "SELECT cu.id_cuenta,cu.nombre_usuario AS nombre_envia, n.mensaje 
                        FROM notificacion n 
                        JOIN cuenta_usuario cu ON n.usuario_envia = cu.id_cuenta 
                        WHERE n.usuario_recibe = $userId";

        $result_solicitud = $conexion->query($query_solicitud);
        ?>
    </div>
    <main class="notificaciones-main animate-from-bottom">
        <h2 class="h2-animate">Notificaciones</h2>
        <div class="notificaciones">
            <?php

            
            // Verificar si la consulta devolvió resultados
            if ($result_solicitud->num_rows > 0) {
                while ($notificacion = $result_solicitud->fetch_assoc()) {
                    $nombre_envia = $notificacion['nombre_envia'];
                    $mensaje = $notificacion['mensaje'];
                    $usuario_envia_id = $notificacion['id_cuenta'];
                    echo '<div class="notificacion not">';
                    echo '<p class="mensaje">' . htmlspecialchars($nombre_envia) . ' te añadió como amigo.</p>';
                    echo '<form method="post" action="procesar_solicitud.php" class="botones-solicitud">';
                    echo '<input type="hidden" name="usuario_envia_id" value="' . $usuario_envia_id . '">';
                    echo'<button type="submit" name="aceptar[]" value="' . $usuario_envia_id . '">Aceptar</button>';
                    echo'<button type="submit" name="rechazar[]" value="' . $usuario_envia_id . '">Rechazar</button>';
                    echo '</form>';
                    echo '</div>';
                }
            }
            
            if ($consulta_peli_nueva->num_rows > 0) {
                while ($fila = $consulta_peli_nueva->fetch_assoc()) {
                    echo '<div class="notificacion">';
                    echo '<p class="mensaje">¡Nueva película: "' . $fila["titulo"] . '" añadida a la categoría de ' . $fila["nombres_generos"] . '!</p>';
                    echo '<span class="fecha">' . $fila["fecha_subida"] . '</span>';
                    echo '<button class="cerrar-notificacion">x</button>';
                    echo '</div>';
                }
            }
            ?>


        </div>
        <div class="contacto">
            <h2>¿Tenés alguna duda o consulta?,</h2>
            <h2> ¡Contactanos!</h2>
            <a href="contacto.php">Contacto</a>
        </div>
    </main>



    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>

    <script>
        // Seleccionar todos los botones de cerrar notificación
        var botonesCerrar = document.querySelectorAll('.cerrar-notificacion');

        // Agregar un event listener a cada botón
        botonesCerrar.forEach(function(boton) {
            boton.addEventListener('click', function() {
                // Obtener el elemento padre (la notificación)
                var notificacion = this.parentNode;
                // Ocultar la notificación agregando la clase "oculto"
                notificacion.classList.add('oculto');
            });
        });
    </script>

    <footer>
        <p>&copy; CineFlow 2024</p>
    </footer>
</body>

</html>