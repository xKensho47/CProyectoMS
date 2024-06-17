<?php
class CProfileFriend
{
    private $conexion;
    private $id_cuenta;
    private $id_profile;

    // GETTERS Y SETTERS
    public function setConexion(object $conexion)
    {
        $this->conexion = $conexion;
    }

    public function setIDUsuario($id_cuenta)
    {
        $this->id_cuenta = $id_cuenta;
    }
    public function setIdProfile($id_profile){
        $this->id_profile = $id_profile;
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function getIDusuario()
    {
        return $this->id_cuenta;
    }

    public function getIdProfile(){
        return $this->id_profile;
    }
    
    

    // CONSTRUCTOR
    function __construct(object $conexion, $id_profile)
    {
        $this->conexion = $conexion;
        if (isset($_SESSION['id_cuenta'])) {
            $this->id_cuenta = $_SESSION['id_cuenta'];
            $this->id_profile = $id_profile;
        }
    }

    // MÉTODOS
    public function generateProfileData(){
        // Asegurarse de que la sesión esté iniciada y el id_cuenta esté establecido
        if (!isset($_SESSION['id_cuenta'])) {
            echo "No se ha iniciado sesión.";
            return;
        }

        $conexion = $this->getConexion();
        $id_profile = $this->getIdProfile();
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
            cu.id_cuenta = $id_profile
        ";

        $result = mysqli_query($conexion,$q);

        $query = "SELECT us.id_tipo FROM Usuarios us JOIN cuenta_usuario cu ON cu.id_cuenta = $id_cuenta WHERE cu.id_usuario = us.id_usuario";
        $tipo = mysqli_query($conexion,$query);
        $arrayassoc = mysqli_fetch_assoc($tipo);
        $id_tipo = $arrayassoc['id_tipo'];

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row) {
                // Consulta para obtener los géneros favoritos del usuario
                $q_genres =
                    "SELECT g.nombre_genero 
            FROM genero_favorito gf 
            JOIN genero g ON gf.id_genero = g.id_genero 
            WHERE gf.id_cuenta = $id_profile
            ";

                
                $result_genres = mysqli_query($conexion,$q_genres);
                $genres_html = '';
                if ($result_genres->num_rows > 0) {
                    while ($genre_row = $result_genres->fetch_assoc()) {
                        $genres_html .= "<div class='genres-favorites'>" . htmlspecialchars($genre_row['nombre_genero'], ENT_QUOTES, 'UTF-8') . "</div>";
                    }
                } else {
                    $genres_html = "<div class='genres-favorites-empty'>No hay géneros favoritos</div>";
                }

                
                $query = "SELECT COUNT(*) as count FROM lista_amigos WHERE id_cuenta = '$id_cuenta' AND amigo = '$id_profile'";
                $result = mysqli_query($conexion, $query);
                $isFriend = mysqli_fetch_assoc($result)['count'] > 0;



                //$defaultImg es una imagen negra de 1x1 píxel codificada en base64.
                $defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';

                // Generar el HTML con los datos del usuario, incluyendo la imagen de perfil, el campo about_me y los géneros favoritos
                echo "
                <section class='userinfo-data'>
                    <div class='my-profile'>
                        <a href='profile.php' class='btn btn-color fs-5'>Ir a mi perfil</a>
                    </div>
                    <h1 class='title-profile animate-from-bottom'> PERFIL DE USUARIO </h1>
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
                        <aside class='user-button' data-is-friend='" . ($isFriend ? "true" : "false") . "' data-amigo-id='$id_profile'>
                            <div class='add-friend' style='display: none;'>
                                <form action='agregarAmigo.php' method='post'>
                                    <input type='hidden' name='discover_id' value='$id_profile'>
                                    <button type='submit' class='btn btn-color fs-5'>Agregar amigo</button>
                                </form>
                            </div>
                            <div class='remove-friend' style='display: none;'>
                                <form action='eliminarAmigo.php' method='post'>
                                    <input type='hidden' name='friend_id' value='$id_profile'>
                                    <button type='submit' class='btn btn-color fs-5'>Eliminar Amigo</button>
                                </form>
                            </div>                          
                        </aside>
                    </article>
                </section>
                <section class='userinfo-genres' onlyread>
                    <article class='user-genres'>
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
                            <textarea readonly class='description-aboutme' name='aboutMeRead' id='aboutMeRead' cols='30' rows='10' required>" . htmlspecialchars($row['about_me'], ENT_QUOTES, 'UTF-8') . "</textarea>
                            <textarea class='description-aboutme d-none' name='about_me' id='aboutMeMod' cols='30' rows='10'></textarea>
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

        mysqli_close($conexion);
    }

    public function friendsList($conexion)
    {
        $id_profile = $this->getIdProfile();
        $id_cuenta = $_SESSION['id_cuenta'];

        $q =
        "SELECT
            facc.id_cuenta, facc.nombre_usuario, img.img as id_img
        FROM
            cuenta_usuario AS usuario
        RIGHT JOIN
            lista_amigos AS flist ON usuario.id_cuenta = flist.id_cuenta
        INNER JOIN
            cuenta_usuario AS facc ON flist.amigo = facc.id_cuenta
        LEFT JOIN
            img_perfil AS img ON facc.id_img = img.id_img
        WHERE
            usuario.id_cuenta = $id_profile
        ORDER BY
            facc.nombre_usuario ASC
        ";

        $result = mysqli_query($conexion,$q);

        //$defaultImg es una imagen negra de 1x1 píxel codificada en base64.
        $defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="data-friend animate-from-bottom" id="friend-' . $row["id_cuenta"] . '">
                    <div class="friend-container">
                        <div class="friend-avatar">
                            <img class="profile-img" src="' . (!empty($row["id_img"]) ? htmlspecialchars($row["id_img"], ENT_QUOTES, 'UTF-8') : $defaultImg) . '" alt="Friend Avatar"/>
                        </div>
                        <div class="friend-info">
                            <p class="friend-username">' . $row["nombre_usuario"] . '</p>
                        </div>
                    </div>
                    <div class="friend-button" data-id-cuenta="' . $id_cuenta . '" data-id-profile="' . $row['id_cuenta'] . '">
                        <a href="perfilAmigo.php?id_profile=' . $row["id_cuenta"] . '"><button class="btn btn-color fs-5 view-profile">Ver perfil</button></a>
                    </div>
                </div>
                ';
            }
        } else {
            echo "No hay amigos para mostrar.";
        }

        mysqli_close($conexion);
    }

}
