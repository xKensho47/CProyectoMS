document.addEventListener('DOMContentLoaded', function() {
    const userButtons = document.querySelectorAll('.user-button');
    
    userButtons.forEach(function(button) {
        const isFriend = button.getAttribute('data-is-friend') === 'true';
        
        if (isFriend) {
            button.querySelector('.remove-friend').style.display = 'block';
        } else {
            button.querySelector('.add-friend').style.display = 'block';
        }
    });
});