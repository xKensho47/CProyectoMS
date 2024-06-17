document.addEventListener('DOMContentLoaded', function() {
    const urlAnterior = document.referrer;

    // Guardar la URL anterior solo si no proviene de una redirección de formulario
    if (!urlAnterior.includes('?id_peli')) {
        sessionStorage.setItem('previousUrl', document.referrer);
    }

    document.getElementById('back-link').addEventListener('click', function(event) {
        event.preventDefault();
        const previousUrl = sessionStorage.getItem('previousUrl');
        if (previousUrl) {
            window.location.href = previousUrl;
        } else {
            window.history.back();
        }
    });
});