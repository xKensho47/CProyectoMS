<?php
session_start(); ?>
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
    <title>Notificaciones</title>


</head>

<body>
    <div class="container">
        <?php
        include("conexion.php");
        include("header.php");
        require_once("loginVerification.php");
  
        


        $notificacion = isset($_GET['notificacion']) && $_GET['notificacion'] == 1;

        /* VERIFICA SI SE SUBIERON PELICULAS NUEVAS ESE MISMO DIA */

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
        $query_solicitud = "SELECT cu.id_cuenta, cu.nombre_usuario AS nombre_envia, n.mensaje, n.id_peli, n.fecha
                            FROM notificacion n 
                            JOIN cuenta_usuario cu ON n.usuario_envia = cu.id_cuenta 
                            WHERE n.usuario_recibe = $userId";

        $result_solicitud = $conexion->query($query_solicitud);
        /*devuelve los nombres de usuarios que mandaron un correo*/
        $nombre_cuenta=$conexion->query("SELECT u.nombre_usuario,c.*  FROM cuenta_usuario u
                                RIGHT JOIN contacto c ON c.id_cuenta=u.id_cuenta");

        ?>
        <main class="notificaciones-main animate-from-bottom">
            <aside class="notif">
                <h2 class="h2-animate">Notificaciones</h2>
                <div class="notificaciones">
                    <?php
                    // Variable bandera para verificar si hay resultados
                    $hayResultados = false;
                    // Verificar si la consulta devolvió resultados
                    if ($result_solicitud->num_rows > 0) {
                        $hayResultados = true; // Se encontraron resultados
                        while ($notificacion = $result_solicitud->fetch_assoc()) {
                            $nombre_envia = $notificacion['nombre_envia'];
                            $mensaje = $notificacion['mensaje'];
                            $usuario_envia_id = $notificacion['id_cuenta'];
                            $fecha = $notificacion['fecha'];
                            $peli = $notificacion['id_peli'];
                            if ($mensaje) {
                                echo '<div class="notificacion not">';
                                echo '<p class="mensaje">' . htmlspecialchars($nombre_envia) . ' te añadió como amigo.</p>';
                                echo '<form method="post" action="procesar_solicitud.php" class="botones-solicitud">';
                                echo '<input type="hidden" name="usuario_envia_id" value="' . $usuario_envia_id . '">';
                                echo '<button type="submit" name="aceptar[]" value="' . $usuario_envia_id . '">Aceptar</button>';
                                echo '<button type="submit" name="rechazar[]" value="' . $usuario_envia_id . '">Rechazar</button>';
                                echo '</form>';
                                echo '</div>';
                            } else {
                                $result_peli = $conexion->query("SELECT titulo FROM peliculas WHERE id_peli=$peli");
                                $pelicula = $result_peli->fetch_assoc();
                                $titulo_pelicula = $pelicula['titulo'];
                                echo '<div class="notificacion">';
                                echo '<p class="mensaje">' . htmlspecialchars($nombre_envia) . ' te recomendó ver: "' . htmlspecialchars($titulo_pelicula) . '"</p>';
                                echo '<span class="fecha">' . $fecha . '</span>';
                                echo '<button type="submit" class="cerrar-notificacion ver" data-id-peli="' . $peli . '">Ver</button>';
                                echo '<form method="post" action="eliminar_notificacion.php" class="eliminar-form">';
                                echo '<input type="hidden" name="usuario_envia" value="' . $usuario_envia_id . '">';
                                echo '<input type="hidden" name="usuario_recibe" value="' . $_SESSION['id_cuenta'] . '">';
                                echo '<input type="hidden" name="tipo_mensaje" value="' . $mensaje . '">';
                                echo '<input type="hidden" name="id_peli" value="' . $peli . '">';
                                echo '<input type="hidden" name="fecha" value="' . $fecha . '">';
                                echo '<input type="hidden" name="accion" value="eliminar">';
                                echo '<button type="submit" class="cerrar-notificacion eliminar">x</button>';
                                echo '</form>';
                                echo '</div>';
                            }
                        }
                    }

                    if ($consulta_peli_nueva->num_rows > 0) {
                        $hayResultados = true; // Se encontraron resultados
                        $hayNotificacion = false;
                        while ($fila = $consulta_peli_nueva->fetch_assoc()) {
                            echo '<div class="notificacion">';
                            echo '<p class="mensaje">¡Nueva película: "' . $fila["titulo"] . '" añadida a la categoría de ' . $fila["nombres_generos"] . '!</p>';
                            echo '<span class="fecha">' . $fila["fecha_subida"] . '</span>';
                            echo '</div>';
                        }
                    }

                    // Mostrar mensaje si no hay resultados
                    if (!$hayResultados) {
                        echo '<div class="notificacion">';
                        echo '<p class="mensaje">No hay nuevas notificaciones.</p>';
                        echo '</div>';
                    }

                    ?>
                </div>
            </aside>
            <?php 
                if($id_tipo==2){

                   echo' <aside class="contact">
                   <div class="contacto">
                            <div style="position: relative; display: inline-block;">
                                <h2 class="borde">¿Tenés alguna duda o consulta?</h2>
                                <h2 class="wave" style="position: absolute; top: 0; left: 0;">¿Tenés alguna duda o consulta?</h2>
                            </div>
                            <div style="position: relative; display: inline-block;">
                                <h3 class="borde">¡Contactanos!</h3>
                                <h3 class="wave" style="position: absolute; top: 0; left: 0;">¡Contactanos!</h3>
                            </div>
                            <a href="contacto.php">Contacto</a>
                        </div>
                    </aside>';
                }else{
                    echo'<aside class="notif ">
                            <h2 class="h2-animate">Correo</h2>';
                            if ($nombre_cuenta->num_rows > 0) {
                                while($result_nombre=$nombre_cuenta->fetch_assoc()){
                                   echo' <div class="notificaciones">
                                            <div class="notificacion ">
                                                <p class="mensaje">¡tienes mails sin responder de <span class="nombre-correo h2-animate">'.$result_nombre['nombre_usuario'].'</span> !</p>
                                                 <p class="mensaje mensaje-contact"> '.$result_nombre['mensaje'].'</p>
                                            </div>
                                        </div>';
                                }
                            }
                         echo' </aside>';
                    
                }
            ?>
        </main>
    </div>

    <script src="script/jquery.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/botonTop.js"></script>

    <script>
        // Captura el clic en el botón "Ver"
        document.querySelectorAll('.ver').forEach(function(el) {
            el.addEventListener('click', function() {
                // Obtiene el ID de la película desde el atributo data
                var idPeli = this.getAttribute('data-id-peli');
                // Redirige a detalle_peli.php con el ID de la película
                window.location.href = 'detalle_peli.php?id_peli=' + idPeli;
            });
        });

    </script>


    <?php include('footer.php'); ?>
</body>

</html>