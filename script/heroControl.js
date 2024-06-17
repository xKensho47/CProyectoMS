document.addEventListener("DOMContentLoaded", function() {
    const hero = document.getElementById("hero");
    const mainContent = document.getElementById("mainContent");

    // Limpiar el estado almacenado al cargar la página
    localStorage.removeItem('heroHidden');

    function handleScroll() {
        if (window.scrollY > 50 && !localStorage.getItem('heroHidden')) {
            hero.classList.add("hidden");
            mainContent.classList.add("show");
            mainContent.style.marginTop = '0';
            document.body.style.overflow = 'hidden';

            // Guardar el estado en localStorage
            localStorage.setItem('heroHidden', 'true');
        }
    }

    window.addEventListener("scroll", handleScroll);
});
