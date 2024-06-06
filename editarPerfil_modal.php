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
<div class="modal fade editprofile" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-editprofile">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3" id="editaModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">
                <form id="editProfileForm" method="POST" action="editarPerfil.php">
                    <input type="hidden" id="id_cuenta" name="id_cuenta" value="<?php echo $id_cuenta; ?>">
                    <div class="mb-3 avatar-modal">
                        <label for="avatar" class="form-label avatar-label">Avatar</label>
                        <!-- Imagen de vista previa -->
                        <div class="preview">
                            <img id="preview" class="preview-img" src="" alt="Vista previa de la imagen">
                        </div>
                        <select class="form-select" id="avatar" name="id_img" onchange="updatePreview()">
                            <?php while ($row = $resultado_imagenes->fetch_assoc()) : ?>
                                <option value="<?php echo $row['id_img']; ?>" data-img="<?php echo $row['img']; ?>">
                                    <?php echo basename($row['img']); /* Muestra solo el nombre del archivo */ ?>
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
<script>
    function updatePreview() {
        // Obtén la opción seleccionada
        const select = document.getElementById('avatar');
        const selectedOption = select.options[select.selectedIndex];

        // Obtén el path de la imagen desde el atributo data-img
        const imgPath = selectedOption.getAttribute('data-img');

        // Actualiza el src de la imagen de vista previa
        const preview = document.getElementById('preview');
        preview.src = imgPath;
    }

    // Llama a la función una vez para inicializar la vista previa con la opción seleccionada por defecto
    document.addEventListener('DOMContentLoaded', (event) => {
        updatePreview();
    });
</script>