<?php
if (!function_exists('mostrarHeader')) {
    function mostrarHeader($tipo_usuario){
        switch($tipo_usuario){
            case 'admin':
                echo'
                <header class="header-admin">
                    <a class="link-logo" href="./index.php">
                        <img class="logo1" src="./images/logo1.png" alt="logo">
                    </a>
                    <form class="barra-busqueda" id="busqueda" action="buscar.php" method="get" autocomplete="off">
                        <input class="input-busqueda" type="search" id="busca" name="buscar" placeholder="Buscar..." />
                        <input id="genero_seleccionado" name="genero_buscar" type="hidden" value=""/>
                    </form>
                    <nav class="menu">
                        <ul class="menu__lista">
                            <li class="menu__item"><a href="index.php">Inicio</a></li>
                            <li class="menu__item"><a href="generos.php">Generos</a></li>
                            <li class="menu__item"><a href="crud_peliculas.php">CRUD</a></li>
                            <li class="menu__item"><a href="admin_usuarios.php">Usuarios</a></li>
                            <li class="menu__item"><a href="notificaciones.php">Notificaciones</a></li>
                            <li class="menu__item"><a href="profile.php">Perfil</a></li>
                        </ul>
                    </nav>
                </header>
                <script src="script/pagActiva.js"></script>
                ';
            break;

            case 'autenticado':
                echo'
                <header class="header-login">
                    <a class="link-logo" href="./index.php">
                        <img class="logo1" src="./images/logo1.png" alt="logo">
                    </a>
                    <form class="barra-busqueda" id="busqueda" action="buscar.php" method="get" autocomplete="off">
                        <input class="input-busqueda" type="search" id="busca" name="buscar" placeholder="Buscar..." />
                        <input id="genero_seleccionado" name="genero_buscar" type="hidden" value=""/>
                    </form>
                    <nav class="menu">
                        <ul class="menu__lista">
                            <li class="menu__item"><a href="index.php">Inicio</a></li>
                            <li class="menu__item"><a href="generos.php">Generos</a></li>
                            <li class="menu__item"><a href="notificaciones.php">Notificaciones</a></li>
                            <li class="menu__item"><a href="profile.php">Perfil</a></li>
                            
                        </ul>
                    </nav>
                </header>
                <script src="script/pagActiva.js"></script>
                ';

                break;
            
            case 'invitado':
                echo'
                <header class="header-user">
                    <a class="link-logo" href="./index.php">
                        <img class="logo1" src="./images/logo1.png" alt="logo">
                    </a>
                    <nav class="menu">
                        <ul class="menu__lista">
                            <li class="menu__item"><a href="login.php">Iniciar Sesión</a></li>
                            <li class="menu__item"><a href="registro.php">Registrarse</a></li>                        </ul>
                    </nav>
                </header>
                <script src="script/pagActiva.js"></script>
                ';
                break;

        }
    }
}