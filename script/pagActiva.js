document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.menu__item a');

    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
});
