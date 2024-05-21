<!-- Modal nuevo registro -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="nuevoModalLabel">Agregar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="guardar_pelicula.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Titulo:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="estreno" class="form-label">Estreno:</label>
                        <input type="date" name="estreno" id="estreno" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duracion:</label>
                        <input type="number" name="duracion" id="duracion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="Path_poster" class="form-label">Path_poster:</label>
                        <input type="text" name="Path_poster" id="Path_poster" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género:</label>
                        <select name="genero" id="genero" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php while ($row_genero = $generos->fetch_assoc()) { ?>
                                <option value="<?php echo $row_genero["id_genero"]; ?>"><?= $row_genero["nombre_genero"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="video_mp4" class="form-label">Video_mp4:</label>
                        <input type="text" name="video_mp4" id="video_mp4" class="form-control" >
                    </div>
                    
                    <div class="mb-3">
                        <label for="video_iframe" class="form-label">video_iframe:</label>
                        <input type="text" name="video_iframe" id="video_iframe" class="form-control" >
                    </div>

                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>