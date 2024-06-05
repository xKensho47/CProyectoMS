<?php 

//VENTANA EMERGENTE

$sqlUsuario = "SELECT id_usuario, nombre, apellido, mail, id_tipo FROM usuarios";
$usuarios = $conexion->query($sqlUsuario);
?>
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="EditaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-3" id="EditaModalLabel">Editar usuario</h1>
                <button type="button" class="btn-close btn-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body fs-5">

                <form action="editar_usuario.php" method="post">

                    <div class="mb-3 ">
                        <input type="hidden" name="id_usuario" id="id_usuario" class="form-control fs-5">

                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control fs-5" required>

                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control fs-5" required>

                        <label for="mail" class="form-label">Mail:</label>
                        <input type="text" name="mail" id="mail" class="form-control fs-5" required>

                        <label for="tipo_usuario" class="form-label">Tipo Usuario:</label>

                        <select name="tipo_usuario" id="tipo_usuario" class="form-control fs-5">
                            <option value = "1"> Administrador </option>
                            <option value = "2"> Normal </option>
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