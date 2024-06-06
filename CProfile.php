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

    // MÉTODOS
    public function generateProfileData()
    {
        // Asegurarse de que la sesión esté iniciada y el id_cuenta esté establecido
        if (!isset($_SESSION['id_cuenta'])) {
            echo "No se ha iniciado sesión.";
            return;
        }

        $id_cuenta = $_SESSION['id_cuenta'];

        // Verificar si el id_cuenta es válido
        if (empty($id_cuenta) || !is_numeric($id_cuenta)) {
            echo "ID de cuenta no válido.";
            return;
        }

        // Consulta para obtener los datos del usuario, incluyendo el campo about_me y la imagen de perfil
        $q =
            "SELECT 
        cu.nombre_usuario, cu.about_me, ip.img 
    FROM 
        cuenta_usuario cu 
    LEFT JOIN 
        img_perfil ip 
    ON 
        cu.id_img = ip.id_img 
    WHERE 
        cu.id_cuenta = ?
    ";

        $stmt = $this->conexion->prepare($q);
        if (!$stmt) {
            echo "Error de preparación de consulta: " . $this->conexion->error;
            return;
        }

        $stmt->bind_param('i', $id_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            echo "Error en la ejecución de la consulta: " . $stmt->error;
            return;
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row) {
                // Consulta para obtener los géneros favoritos del usuario
                $q_genres =
                    "SELECT g.nombre_genero 
            FROM genero_favorito gf 
            JOIN genero g ON gf.id_genero = g.id_genero 
            WHERE gf.id_cuenta = ?
            ";

                $stmt_genres = $this->conexion->prepare($q_genres);
                if (!$stmt_genres) {
                    echo "Error de preparación de consulta para géneros: " . $this->conexion->error;
                    return;
                }

                $stmt_genres->bind_param('i', $id_cuenta);
                $stmt_genres->execute();
                $result_genres = $stmt_genres->get_result();

                $genres_html = '';
                if ($result_genres->num_rows > 0) {
                    while ($genre_row = $result_genres->fetch_assoc()) {
                        $genres_html .= "<div class='genres-favorites'>" . htmlspecialchars($genre_row['nombre_genero'], ENT_QUOTES, 'UTF-8') . "</div>";
                    }
                } else {
                    $genres_html = "<div class='genres-favorites'>No hay géneros favoritos</div>";
                }

                $stmt_genres->close();

                // Generar el HTML con los datos del usuario, incluyendo la imagen de perfil, el campo about_me y los géneros favoritos
                echo "
            <section class='userinfo-data'>
                <h1 class='title-profile'> PERFIL DE USUARIO </h1>
                <article class='data-user'>                    
                    <aside class='user-container'>
                        <div class='user-avatar'>
                            <img class='profile-img' src='" . htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8') . "' alt='User Avatar'/>
                        </div>
                        <div class='user-info'>
                            <h2 class='info-name'> @" . htmlspecialchars($row['nombre_usuario'], ENT_QUOTES, 'UTF-8') . "</h2>
                        </div>
                    </aside>
                    <aside class='user-button'>
                        <div class='col-auto mt-5 animate-from-bottom'>
                            <a href='#' class='btn btn-color fs-5' data-bs-toggle='modal' data-bs-target='#editaModal' data-bs-id='" . htmlspecialchars($id_cuenta, ENT_QUOTES, 'UTF-8') . "'>
                                Editar Perfil
                            </a>
                        </div>
                        <div class='col-auto mt-5 animate-from-bottom'>
                            <a href='logout.php'>
                                <button class='btn btn-color fs-5 button-logout'>Logout</button>
                            </a>
                        </div>
                    </aside>
                </article>
            </section>
            <section class='userinfo-genres'>
                <article class='user-genres'>
                    <h2>Géneros Favoritos</h2>
                    $genres_html
                </article>
            </section>
            <section class='userinfo-description'>
                <form id='modificaAboutMe' class='modifAboutMe' method='POST' action='editarSobreMi.php'>
                    <label class='description-tittle'>
                        Sobre Mí
                        <label style='font-size: 1rem;'> ------->Modificar: <input type='checkbox' id='modifAboutMeCheckbox' name='modifAboutMeCheckbox'/></label>
                        <input type='submit' name='submit-modificacion' value='Registrar Modificación'>
                        <textarea readonly class='description-aboutme' name='aboutMeRead' id='aboutMeRead' cols='30' rows='10' required>" . htmlspecialchars($row['about_me'], ENT_QUOTES, 'UTF-8') . "</textarea>
                        <textarea class='description-aboutme d-none' name='about_me' id='aboutMeMod' cols='30' rows='10' placeholder='Escriba aquí...'></textarea>
                        <input type='hidden' name='id_cuenta' value='" . htmlspecialchars($id_cuenta, ENT_QUOTES, 'UTF-8') . "'>
                    </label>
                </form>
            </section>
            ";
            } else {
                echo "Error al obtener los datos del usuario.";
            }
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
