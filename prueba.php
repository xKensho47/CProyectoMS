<div class="modal fade" id="nuevoModalGenero" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="nuevoModalLabel">Agregar/Eliminar un género</h1>
                <button type="button" class="btn-close btn-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">
                <form action="guardar_genero.php" method="post" enctype="multipart/form-data">
                    <h2 class="modal-title fs-3" id="nuevoModalLabel">Agregar</h2>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                    <h2 class="modal-title fs-3" id="nuevoModalLabel">Eliminar</h2>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género:</label>
                        <select name="genero[]" id="genero" class="form-control" multiple>
                            <option value="">Seleccionar...</option>
                            <?php while ($row_genero = $generos->fetch_assoc()) { ?>
                                <option value="<?php echo $row_genero["id_genero"]; ?>"><?php echo $row_genero["nombre_genero"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="">
                        <button type="button" class="btn guardar" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn salir"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>