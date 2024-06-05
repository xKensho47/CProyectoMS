<?php
class CProfile
{
    private $conexion;
    private $id_cuenta;

    // GETTERS Y SETTERS
    public function setConexion(object $conexion)
    {
        $this->conexion = $conexion;
    }
    public function setIDUsuario($id_cuenta)
    {
        $this->id_cuenta = $id_cuenta;
    }
    public function getConexion()
    {
        return $this->conexion;
    }
    public function getIDusuario()
    {
        return $this->id_cuenta;
    }

    // CONSTRUCTOR
    function __construct(object $conexion)
    {
        $this->conexion = $conexion;
        if (isset($_SESSION['id_cuenta'])) {
            $this->id_cuenta = $_SESSION['id_cuenta'];
        }
    }

    // METODOS
    public function generateProfileData($conexion)
    {
        $id_cuenta = $_SESSION['id_cuenta'];

        // Consulta para obtener los datos del usuario, incluyendo el campo about_me y la ruta completa de la imagen
        $q = "SELECT cu.nombre_usuario, cu.about_me, ip.img FROM cuenta_usuario cu JOIN img_perfil ip ON cu.id_img = ip.id_img WHERE cu.id_cuenta = ?";
        $stmt = $conexion->prepare($q);
        $stmt->bind_param('i', $id_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener los datos del usuario
            $row = $result->fetch_assoc();

            // Generar el HTML con los datos del usuario, incluyendo la imagen de perfil y el campo about_me
            echo "
            <section class='userinfo-data'>
                <h1 class='title-profile'> PERFIL DE USUARIO </h1>
                <article class='data-user'>                    
                    <aside class='user-container'>
                        <div class='user-avatar'>
                            <img class='profile-img' src='" . $row['img'] . "' alt='User Avatar'/>
                        </div>
                        <div class='user-info'>
                            <h2 class='info-name'> @" . $row['nombre_usuario'] . "</h2>
                        </div>
                    </aside>
                    <aside class='user-button'>
                        <div class='col-auto mt-5 animate-from-bottom'>
                            <a href='#' class='btn btn-color fs-5' data-bs-toggle='modal' data-bs-target='#editaModal' data-bs-id='" . $id_cuenta . "'>
                                <i class='fa-solid fa-circle-plus'></i> Editar Perfil
                            </a>
                        </div>
                        <div class='col-auto mt-5 animate-from-bottom'>
                            <a href='logout.php'>
                                <button class='button-logout'>Logout</button>
                            </a>
                        </div>
                    </aside>
                </article>
            </section>
            <section>
            </section>
            <section class='userinfo-description'>
                <form id='modificaAboutMe' class='modifAboutMe' method='POST' action='editarSobreMi.php'>
                    <label class='description-tittle'>
                        Sobre Mí
                        <label style='font-size: 1rem;'> ------->Modificar: <input type='checkbox' id='modifAboutMeCheckbox' name='modifAboutMeCheckbox'/></label>
                        <input type='submit' name='submit-modificacion' value='Registrar Modificación'>
                        <textarea readonly class='description-aboutme' name='aboutMeRead' id='aboutMeRead' cols='30' rows='10' required> " . $row['about_me'] . "</textarea>
                        <textarea class='description-aboutme d-none' name='about_me' id='aboutMeMod' cols='30' rows='10' placeholder='Escriba aquí...'></textarea>
                        <input type='hidden' name='id_cuenta' value='" . $id_cuenta . "'>
                    </label>
                </form>
            </section>
            ";
        } else {
            echo "No se encontraron datos del usuario.";
        }

        $stmt->close();
    }


