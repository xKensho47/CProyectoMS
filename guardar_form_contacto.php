<?php 

include("conexion.php");

	if (isset($_POST['id_cuenta'])) {
 		
 		$id_cuenta = $conexion->real_escape_string($_POST['id_cuenta']);
 		$asunto = $conexion->real_escape_string($_POST['asunto']);
		$mensaje = $conexion->real_escape_string($_POST['mensaje']);
		$mensaje_asunto = $asunto .' : '. $mensaje;
        
		$sql = "INSERT INTO contacto (id_cuenta,mensaje)
				VALUES ('$id_cuenta', '$mensaje_asunto')";

		$conexion->query($sql);

		header('Location:index.php');
	}
?>