<?php
include("conexion.php");

// Obtener todas las imágenes de perfil disponibles desde la base de datos
$sqlProfile = "SELECT id_img FROM cuenta_usuario";
$resultado_imagenes = $conexion->query($sqlProfile);
?>

<!-- editarPerfil_modal.php -->
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editaModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="text" class="form-control" id="avatar" name="id_img">
                    </div>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="mail" name="mail">
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