    public function friendsList($conexion)
    {
        $id_cuenta = $_SESSION['id_cuenta'];

        $q =
            "SELECT 
            facc.id_cuenta, facc.nombre_usuario, facc.id_img
        FROM 
            cuenta_usuario AS usuario
        RIGHT JOIN 
            lista_amigos AS flist ON usuario.id_cuenta = flist.id_cuenta
        INNER JOIN 
            cuenta_usuario AS facc ON flist.amigo = facc.id_cuenta
        WHERE 
            usuario.id_cuenta = ?
        ORDER BY 
            facc.nombre_usuario ASC
        ";

        $stmt = $conexion->prepare($q);
        if (!$stmt) {
            echo "Error de preparación de consulta: " . $conexion->error;
            exit();
        }

        $stmt->bind_param('i', $id_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="data-friend" id="friend-' . $row["id_cuenta"] . '">
                    <div class="friend-container">
                        <div class="friend-avatar">
                            <img class="profile-img" src="' . $row["id_img"] . '" alt="Friend Avatar"/>
                        </div>
                        <div class="friend-info">
                            <p class="friend-username">' . $row["nombre_usuario"] . '</p>
                        </div>
                    </div>
                    <div class="friend-button">
                        <a href="friendProfile.php?id=' . $row["id_cuenta"] . '"><button class="view-profile">Ver perfil</button></a>
                        <button class="button-delete-friend" data-id="' . $row["id_cuenta"] . '">Eliminar amigo</button>
                    </div>
                </div>
                ';
            }
        } else {
            echo "No hay amigos para mostrar.";
        }

        $stmt->close();
    }

    public function discoverFriends($conexion)
    {
        $id_cuenta = $_SESSION['id_cuenta'];

        // Obtener los géneros favoritos del usuario actual
        $q_usuario =
            "SELECT 
            id_genero 
        FROM 
            genero_favorito 
        WHERE 
            id_cuenta = ?
        ";

        $stmt_usuario = $conexion->prepare($q_usuario);
        $stmt_usuario->bind_param('i', $id_cuenta);
        $stmt_usuario->execute();
        $result_usuario = $stmt_usuario->get_result();
        $generos_usuario = [];

        while ($row_usuario = $result_usuario->fetch_assoc()) {
            $generos_usuario[] = $row_usuario['id_genero'];
        }
        $stmt_usuario->close();

        // Consulta para encontrar amigos potenciales basados en géneros favoritos compartidos
        $q =
            "SELECT 
            c.id_cuenta, c.nombre_usuario, c.id_img
        FROM 
            cuenta_usuario c
        INNER JOIN 
            genero_favorito gf ON c.id_cuenta = gf.id_cuenta
        WHERE 
            gf.id_genero IN (" . implode(',', $generos_usuario) . ")
            AND c.id_cuenta != ?
            AND c.id_cuenta NOT IN (
                SELECT amigo FROM lista_amigos WHERE id_cuenta = ?
            )
        GROUP BY 
            c.id_cuenta, c.nombre_usuario, c.id_img
        ORDER BY 
            c.nombre_usuario ASC
        ";

        $stmt = $conexion->prepare($q);
        if (!$stmt) {
            echo "Error de preparación de consulta: " . $conexion->error;
            exit();
        }

        $stmt->bind_param('ii', $id_cuenta, $id_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="data-discover" id="discover-' . $row["id_cuenta"] . '">
                    <div class="discover-container">
                        <div class="discover-avatar">
                            <img class="profile-img" src="' . $row["id_img"] . '" alt="Discover Avatar"/>
                        </div>
                        <div class="discover-info">
                            <p class="discover-username">' . $row["nombre_usuario"] . '</p>
                        </div>
                    </div>
                    <div class="discover-button">
                        <a href="friendProfile.php?id=' . $row["id_cuenta"] . '"><button class="view-profile">Ver perfil</button></a>
                        <form action="agregarAmigo.php" method="post">
                            <input type="hidden" name="discover_id" value="' . $row["id_cuenta"] . '">
                            <button type="submit" class="button-add-discover">Agregar amigo</button>
                        </form>

                    </div>
                </div>
                ';
            }
        } else {
            echo "No hay amigos para mostrar.";
        }

        $stmt->close();
    }
}
