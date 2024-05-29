<?php
if (!function_exists('resultCarousel')) {
    function resultCarousel($conexion, $title){
        switch($title){
            case 'Películas más valoradas':
                $q =
                "SELECT 
                    val.id_peli AS id,
                    val.calificacion AS calificacion,
                    peli.path_poster AS poster,
                    peli.titulo AS titulo
                FROM 
                    peliculas peli
                INNER JOIN
                    valoracion_peliculas val 
                ON 
                    val.id_peli = peli.id_peli
                GROUP BY 
                    titulo
                ORDER BY 
                    val.calificacion DESC
                LIMIT 10;
                ";

            
                break;

            case 'Recientes':
                $q =
                "SELECT 
                    peli.id_peli AS id,
                    peli.path_poster AS poster,
                    peli.titulo AS titulo,
                    peli.fecha_subida AS recientes
                FROM 
                    peliculas peli
                ORDER BY 
                    peli.fecha_subida DESC
                LIMIT 10;
                ";

            
                break;

            case 'Continuar viendo':
                $q =
                "
                
                ";
            
                break;

            case 'Ver más tarde':
                $q =
                "
                
                ";
            
                break;

            case 'Favoritas':
                $q =
                "
                
                ";
            
                break;
            
            default:
                echo 'Datos no encontrados';
                break;
        }

        return $result = mysqli_query($conexion, $q);

    }
}
?>