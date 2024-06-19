<?php
session_start();

include("conexion.php");
include("header.php");
require_once("loginVerification.php");

/*DEVUELVE TODA LA INFORMACION DE UNA PELICULA*/
$sqlBase = "SELECT p.id_peli, p.titulo, p.descripcion, p.estreno, p.path_poster, p.duracion,
            p.video_mp4, gen.nombres_generos, act.nom_ape_actor, dir.nom_ape_director 
            FROM peliculas AS p 
            LEFT JOIN (SELECT pg.id_peli, GROUP_CONCAT(g.nombre_genero SEPARATOR ', ') AS nombres_generos
            FROM peli_genero pg INNER JOIN genero g ON g.id_genero = pg.id_genero GROUP BY pg.id_peli) AS gen 
            ON p.id_peli = gen.id_peli 
            LEFT JOIN (SELECT pa.id_peli, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) 
            SEPARATOR ', ') AS nom_ape_actor FROM peli_actor pa INNER JOIN actor a ON a.id_actor = pa.id_actor GROUP BY 
            pa.id_peli) AS act ON p.id_peli = act.id_peli 
            LEFT JOIN (SELECT pd.id_peli, GROUP_CONCAT(CONCAT(d.nombre, ' ', d.apellido) SEPARATOR ', ') AS nom_ape_director 
            FROM peli_director pd INNER JOIN 
            director d ON d.id_director = pd.id_director GROUP BY pd.id_peli) AS dir ON p.id_peli = dir.id_peli
            GROUP BY p.id_peli";

// Verifica si se envió una solicitud de búsqueda y la búsqueda no está vacía
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $conexion->real_escape_string($_GET['busqueda']);

    // Consulta para la búsqueda
    $sqlBusqueda = "SELECT * FROM ($sqlBase) AS resultados WHERE resultados.titulo LIKE '%$busqueda%' ";
} else {
    // Si no hay búsqueda, usar la consulta base
    $sqlBusqueda = $sqlBase;
}

// Ejecutar la consulta
$peliculas = $conexion->query($sqlBusqueda);
/*LLAMA A LA TABLA ACTORES*/
$actores = $conexion->query("SELECT id_actor, nombre, apellido FROM actor");
/*LLAMA A LA TABLA DIRECTORES*/
$directores = $conexion->query("SELECT id_director, nombre, apellido FROM director");

/* LLAMA A LOS GENEROS, DIRECTORES Y ACTORES PARA LA TABLA */
$sqlGenero = "SELECT id_genero, nombre_genero FROM genero";
$generos = $conexion->query($sqlGenero);

$sqlDirector = "SELECT id_director, nombre, apellido FROM director";
$directores = $conexion->query($sqlDirector);

$sqlActor = "SELECT id_actor, nombre, apellido FROM actor";
$actores = $conexion->query($sqlActor);
?>
