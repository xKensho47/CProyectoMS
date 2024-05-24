<?php
function generateMovieSection($title){
    echo "
    <section class='movies-container x-carousel' id='movies-container-$title'>
      <article class='x-carousel-tittle' id='x-carousel-tittle-$title'>
        <div class='movies-dinamic-tittle' id='movies-dinamic-tittle-$title'>
          <h2 class='x-tittle' id='x-tittle-$title'> - $title - </h2>
          <hr>
        </div>
        <div class='x-carousel-container'>
          <button class='carousel-prev'>&#60</button>
          <div class='carousel-slide'>
            <div class='x-carousel-movie'>
              <a href='#'>
                <img src='#' alt='Movie Posters'>
                <div class='x-carousel-rank'>
                  <p>°</p>
                </div>
              </a>
            </div>
          </div>
          <button class='carousel-next'>&#62</button>
        </div>
      </article>
    </section>
    ";
}
