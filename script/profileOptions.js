document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.userinfo2-menu-list input');
    const contents = document.querySelectorAll('.option');

    const updateContentVisibility = () => {
        contents.forEach(content => content.classList.remove('active'));
        items.forEach((item, index) => {
            if (item.checked) {
                contents[index].classList.add('active');
            }
        });
    };

    // Agregar eventos change a los radio buttons
    items.forEach(item => {
        item.addEventListener('change', updateContentVisibility);
    });

    // Mostrar el contenido correspondiente al radio button marcado por defecto
    updateContentVisibility();
});
