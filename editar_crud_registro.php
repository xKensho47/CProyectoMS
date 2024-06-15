<?php
include("conexion.php");

    if(!empty($_POST['id_peli'])){    

        if (!empty($_POST['nombre']) || !empty($_POST['descripcion']) || !empty($_POST['estreno']) || !empty($_POST['duracion']) || !empty($_FILES['Path_poster'])) { 
            $id_pelicula = $conexion->real_escape_string($_POST['id_peli']);
            $titulo_pelicula = $conexion->real_escape_string($_POST['nombre']);
            $descripcion_pelicula = $conexion->real_escape_string($_POST['descripcion']);
            $estreno_pelicula = $conexion->real_escape_string($_POST['estreno']);
            $duracion_pelicula = $conexion->real_escape_string($_POST['duracion']); 
            $path_poster = $conexion->real_escape_string($_FILES['Path_poster']['name']);

            if (!empty($_FILES['Path_poster']['name'])) {
                $consulta_imagen_antigua = "SELECT path_poster FROM peliculas WHERE id_peli = '$id_pelicula'";
                $resultado = $conexion->query($consulta_imagen_antigua);
                $fila = $resultado->fetch_assoc();
                $imagen_antigua = $fila['path_poster'];
        
                if (!empty($imagen_antigua) && file_exists($imagen_antigua)) {
                    unlink($imagen_antigua);
                }
        
                $path_poster = "posters/" . basename($_FILES['Path_poster']['name']);
                move_uploaded_file($_FILES['Path_poster']['tmp_name'], $path_poster);
        
                $consulta = ("UPDATE peliculas
                              SET titulo = '$titulo_pelicula',
                                  descripcion = '$descripcion_pelicula',
                                  estreno = '$estreno_pelicula',
                                  duracion = '$duracion_pelicula',
                                  path_poster = '$path_poster'
                              WHERE id_peli = '$id_pelicula'");
            } else {
                $consulta = ("UPDATE peliculas
                              SET titulo = '$titulo_pelicula',
                                  descripcion = '$descripcion_pelicula',
                                  estreno = '$estreno_pelicula',
                                  duracion = '$duracion_pelicula'
                              WHERE id_peli = '$id_pelicula'");
            }
        

            $conexion->query($consulta); 

            if (!empty($_FILES['video_mp4']['name'])) {
                $consulta_video_antiguo = "SELECT video_mp4 FROM peliculas WHERE id_peli = '$id_pelicula'";
                $resultado = $conexion->query($consulta_video_antiguo);
                $fila = $resultado->fetch_assoc();
                $video_antiguo = $fila['video_mp4'];
        
                if (!empty($video_antiguo) && file_exists($video_antiguo)) {
                    unlink($video_antiguo);
                }
        
                $path_video = "videos/" . basename($_FILES['video_mp4']['name']);
                move_uploaded_file($_FILES['video_mp4']['tmp_name'], $path_video);
                
                $cambiar_video= ("UPDATE peliculas 
                                  SET video_mp4 = '$path_video'
                                  WHERE id_peli = '$id_pelicula'");
                
                $conexion->query($cambiar_video);

            }
        }
        
        if (!empty($_POST['generoSeleccionado'])) {
            $array_generos = $_POST['generoSeleccionado'];

            foreach ($array_generos as $genero_seleccionado) {
                $buscar_genero = "SELECT id_genero
                                    FROM peli_genero
                                        WHERE id_genero = $genero_seleccionado 
                                            AND id_peli = $id_pelicula";
                
                $existe_genero = $conexion->query($buscar_genero);

                if(mysqli_num_rows($existe_genero) == 0){
                    $agregar_genero = "INSERT INTO peli_genero (id_peli, id_genero)
                                        VALUES($id_pelicula, $genero_seleccionado)";

                    $conexion->query($agregar_genero);
                } 
            }

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

            foreach ($array_directores as $director_seleccionado) {
                $buscar_director = "SELECT id_director
                                        FROM peli_director
                                            WHERE id_director = $director_seleccionado 
                                                AND id_peli = $id_pelicula";
                
                $existe_director = $conexion->query($buscar_director);

                if(mysqli_num_rows($existe_director) == 0){
                    $agregar_director = "INSERT INTO peli_director (id_peli, id_director)
                                            VALUES($id_pelicula, $director_seleccionado)";

                    $conexion->query($agregar_director);
                } 
            }

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