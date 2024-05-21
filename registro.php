<?php
if (!empty($_POST["registro"])) {
	if (empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["mail"]) or empty($_POST["usuario"]) or empty($_POST["password"])) {
		echo 'esta vacio';
	} else {

		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$mail = $_POST["mail"];
		$usuario = $_POST["usuario"];
		$password = md5($_POST["password"]);
		$validar = "SELECT * FROM usuarios WHERE mail ='$mail' || nombre_usuario='$usuario'";
		$validando = $conexion->query($validar);
		if ($validando->num_rows > 0) {
			echo 'el usuario y/o mail ya estan registrados';
		} else {
			$sql = $conexion->query("insert into usuarios(nombre, apellido, nombre_usuario, mail,contraseña,id_tipo) values ('$nombre','$apellido','$usuario','$mail', '$password',2) ");
			if ($sql == 1) {
				echo 'usuario registrado correctamente';
			} else {
				echo 'usuario no registrado';
			}
		}
	}
}


?>
<script>
	history.replaceState(null, null, location.pathname)
</script>