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

        // Consulta para obtener los datos del usuario, incluyendo el campo about_me
        $q = "SELECT nombre_usuario, id_img, about_me FROM cuenta_usuario WHERE id_cuenta = ?";
        $stmt = $conexion->prepare($q);
        $stmt->bind_param('i', $id_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener los datos del usuario
            $row = $result->fetch_assoc();

            // Generar el HTML con los datos del usuario, incluyendo el campo about_me
            echo "
                <section class='userinfo-data'>
                    <article class='data-user'>
                        <aside class='user-container'>
                            <div class='user-avatar'>
                                <img class='profile-img' src='" . $row['id_img'] . "' alt='User Avatar'/>
                            </div>
                            <div class='user-info'>
                                <h1 class='info-name'>" . $row['nombre_usuario'] . "</h1>
                            </div>
                        </aside>
                        <aside class='user-button'>
                            <a href='logout.php'><button class='button-logout'>Logout</button></a>
                            <div class='col-auto mt-5 animate-from-bottom'>
                                <a href='#' class='btn btn-color fs-5' data-bs-toggle='modal' data-bs-target='#editaModal' data-bs-id=' "; echo $row['id_cuenta']; echo" '><i class='fa-solid fa-circle-plus'></i> Editar Perfil</a>
                            </div>

                        </aside>
                    </article>
                </section>
                <section class='userinfo-description'>
                    <h2 class='description-tittle'>Sobre mí</h2>
                    <p class='description-aboutme'>
                        " . $row['about_me'] . "
                    </p>
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
