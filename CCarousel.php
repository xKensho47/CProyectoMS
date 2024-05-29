<?php
class CCarousel{
    private object $conexion;
    private string $titulo;
    private int $id_usuario;

    //GETTERS Y SETTERS
    //Getters
    public function setTitulo(string $titulo):void{
        $this->titulo = $titulo;
    }
    public function setIdUsuario(int $id_usuario):void{
        $this->id_usuario = $id_usuario;
    }
    //Setters
    public function getTitulo():string{
        return $this->titulo;
    }
    public function getId_Usuario():int{
        return $this->id_usuario;
    }
    //CONSTRUCTOR
    function __construct(object $conexion = null, int $usuario = null){
        if (func_num_args() == 1) {
            $this->conexion = $conexion;

        } elseif (func_num_args() == 2) {
            $this->conexion = $conexion;
            $this->id_usuario = $usuario;
        }    
    }

    //METODOS
    public static function resultCarousel($conexion, $title){
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
                break;
        }

        return $result = mysqli_query($conexion, $q);
    }

    public function generateMovieSection($conexion, $title) : void{
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