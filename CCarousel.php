<?php
class CCarousel{
    private $conexion;
    private string $titulo;
    private $id_usuario;

    //GETTERS Y SETTERS
    //Getters
    public function setConexion(object $conexion){
        $this->conexion = $conexion;
    }
    public function setTitulo(string $titulo):void{
        $this->titulo = $titulo;
    }
    public function setIDUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    //Setters
    public function getConexion(){
        return $this->conexion;
    }
    public function getTitulo():string{
        return $this->titulo;
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
    public function resultCarousel($conexion, $title){
        $q = "";
        if($this->obtenerTipoUsuario($this->id_usuario) == "Normal"){
            switch($title){
                case 'Continuar viendo':
                    $q =
                    "

                    ";
                
                    break;
    
                case 'Ver más tarde':
                    $q =
                    "

                    ";
                
                    break;
    
                case 'Favoritas':
                    $q =
                    "
                        
                    ";
                
                    break;
                
                default:
                    echo 'Datos no encontrados';
                    return false;
            }
        }
        else{
            switch($title){
                case 'Películas más valoradas':
                    $q =
                    "SELECT 
                        val.id_peli AS id,
                        val.calificacion AS calificacion,
                        peli.path_poster AS poster,
                        peli.titulo AS titulo
                    FROM 
                        peliculas peli
                    INNER JOIN
                        valoracion_peliculas val 
                    ON 
                        val.id_peli = peli.id_peli
                    GROUP BY 
                        titulo
                    ORDER BY 
                        val.calificacion DESC
                    LIMIT 10;
                    ";
    
                
                    break;
    
                case 'Recientes':
                    $q =
                    "SELECT 
                        peli.id_peli AS id,
                        peli.path_poster AS poster,
                        peli.titulo AS titulo,
                        peli.fecha_subida AS recientes
                    FROM 
                        peliculas peli
                    ORDER BY 
                        peli.fecha_subida DESC
                    LIMIT 10;
                    ";
                
                    break;
                
                default:
                    echo 'Datos no encontrados';
                    return false;
            }
        }

        $result = mysqli_query($conexion, $q);

        if (!$result) {
            echo "Error en la consulta: " . mysqli_error($conexion);
            return false;
        }
    
        return $result;
    }

    public function generateMovieSection($conexion, $title){
        echo "
        <section class='movies-container x-carousel' id='movies-container-$title'>
          <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
            <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
              <h2 class='x-tittle' id='x-tittle-$title'> - $title - </h2>
              <hr>
            </div>
            <div class='x-carousel-container'>
              <button class='carousel-prev'>&#60</button>
              <div class='carousel-slide'>";
                /* Query result */
                $result = $this->resultCarousel($conexion, $title);
                /* Ordenar por puesto */
                $puesto = 1;
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $imagePath = $row["poster"];
                      echo "
                      <div class='x-carousel-movie'>
                        <a href='info.php?id_peli=" . $row['id'] . "'>
                          <img src=' " . $imagePath . " ' alt='Movie Posters'>
                          <div class='x-carousel-rank'>
                            <p># " .$puesto. " </p>
                          </div>
                        </a>
                      </div>
                      ";
                      $puesto++;
                  }
                } else {
                  echo '<p>No movies found.</p>';
                }
                echo"
              </div>
              <button class='carousel-next'>&#62</button>
            </div>
          </article>
        </section>
        ";
    }
        
}
?>