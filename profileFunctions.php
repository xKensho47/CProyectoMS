<?php
include("conexion.php");

function continueCarousel($conexion){
    $id_cuenta = $_SESSION['id_cuenta'];

    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        seguir_viendo cv 
    ON 
        p.id_peli = cv.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        cv.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_cuenta
    ";

    $title = 'Continuar viendo';
    $result = mysqli_query($conexion, $q);
    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='x-carousel-container'>
                    <button class='carousel-prev'>&#60</button>
                    <div class='carousel-slide'>";

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = $row["poster"];
                    echo "
                        <div class='x-carousel-movie'>
                        <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                            <img src=' " . $imagePath . " ' alt='Movie Posters'>
                        
                        </a>
                        </div>
                        ";
            
                }
            } else {
                echo '<p>No se encontraron peliculas.</p>';
            }
    echo "
        </div>
        <button class='carousel-next'>&#62</button>
        </div>
    </article>
    </section>
    ";
}
//CARRUSEL 'VER MAS TARDE'
function laterCarousel($conexion){
    $id_cuenta = $_SESSION['id_cuenta'];

    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        mas_tarde mt
    ON 
        p.id_peli = mt.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        mt.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_cuenta
    LIMIT 4
    ";
    $title = 'Ver más tarde';

    $result = mysqli_query($conexion, $q);

    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='contenedor-peliculas'>
                    ";
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = $row["poster"];
                            echo "  
                                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                    <img src=' " . $imagePath . " ' alt='Movie Posters'>
                                </a>
                                ";
                        }
                    } else {
                        echo '<p>No movies found.</p>';
                    }

                    if ($result->num_rows > 3){
                        echo "<a href='verMasTardePerfil.php' class='btn btn-color fs-5'>Ver más</a>";
                    }
        echo "
            </div>
        </article>
        </section>
        ";
}


// CARRUSEL DE FAVORITOS
function favoritesCarousel($conexion){
    $id_cuenta = $_SESSION['id_cuenta'];
    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        peli_favorita pf 
    ON 
        p.id_peli = pf.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        pf.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_cuenta
    LIMIT 4
    ";
    $title = 'Favoritas';
    $result = mysqli_query($conexion, $q);

    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='contenedor-peliculas'>
                    ";
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = $row["poster"];
                            echo "  
                                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                                    <img src=' " . $imagePath . " ' alt='Movie Posters'>
                                </a>
                                ";
                        }
                    } else {
                        echo '<p>No movies found.</p>';
                    }

                    if ($result->num_rows > 3){
                        echo "<a href='favoritosPerfil.php' class='btn btn-color fs-5'>Ver más</a>";
                    }
        echo "
            </div>
        </article>
        </section>
        ";
}

/* FUNCIONES PARA PERFILES AJENOS */
/* CARRUSEL CONTINUAR VIENDO */
function continueCarousel2($conexion, $id_profile){
    $id_cuenta = $_SESSION['id_cuenta'];

    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        seguir_viendo cv 
    ON 
        p.id_peli = cv.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        cv.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_profile
    ";

    $title = 'Continuar viendo';
    $result = mysqli_query($conexion, $q);
    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='x-carousel-container'>
                    <button class='carousel-prev'>&#60</button>
                    <div class='carousel-slide'>";
    /* Ordenar por puesto */
    /*$puesto = 1;*/

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row["poster"];
            echo "
                <div class='x-carousel-movie'>
                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                    <img src=' " . $imagePath . " ' alt='Movie Posters'>
                  
                </a>
                </div>
                ";
            /*$puesto++;*/
        }
    } else {
        echo '<p>No movies found.</p>';
    }
    echo "
        </div>
        <button class='carousel-next'>&#62</button>
        </div>
    </article>
    </section>
    ";
}
//CARRUSEL 'VER MAS TARDE'
function laterCarousel2($conexion, $id_profile){
    $id_cuenta = $_SESSION['id_cuenta'];

    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        mas_tarde mt
    ON 
        p.id_peli = mt.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        mt.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_profile
    ";
    $title = 'Ver más tarde';

    $result = mysqli_query($conexion, $q);

    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='x-carousel-container'>
                    <button class='carousel-prev'>&#60</button>
                    <div class='carousel-slide'>";

    /* Ordenar por puesto */
    /*$puesto = 1;*/

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row["poster"];
            echo "
                <div class='x-carousel-movie'>
                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                    <img src=' " . $imagePath . " ' alt='Movie Posters'>
                 
                </a>
                </div>
                ";
            /*$puesto++;*/
        }
    } else {
        echo '<p>No movies found.</p>';
    }
    echo "
        </div>
        <button class='carousel-next'>&#62</button>
        </div>
    </article>
    </section>
    ";
}


// CARRUSEL DE FAVORITOS
function favoritesCarousel2($conexion, $id_profile){
    $id_cuenta = $_SESSION['id_cuenta'];
    $q =
    "SELECT 
        p.id_peli AS id, 
        p.path_poster AS poster, 
        p.titulo AS titulo
    FROM 
        peliculas p
    JOIN 
        peli_favorita pf 
    ON 
        p.id_peli = pf.id_peli
    JOIN 
        cuenta_usuario cu 
    ON 
        pf.id_cuenta = cu.id_cuenta
    WHERE 
        cu.id_cuenta = $id_profile
    ";
    $title = 'Favoritas';
    $result = mysqli_query($conexion, $q);
    echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
            <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
                <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
                    <h2 class='x-tittle h2-animate' id='x-tittle-$title'>  $title  </h2>
                    <hr class='hr-carrusel'>
                </div>
                <div class='x-carousel-container'>
                    <button class='carousel-prev'>&#60</button>
                    <div class='carousel-slide'>";
    /* Ordenar por puesto */
    /*$puesto = 1;*/

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row["poster"];
            echo "
                <div class='x-carousel-movie'>
                <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                    <img src=' " . $imagePath . " ' alt='Movie Posters'>
                   
                </a>
                </div>
                ";
            /*$puesto++;*/
        }
    } else {
        echo '<p>No movies found.</p>';
    }
    echo "
        </div>
        <button class='carousel-next'>&#62</button>
        </div>
    </article>
    </section>
    ";
}

?>