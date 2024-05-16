<?php
ob_start();
    include("opciones.php");
    if(isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        
        $q = "SELECT * from usuarios where id_usuario = '$id_usuario' and id_tipo =1";
        $resultado=mysqli_num_rows(mysqli_query($conexion,$q));
        if($resultado!=0){echo $opciones_admin; $_SESSION['id_tipo'] = 1;}
        else{
            echo $opciones;
            $_SESSION['id_tipo'] = 2;
        } 
    }
    else {
        echo $opciones_sin_sesion;
        $_SESSION['id_tipo'] = 2;
    }
?>