document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los elementos con la clase 'friend-button'
    const buttons = document.querySelectorAll('.friend-button');
    
    buttons.forEach(function(button) {
        const idCuenta = button.getAttribute('data-id-cuenta');
        const idProfile = button.getAttribute('data-id-profile');
        
        // Añadir un evento click al botón
        button.querySelector('.view-profile').addEventListener('click', function(event) {
            // Prevenir la acción por defecto
            event.preventDefault();
            
            if (idCuenta === idProfile) {
                // Redirigir a profile.php si los IDs coinciden
                window.location.href = 'profile.php';
            } else {
                // Redirigir a perfilAmigo.php si los IDs no coinciden
                window.location.href = 'perfilAmigo.php?id_profile=' + idProfile;
            }
        });
    });
});