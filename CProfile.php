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
    public function generateProfileData($conexion)
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

        //verificar que tipo de usuario es 

        $query = "SELECT us.id_tipo FROM Usuarios us JOIN cuenta_usuario cu ON cu.id_cuenta = $id_cuenta WHERE cu.id_usuario = us.id_usuario";
        $tipo = mysqli_query($conexion,$query);
        $arrayassoc = mysqli_fetch_assoc($tipo);
        $id_tipo = $arrayassoc['id_tipo'];

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row) {
                // Consulta para obtener los géneros favoritos del usuario
                $q_genres =
                    "SELECT 
                    g.nombre_genero 
                FROM 
                    genero_favorito gf 
                JOIN 
                    genero g 
                ON 
                    gf.id_genero = g.id_genero 
                WHERE 
                    gf.id_cuenta = ?
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
                    $genres_html = "<div class='genres-favorites-empty'>No hay géneros favoritos</div>";
                }

                $stmt_genres->close();

                //$defaultImg es una imagen negra de 1x1 píxel codificada en base64.
                $defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';

                // Generar el HTML con los datos del usuario, incluyendo la imagen de perfil, el campo about_me y los géneros favoritos
                echo "
                    <section class='userinfo-data'>
                        <h1 class='title-profile animate-from-bottom'> MI PERFIL </h1>
                        <article class='data-user'>                    
                            <aside class='user-container'>
                                <div class='user-avatar'>
                                    <img class='profile-img' src='" . (!empty($row['img']) ? htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8') : $defaultImg) . "' alt='User Avatar'/>
                                </div>
                                <div class='user-info animate-from-bottom'>
                                    <h2 class='info-name'> 
                                        " . ($id_tipo == 1 ? "<span style='font-size:25px;'>&#128081;</span>" : "") . " 
                                        @" . htmlspecialchars($row['nombre_usuario'], ENT_QUOTES, 'UTF-8') . " 
                                    </h2>
                                </div>
                            </aside>
                            <aside class='user-button'>
                                <div class=''>
                                    <a href='#' class='btn btn-color fs-5' data-bs-toggle='modal' data-bs-target='#editaModal' data-bs-id='" . htmlspecialchars($id_cuenta, ENT_QUOTES, 'UTF-8') . "'>
                                        Editar Perfil
                                    </a>
                                </div>
                                <div class=''>
                                    <a href='logout.php'>
                                        <button class='btn btn-color fs-5 button-logout'>Logout</button>
                                    </a>
                                </div>
                            </aside>
                        </article>
                    </section>
                    <section class='userinfo-genres'>
                        <article class='user-genres'>
                ";

                                // Aquí verificamos si existe un parámetro 'status' en la URL
                                if (isset($_GET['status'])) {
                                    // Verificar si el parámetro 'status' tiene el valor 'success'
                                    if ($_GET['status'] === 'success') {
                                        echo '<div class="alert alert-success alert-dismissible fade show fs-5" role="alert"> Cambios Guardados.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                    } elseif ($_GET['status'] === 'danger') {
                                        echo '<div class="alert alert-danger alert-dismissible fade show fs-5" role="alert">Ya existe otro usuario con ese nombre.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                    }
                                }

                                echo "
                            <h2 class='h2-animate'>Géneros Favoritos</h2>
                            <div class='genres-prof'>
                                $genres_html
                            </div>
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
            facc.id_cuenta, facc.nombre_usuario, img.img as id_img, us.id_tipo
        FROM
            cuenta_usuario AS usuario
        RIGHT JOIN
            lista_amigos AS flist ON usuario.id_cuenta = flist.id_cuenta
        INNER JOIN
            cuenta_usuario AS facc ON flist.amigo = facc.id_cuenta
        LEFT JOIN
            img_perfil AS img ON facc.id_img = img.id_img
        LEFT JOIN
            Usuarios AS us
        ON
            us.id_usuario = facc.id_usuario
        JOIN
            Tipo_usuario tu
        ON  
            tu.id_tipo = us.id_tipo
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

        //$defaultImg es una imagen negra de 1x1 píxel codificada en base64.
        $defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="data-friend" id="friend-' . $row["id_cuenta"] . '">
                    <div class="friend-container">
                        <div class="friend-avatar">
                            <img class="profile-img" src="' . (!empty($row["id_img"]) ? htmlspecialchars($row["id_img"], ENT_QUOTES, 'UTF-8') : $defaultImg) . '" alt="Friend Avatar"/>
                        </div>
                        <div class="friend-info">
                            <p class="friend-username">' . ($row["id_tipo"] == 1 ? "<span style='font-size:15px;'>&#128081;</span>" : "")  . $row["nombre_usuario"] . '</p>
                        </div>
                    </div>
                    <div class="friend-button">
                        <a href="perfilAmigo.php?id_profile=' . $row["id_cuenta"] . '"><button class="btn btn-color fs-5 view-profile">Ver perfil</button></a>
                        <form action="eliminarAmigo.php" method="post">
                            <input type="hidden" name="friend_id" value="' . $row["id_cuenta"] . '">
                            <button type="submit" class="btn btn-color fs-5">Eliminar Amigo</button>
                        </form>
                    </div>
                </div>
                ';
            }
        } else {
            echo 'No hay amigos para mostrar.';
        }

        $stmt->close();
    }

    public function discoverFriends($page, $itemsPerPage)
    {
        $id_cuenta = $_SESSION['id_cuenta'];
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 9;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $offset = ($page - 1) * $itemsPerPage;


        $q = 
        "SELECT 
            u.id_cuenta, u.nombre_usuario, img.img AS id_img, us.id_tipo
        FROM 
            cuenta_usuario u
        LEFT JOIN 
            lista_amigos la 
        ON 
            (u.id_cuenta = la.amigo 
        AND 
            la.id_cuenta = ?)
        LEFT JOIN 
            img_perfil img 
        ON 
            u.id_img = img.id_img
        LEFT JOIN
            Usuarios us
        ON
            us.id_usuario = u.id_usuario
        JOIN
            Tipo_usuario tu
        ON  
            tu.id_tipo = us.id_tipo
        WHERE 
            u.id_cuenta != ? 
        AND 
            la.amigo 
        IS NULL AND 
            u.nombre_usuario 
        LIKE ? 
        LIMIT ?, ?        
        ";
        $stmt = $this->conexion->prepare($q);
        $searchTerm = '%' . $search . '%';
        $stmt->bind_param('iisii', $id_cuenta, $id_cuenta, $searchTerm, $offset, $itemsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();

        $friends = [];
        while ($row = $result->fetch_assoc()) {
            $friends[] = $row;
        }

        $qTotal = "SELECT COUNT(*) as total FROM cuenta_usuario WHERE id_cuenta != ? AND nombre_usuario LIKE ?";
        $stmtTotal = $this->conexion->prepare($qTotal);
        $stmtTotal->bind_param('is', $id_cuenta, $searchTerm);
        $stmtTotal->execute();
        $resultTotal = $stmtTotal->get_result();
        $totalFriends = $resultTotal->fetch_assoc()['total'];

        $response = [
            'success' => true,
            'friends' => $friends,
            'hasMore' => ($page * $itemsPerPage) < $totalFriends
        ];

        echo json_encode($response);
    }
}
