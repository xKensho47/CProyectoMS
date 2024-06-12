document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('back-link').addEventListener('click', function(event) {
        event.preventDefault();
        window.history.back();
    });
});