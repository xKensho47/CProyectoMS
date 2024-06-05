<?php
include("conexion.php");

// Obtener todas las imágenes de perfil disponibles desde la base de datos
$sqlProfile = "SELECT id_img, img FROM img_perfil";
$resultado_imagenes = $conexion->query($sqlProfile);

session_start();

// Verificar si la sesión está iniciada y si 'id_cuenta' está definida
if (!isset($_SESSION['id_cuenta'])) {
    die("Error: No se ha iniciado sesión.");
}

// Consulta para obtener la información del usuario
$id_cuenta = $_SESSION['id_cuenta'];
$sql = "SELECT nombre_usuario FROM cuenta_usuario WHERE id_cuenta = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id_cuenta);
$stmt->execute();
$resultado = $stmt->get_result();
$user_row = $resultado->fetch_assoc();
?>
<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editaModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" method="POST" action="editarPerfil.php">
                    <input type="hidden" id="id_cuenta" name="id_cuenta" value="<?php echo $id_cuenta; ?>">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <select class="form-select" id="avatar" name="id_img">
                            <?php while($row = $resultado_imagenes->fetch_assoc()): ?>
                                <option value="<?php echo $row['id_img']; ?>">
                                    <?php echo $row['img']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $user_row['nombre_usuario']; ?>">
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
