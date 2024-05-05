<?php
ob_start();
    $opciones='
        <header>
            <a class="link-logo" href="./index.php">
                <img class="logo1" src="./images/logo1.png" alt="logo">
            </a>
            <form class="barra-busqueda" action="resultados-buscar.php" method="get" autocomplete="off">
                <input class="input-busqueda" type="search" name="buscar" placeholder="Buscar..." />  
            </form>
            <nav class="menu">
                <ul class="menu__lista">
                    <li class="menu__item"><a href="index.php">Inicio</a></li>
                    <li class="menu__item"><a href="peliculas.php">Peliculas</a></li>
                    <li class="menu__item"><a href="notificaciones.php">Notificaciones</a></li>
                    <li class="menu__item"><a href="profile.php">Perfil</a></li>
                    
                </ul>
            </nav>
        </header>
    ';

    $opciones_admin='
        <header>
            <a class="link-logo" href="./index.php">
                <img class="logo1" src="./images/logo1.png" alt="logo">
            </a>
            <form class="barra-busqueda" action="resultados-buscar.php" method="get" autocomplete="off">
                <input class="input-busqueda" type="search" name="buscar" placeholder="Buscar..." />  
            </form>
            <nav class="menu">
                <ul class="menu__lista">
                    <li class="menu__item"><a href="index.php">Inicio</a></li>
                    <li class="menu__item"><a href="peliculas.php">Peliculas</a></li>
                    <li class="menu__item"><a href="abm.php">CRUD</a></li>
                    <li class="menu__item"><a href="profile.php">Perfil</a></li>
                </ul>
            </nav>
        </header>
    ';

    $opciones_sin_sesion='
        <header>
            <a class="link-logo" href="./index.php">
                <img class="logo1" src="./images/logo1.png" alt="logo">
            </a>
            <form class="barra-busqueda" action="resultados-buscar.php" method="get" autocomplete="off">
                <input class="input-busqueda" type="search" name="buscar" placeholder="Buscar..." />  
            </form>
            <nav class="menu">
                <ul class="menu__lista">
                    <li class="menu__item"><a href="peliculas.php">Peliculas</a></li>
                    <li class="menu__item"><a href="form_login.php">Iniciar Sesión</a></li>
                    <li class="menu__item"><a href="form_registro.php">Registrarse</a></li>
                </ul>
            </nav>
        </header>
    ';
    
/*
    $opciones_sin_links='        
        <header>
            <a class="link-logo" href="index.php>
                <img class="logo1" src="./images/logo1.png" alt="logo">
            </a>
        </header>
        ';

        if(isset($_GET['boton-buscar'])){
            header('Location: resultado_busqueda.php?buscar='.$_GET['buscar'].'');
        }
    ';
*/
?>

