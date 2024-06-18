document.querySelector(".footer-toggle").addEventListener("mouseenter", function() {
    var footerElement = document.querySelector("footer");
    footerElement.style.transform = "translateY(0)"; /* Muestra el footer */
});

document.querySelector("footer").addEventListener("mouseleave", function() {
    var footerElement = document.querySelector("footer");
    footerElement.style.transform = "translateY(calc(100% - 3vh))"; /* Oculta el footer cuando el mouse deja el footer */
});
