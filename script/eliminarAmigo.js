<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

$(document).ready(function() {
    $('.button-delete-friend').click(function() {
        var amigoId = $(this).data('id');
        var friendElement = $('#friend-' + amigoId);

        $.ajax({
            url: 'eliminarAmigo.php',
            type: 'POST',
            data: { amigo_id: amigoId },
            success: function(response) {
                if (response === 'success') {
                    friendElement.remove();
                } else {
                    alert('Error al eliminar amigo. Inténtalo de nuevo.');
                }
            }
        });
    });
});