<?php
$sqlDirector = "SELECT id_director, nombre, apellido FROM director";
$directores = $conexion->query($sqlDirector);
?>
<div class="modal fade " id="nuevoModalDirector" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="nuevoModalLabel">Agregar/Elimine un director</h1>
                <button type="button" class="btn-close btn-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">
                <form action="guardar_director.php" method="post" enctype="multipart/form-data">
                    <h2 class="modal-title fs-3" id="nuevoModalLabel">Agregar</h2>
                    <div class="mb-3 ">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control fs-5" >
                    </div>
                    <div class="mb-3 ">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control fs-5" >
                    </div>
                    <h2 class="modal-title fs-3" id="nuevoModalLabel">Eliminar</h2>
                    <div class="mb-3">
                        <label for="director" class="form-label">Director:</label>
                        <select name="director" id="director" class="form-select fs-5" >
                            <option class="fs-5" value="">Seleccionar...</option>
                            <?php while ($row_director = $directores->fetch_assoc()) { ?>
                                <option  class="fs-5" value="<?php echo $row_director["id_director"]; ?>"><?= $row_director["nombre"]; ?> <?= $row_director["apellido"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="">
                        <button type="button" class="btn guardar fs-5" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn salir fs-5"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>