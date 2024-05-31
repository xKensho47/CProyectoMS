<?php

/*
 * Este archivo consulta los datos del registro y los retorna en formato JSON 
 */

 include("conexion.php");

$id = $conexion->real_escape_string($_POST['id']);

$sql = " SELECT p.id_peli, p.titulo, p.descripcion, p.estreno, p.path_poster, p.duracion, 
            p.video_iframe, p.video_mp4,gen.nombres_generos, act.nom_ape_actor,dir.nom_ape_director FROM 
            peliculas AS p LEFT JOIN (SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
            FROM peli_genero pg INNER JOIN genero g ON g.id_genero = pg.id_genero GROUP BY pg.id_peli) AS gen 
            ON p.id_peli = gen.id_peli LEFT JOIN (SELECT pa.id_peli, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) 
            SEPARATOR ', ') AS nom_ape_actor FROM peli_actor pa INNER JOIN actor a ON a.id_actor = pa.id_actor GROUP BY 
            pa.id_peli) AS act ON p.id_peli = act.id_peli LEFT JOIN (SELECT pd.id_peli, GROUP_CONCAT(CONCAT(d.nombre, ' ', d.apellido) SEPARATOR ', ') AS nom_ape_director FROM peli_director pd INNER JOIN 
            director d ON d.id_director = pd.id_director GROUP BY pd.id_peli) AS dir ON p.id_peli = dir.id_peli
            GROUP BY p.id_peli where id_peli=$id limit 1";

$resultado = $conexion->query($sql);
$rows = $resultado->num_rows;

$pelicula = [];

if ($rows > 0) {
    $pelicula = $resultado->fetch_array();
}

echo json_encode($pelicula, JSON_UNESCAPED_UNICODE);