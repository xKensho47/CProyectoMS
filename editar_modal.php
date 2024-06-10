<?php
/* LLAMAR A LOS GENEROS */
$sqlGenero = "SELECT id_genero, nombre_genero FROM genero";
$generos = $conexion->query($sqlGenero);
/* LLAMA A LA TABLA ACTORES */
$actores = $conexion->query("SELECT id_actor, CONCAT(nombre, ' ', apellido) AS nom_ape_actor FROM actor");
/* LLAMA A LA TABLA DIRECTORES */
$directores = $conexion->query("SELECT id_director, CONCAT(nombre, ' ', apellido) AS nom_ape_director FROM director");

$pelicula = "SELECT id_peli, titulo, descripcion, estreno, duracion FROM peliculas";
$queryPelicula = $conexion->query($pelicula);
?>
<!-- Modal -->
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="editaModalLabel">Modificar registro</h1>
                <button type="button" class="btn-close btn-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">
                <form action="actualiza.php" method="post" id="formulario_peliculas" enctype="multipart/form-data">
                    <input type="hidden" id="id_peli" name="id_peli">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Titulo:</label>
                        <input type="text" name="nombre" id="nombre_pelicula" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion_pelicula" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="estreno" class="form-label">Estreno:</label>
                        <input type="date" name="estreno" id="estreno_pelicula" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duracion:</label>
                        <input type="number" name="duracion" id="duracion_pelicula" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="Path_poster" class="form-label">Path_poster:</label>
                        <input type="file" name="Path_poster" id="Path_poster" class="form-control">
                    </div>

                    <!-- TRAE TODOS LOS GENEROS -->
                    <div class="row mb-3">
                        <label for="genero" class="form-label">Género:</label>
                        <?php while ($row_genero = $generos->fetch_assoc()) { ?>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="generoSeleccionado[]" value="<?php echo $row_genero["id_genero"]; ?>" id="genero_<?php echo $row_genero["nombre_genero"]; ?>">
                                    <label class="form-check-label" for="genero_<?php echo $row_genero["nombre_genero"]; ?>">
                                        <?php echo $row_genero["nombre_genero"]; ?>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- TRAE TODOS LOS ACTORES CON SUS NOMBRES Y APELLIDOS CONCATENADOS -->
                    <div class="row mb-3">
                        <label for="actores" class="form-label">Actores:</label>
                        <?php while ($row_actor = $actores->fetch_assoc()) { ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="actorSeleccionados[]" value="<?php echo $row_actor["id_actor"]; ?>" id="actor_<?php echo $row_actor["nom_ape_actor"]; ?>">
                                    <label class="form-check-label" for="actor_<?php echo $row_actor["nom_ape_actor"]; ?>">
                                        <?php echo $row_actor["nom_ape_actor"]; ?>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- TRAE TODOS LOS DIRECTORES CON SUS NOMBRES Y APELLIDOS CONCATENADOS -->
                    <div class="row mb-3">
                        <label for="directores" class="form-label">Directores:</label>
                        <?php while ($row_director = $directores->fetch_assoc()) { ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="directoresSeleccionados[]" value="<?php echo $row_director["id_director"]; ?>" id="director_<?php echo $row_director["nom_ape_director"]; ?>">
                                    <label class="form-check-label" for="director_<?php echo $row_director["nom_ape_director"]; ?>">
                                        <?php echo $row_director["nom_ape_director"]; ?>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="mb-3">
                        <label for="video_mp4" class="form-label">Video_mp4:</label>
                        <input type="text" name="video_mp4" id="video_mp4" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="video_iframe" class="form-label">video_iframe:</label>
                        <input type="text" name="video_iframe" id="video_iframe" class="form-control">
                    </div>

                    <div class="">
                        <button type="button" class="btn guardar" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardar" class="btn guardar">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>