$(document).ready(function() {
    $('.button-add-friend').click(function(e) {
        e.preventDefault();
        var friendId = $(this).closest('.data-friend').data('friend-id');
        $.ajax({
            type: 'POST',
            url: 'agregarAmigo.php', // Aquí debes especificar la URL correcta
            data: { friend_id: friendId },
            success: function(response) {
                // Maneja la respuesta del servidor
            },
            error: function() {
                // Maneja los errores de la solicitud AJAX
            }
        });
    });
});
