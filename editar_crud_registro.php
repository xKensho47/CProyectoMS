<?php
include("conexion.php");

    if(!empty($_POST['id_peli'])){

        if (!empty($_POST['nombre']) || !empty($_POST['descripcion']) || !empty($_POST['estreno']) || !empty($_POST['duracion'])) {  
        $id_pelicula = $conexion->real_escape_string($_POST['id_peli']);
        $titulo_pelicula = $conexion->real_escape_string($_POST['nombre']);
        $descripcion_pelicula = $conexion->real_escape_string($_POST['descripcion']);
        $estreno_pelicula = $conexion->real_escape_string($_POST['estreno']);
        $duracion_pelicula = $conexion->real_escape_string($_POST['duracion']); 

        $consulta = ("UPDATE peliculas
                        SET titulo = '$titulo_pelicula',
                            descripcion = '$descripcion_pelicula',
                                estreno = '$estreno_pelicula',
                                    duracion = '$duracion_pelicula'
                                        WHERE id_peli= '$id_pelicula'");               
            
        $conexion->query($consulta);
        }

        if (!empty($_POST['generoSeleccionado'])) {
            $array_generos = $_POST['generoSeleccionado'];

            //Recorro array Generos
            foreach ($array_generos as $genero_seleccionado) {
                $buscar_genero = "SELECT id_genero
                                    FROM peli_genero
                                        WHERE id_genero = $genero_seleccionado 
                                            AND id_peli = $id_pelicula";
                
                $existe_genero = $conexion->query($buscar_genero);

                //De no existir lo agrego 
                if(mysqli_num_rows($existe_genero) == 0){
                    $agregar_genero = "INSERT INTO peli_genero (id_peli, id_genero)
                                        VALUES($id_pelicula, $genero_seleccionado)";

                    $conexion->query($agregar_genero);
                } 
            }

            //Conversion de array en string
            $generos_string = implode(', ', $array_generos);

            //Elimino aquellos generos que no estan seleccionados pero que si figuran en la tabla
            $generos_eliminar = "DELETE 
                                    FROM peli_genero
                                        WHERE id_peli = $id_pelicula 
                                            AND id_genero NOT IN ($generos_string)";

            $conexion->query($generos_eliminar);
        }

        if (!empty($_POST['actorSeleccionados'])) {
            $array_actores = $_POST['actorSeleccionados'];

            //Recorro array Actores
            foreach ($array_actores as $actor_seleccionado) {
                $buscar_actor = "SELECT id_actor
                                    FROM peli_actor
                                        WHERE id_actor = $actor_seleccionado 
                                            AND id_peli = $id_pelicula";
                
                $existe_actor = $conexion->query($buscar_actor);

                //De no existir lo agrego 
                if(mysqli_num_rows($existe_actor) == 0){
                    $agregar_actor = "INSERT INTO peli_actor (id_peli, id_actor)
                                        VALUES($id_pelicula, $actor_seleccionado)";

                    $conexion->query($agregar_actor);
                } 
            }

            //Conversion de array en string
            $actores_string = implode(', ', $array_actores);

            //Elimino aquellos actores que no estan seleccionados pero que si figuran en la tabla
            $actores_eliminar = "DELETE 
                                    FROM peli_actor
                                        WHERE id_peli = $id_pelicula 
                                            AND id_actor NOT IN ($actores_string)";

            $conexion->query($actores_eliminar);
        }

        if (!empty($_POST['directoresSeleccionados'])) {
            $array_directores = $_POST['directoresSeleccionados'];

            //Recorro array Directores
            foreach ($array_directores as $director_seleccionado) {
                $buscar_director = "SELECT id_director
                                        FROM peli_director
                                            WHERE id_director = $director_seleccionado 
                                                AND id_peli = $id_pelicula";
                
                $existe_director = $conexion->query($buscar_director);

                //De no existir lo agrego 
                if(mysqli_num_rows($existe_director) == 0){
                    $agregar_director = "INSERT INTO peli_director (id_peli, id_director)
                                            VALUES($id_pelicula, $director_seleccionado)";

                    $conexion->query($agregar_director);
                } 
            }

            //Conversion de array en string
            $directores_string = implode(', ', $array_directores);

            //Elimino aquellos directores que no estan seleccionados pero que si figuran en la tabla
            $directores_eliminar = "DELETE 
                                        FROM peli_director
                                            WHERE id_peli = $id_pelicula 
                                                AND id_director NOT IN ($directores_string)";

            $conexion->query($directores_eliminar);
        }
    }

    header('Location: crud_peliculas.php?status=success');
    exit();   
?>