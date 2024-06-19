document.addEventListener("DOMContentLoaded", function () {
    // Obtén la URL de la página actual
    var currentUrl = window.location.pathname;

    // Verifica si la URL corresponde a las páginas específicas
    if (currentUrl.includes("crud_peliculas.php") || currentUrl.includes("admin_usuarios.php")) {
        // Selecciona el elemento header dentro de .container
        var headerElement = document.querySelector('.container header');

        // Asegúrate de que el elemento exista
        if (headerElement) {
            // Agrega la clase que elimina el z-index
            headerElement.classList.add('no-z-index');
        }
    }
});