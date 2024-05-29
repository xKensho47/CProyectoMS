<?php
function generateMovieSection($conexion, $title){
  include("carousel_query.php");
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
          $result = resultCarousel($conexion, $title);
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
?>