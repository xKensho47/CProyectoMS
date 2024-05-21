<?php
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contra = md5($_POST['password']);

    $usuario_regis = mysqli_query($conexion, "SELECT id_usuario from usuarios where nombre_usuario = '$usuario'");
    $pregunta = mysqli_query($conexion, "SELECT id_usuario , nombre_usuario, mail from usuarios where nombre_usuario = '$usuario' and contraseña = '$contra'");
    if ($usuario_regis->num_rows == 0) {
        echo '
            <div class="overlay show" id="overlay-mail-nuevo">
                <div class="popup">
                    <span class="popup-close" id="pop-mail-nuevo">&times;</span>
                    <div class="popup-content">
                        <div class="descripcion_accion">
                            <p>Parece que no existe este Usuario! 😮</p>
                        </div>
                    </div>
                    <div class="popup-buttons">
                        <form method="POST" action="form_registro.php">
                            <button>Crear Cuenta</button>
                        </form>
                        <button id="boton-mail-nuevo">Intentar denuevo con otro Usuario</button>
                    </div>
                </div>
            </div>
            ';
    } else if ($pregunta->num_rows == 0) {
        echo '
            <div class="overlay show" id="overlay-incorrecto">
                <div class="popup">
                    <span class="popup-close" id="pop-incorrecto">&times;</span>
                    <div class="popup-content">
                        <div class="descripcion_accion"><p>Error de ingreso! No coinciden los datos 😢<br>Revise el usuario o contraseña</p></div>
                    </div>
                    <div class="popup-buttons">
                        <button id="boton-incorrecto">Intentar denuevo</button>
                    </div>
                </div>
            </div>
            ';
    } else if ($pregunta->num_rows == 1) {
        $row = $pregunta->fetch_assoc();
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
        $_SESSION['mail_usuario'] = $row['mail'];
        header('Location: index.php');
    }
}
?>
<script>
    history.replaceState(null, null, location.pathname)
</script>