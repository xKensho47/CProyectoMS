<?php
ob_start();
    include("opciones.php");
    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        
        $q = "SELECT * from usuario where id_usuario = '$id_usuario' and administrador =1";
        $resultado=mysqli_num_rows(mysqli_query($conexion,$q));
        if($resultado!=0){echo $opciones_admin; $_SESSION['administrador'] = 1;}
        else{
            echo $opciones;
            $_SESSION['administrador'] = 0;
        } 
    }
    else {
        echo $opciones_sin_sesion;
        $_SESSION['administrador'] = 0;
    }
?>