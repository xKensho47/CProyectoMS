<?php
class CCarousel
{
    private $conexion;
    private string $titulo;
    private $id_cuenta;

    //GETTERS Y SETTERS
    //Getters
    public function setConexion(object $conexion)
    {
        $this->conexion = $conexion;
    }
    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }
    public function setIDCuenta($id_cuenta)
    {
        $this->id_cuenta = $id_cuenta;
    }
    //Setters
    public function getConexion()
    {
        return $this->conexion;
    }
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function getIDCuenta()
    {
        return $this->id_cuenta;
    }
    //CONSTRUCTOR
    public function __construct($conexion) {
        $this->conexion = $conexion;

        // Asignar id_cuenta desde la sesión si está configurada
        if (isset($_SESSION['id_cuenta'])) {
            $this->id_cuenta = (int)$_SESSION['id_cuenta'];
        } else {
            // Manejar el caso donde no hay id_cuenta en la sesión
            $this->id_cuenta = null;
        }
    }

    //METODOS
    // Método para obtener el tipo de usuario
    private function obtenerTipoUsuario($id_cuenta)
    {
        $tipo_usuario = "";

        // Preparar la consulta SQL para obtener el tipo de usuario
        $query = 
        "SELECT 
            t.tipo_usuario 
        FROM 
            cuenta_usuario cu 
        INNER JOIN 
            usuarios u ON cu.id_usuario = u.id_usuario
        INNER JOIN 
            tipo_usuario t ON u.id_tipo = t.id_tipo 
        WHERE 
            cu.id_cuenta = ?
        ";

        // Preparar y ejecutar la declaración
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id_cuenta);
        $stmt->execute();
        $stmt->store_result();

        // Vincular el resultado de la consulta
        $stmt->bind_result($tipo_usuario);

        // Obtener el tipo de usuario
        if ($stmt->num_rows > 0) {
            $stmt->fetch();
        } else {
            echo "No se encontró el tipo de usuario para id_cuenta: $id_cuenta<br>";
        }

        // Cerrar la declaración y devolver el tipo de usuario
        $stmt->close();

        return $tipo_usuario;
    }


    public function resultCarousel($conexion, $title)
    {
        $q = "";

        if (
            isset($_SESSION['id_cuenta'])
            && ($this->obtenerTipoUsuario($this->id_cuenta) == "Normal"
                || $this->obtenerTipoUsuario($this->id_cuenta) == "Administrador")
        ) {
            switch ($title) {
                case 'Continuar viendo':
                    $q =
                        "SELECT 
                        p.id_peli AS id, 
                        p.path_poster AS poster, 
                        p.titulo AS titulo
                    FROM 
                        peliculas p
                    JOIN 
                        continuar_viendo cv 
                    ON 
                        p.id_peli = pf.id_peli
                    JOIN 
                        cuenta_usuario cu 
                    ON 
                        cv.id_cuenta = cu.id_cuenta
                    WHERE 
                        cu.id_cuenta = $this->id_cuenta
                    ";

                    break;

                case 'Ver más tarde':
                    $q =
                        "SELECT 
                        p.id_peli AS id, 
                        p.path_poster AS poster, 
                        p.titulo AS titulo
                    FROM 
                        peliculas p
                    JOIN 
                        mas_tarde mt
                    ON 
                        p.id_peli = mt.id_peli
                    JOIN 
                        cuenta_usuario cu 
                    ON 
                        mt.id_cuenta = cu.id_cuenta
                    WHERE 
                        cu.id_cuenta = $this->id_cuenta
                    ";
                    break;

                case 'Favoritas':
                    $q =
                        "SELECT 
                        p.id_peli AS id, 
                        p.path_poster AS poster, 
                        p.titulo AS titulo
                    FROM 
                        peliculas p
                    LEFT JOIN 
                        peli_favorita pf 
                    ON 
                        p.id_peli = pf.id_peli
                    RIGHT JOIN 
                        cuenta_usuario cu 
                    ON 
                        pf.id_cuenta = cu.id_cuenta
                    WHERE 
                        cu.id_cuenta = $this->id_cuenta
                    ";

                    break;

                default:
                    echo 'Datos no encontrados';
                    return false;
            }
        } else {
            switch ($title) {
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

        $stmt = $conexion->prepare($q);
        if (
            isset($_SESSION['id_cuenta'])
            && ($this->obtenerTipoUsuario($this->id_cuenta) == "Normal"
                || $this->obtenerTipoUsuario($this->id_cuenta) == "Administrador")
        ) {
            $stmt->bind_param('i', $this->id_cuenta);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            echo "Error en la consulta: " . $conexion->error;
            return false;
        }

        return $result;
    }

    public function generateMovieSection($conexion, $title)
    {
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

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = $row["poster"];
                echo "
                    <div class='x-carousel-movie'>
                    <a href='detalle_peli.php?id_peli=" . $row['id'] . "'>
                        <img src=' " . $imagePath . " ' alt='Movie Posters'>
                        <div class='x-carousel-rank'>
                        <p># " . $puesto . " </p>
                        </div>
                    </a>
                    </div>
                    ";
                $puesto++;
            }
        } else {
            echo '<p>No movies found.</p>';
        }
        echo "
              </div>
              <button class='carousel-next'>&#62</button>
            </div>
          </article>
        </section>
        ";
    }
}
