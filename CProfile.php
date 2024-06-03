<?php
class CProfile{
    private $conexion;
    private $id_usuario;

    //GETTERS Y SETTERS
    //Getters
    public function setConexion(object $conexion){
        $this->conexion = $conexion;
    }
    public function setIDUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    //Setters
    public function getConexion(){
        return $this->conexion;
    }
    public function getIDusuario(){
        return $this->id_usuario;
    }
    //CONSTRUCTOR
    function __construct(object $conexion){
        $this->conexion = $conexion;
        if (isset($_SESSION['id_usuario'])) {
            $this->id_usuario = $_SESSION['id_usuario'];
        }
    }

    //METODOS
    // Método para obtener el tipo de usuario
    private function obtenerTipoUsuario($id_usuario){
        $tipo_usuario = "";
        // Preparar la consulta SQL para obtener el tipo de usuario
        $query = 
        "SELECT 
            t.tipo_usuario 
        FROM 
            usuarios u 
        INNER JOIN 
            tipo_usuario t 
        ON 
            u.id_tipo = t.id_tipo 
        WHERE 
            u.id_usuario = ?";

        // Preparar y ejecutar la declaración
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $stmt->store_result();

        // Vincular el resultado de la consulta
        $stmt->bind_result($tipo_usuario);

        // Obtener el tipo de usuario
        if ($stmt->num_rows > 0) {
            $stmt->fetch();
        }

        // Cerrar la declaración y devolver el tipo de usuario
        $stmt->close();
        return $tipo_usuario;
    }

    public function generateProfileData(){
        echo "
        <aside class='profile-userinfo'>
                    <section class='userinfo-data'>
                        <article class='data-user'>
                            <aside class='user-container'>
                                <div class='user-avatar'>
                                    <img class='profile-img' src='/placeholder.svg' alt='User Avatar'/>
                                </div>
                                <div class='user-info'>
                                    <h1 class='info-name'>John Doe</h1>
                                    <p class='info-username'>@johndoe</p>
                                </div>
                            </aside>
                            <aside class='user-button'>
                                <a href='logout.php'><button class='button-logout'>Logout</button></a>
                            </aside>
                        </article>
                    </section>
                    <section class='userinfo-genres'>
                        <h2 class='genres-tittle'>Géneros favoritos</h2>
                        <div class='user-genres'>
                            <span class='genres-favorites'>Drama</span>
                            <span class='genres-favorites'>Acción</span>
                            <span class='genres-favorites'>Sci-Fi</span>
                        </div>
                    </section>
                    <section class='userinfo-description'>
                        <h2 class='description-tittle'>Sobre mí</h2>
                        <p class='description-aboutme'>
                            Soy un apasionado del cine al que le encanta explorar nuevas películas y 
                            compartir mis pensamientos con los demás. En mi tiempo libre, puedes encontrarme 
                            seleccionando mi colección de favoritos, descubriendo gemas ocultas y discutiendo 
                            los últimos lanzamientos con mis amigos.
                        </p>
                    </section>
                </aside>
        ";
    }
        
}
?>