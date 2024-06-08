$(document).ready(function() {
    $('.button-add-friend').click(function(e) {
        e.preventDefault();
        
        var friendId = $(this).closest('.discover-button').data('friend-id');
        
        $.ajax({
            type: 'POST',
            url: 'agregarAmigo.php',
            data: { discover_id: friendId },
            success: function(response) {
                // Maneja la respuesta del servidor
                console.log(response); // Puedes actualizar esto para mostrar un mensaje al usuario
            },
            error: function() {
                // Maneja los errores de la solicitud AJAX
                console.error("Error en la solicitud AJAX");
            }
        });
    });
});
