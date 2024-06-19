function IdPeliculaEditarEnModal(id_peli, titulo, descripcion, estreno, duracion, nombre_genero, nombre_actor, nombre_director) {
    // Busca dentro del formulario los checkbox para limpiarlos
    document.querySelectorAll('#formulario_peliculas input[type="checkbox"]').forEach(function (checkElement) {
        checkElement.checked = false;
    });

    // Conversión de string a array
    let arrayGeneros = nombre_genero.split(", "); // Se divide con la , manera de separar género por género
    let arrayActores = nombre_actor.split(", ");
    let arrayDirectores = nombre_director.split(", "); // Se ajusta para múltiples directores

    // Busca los input del form
    let inputIdEncontrado = document.getElementById("id_peli");
    let inputTituloEncontrado = document.getElementById("nombre_pelicula");
    let inputDescripcionEncontrada = document.getElementById("descripcion_pelicula");
    let inputEstrenoEncontrado = document.getElementById("estreno_pelicula");
    let inputDuracionEncontrado = document.getElementById("duracion_pelicula");

    // Marca los checkbox de géneros
    arrayGeneros.forEach(function (genero) {
        let inputGeneroEncontrado = document.getElementById("genero_" + genero);
        if (inputGeneroEncontrado) {
            inputGeneroEncontrado.checked = true;
        }
    });

    // Marca los checkbox de actores
    arrayActores.forEach(function (actor) {
        let inputActoresEncontrado = document.getElementById("actor_" + actor);
        if (inputActoresEncontrado) {
            inputActoresEncontrado.checked = true;
        }
    });

    // Marca los checkbox de directores
    arrayDirectores.forEach(function (director) {
        let inputDirectoresEncontrado = document.getElementById("director_" + director);
        if (inputDirectoresEncontrado) {
            inputDirectoresEncontrado.checked = true;
        }
    });

    // Asignación de valores a los inputs del modal
    inputIdEncontrado.value = id_peli;
    inputTituloEncontrado.value = titulo;
    inputDescripcionEncontrada.value = descripcion;
    inputEstrenoEncontrado.value = estreno;
    inputDuracionEncontrado.value = duracion;
}

function IdPeliculaEliminarEnModal(id_peli) {
    let inputIdPeliEncontrado = document.getElementById("id_pelicula_eliminar");
    inputIdPeliEncontrado.value = id_peli;
}
