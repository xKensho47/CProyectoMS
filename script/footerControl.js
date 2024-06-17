document.addEventListener("mousemove", function(event) {
    var footerElement = document.querySelector("footer");
    
    // Distancia entre el mouse y el borde inferior de la ventana
    var distanceFromBottom = window.innerHeight - event.clientY;
    
    // Altura en px desde la parte inferior para mostrar el footer
    var triggerDistance = 20; // Ejemplo: 20px desde abajo
    
    // Mostrar u ocultar el footer basado en la posición del mouse cerca del borde inferior
    if (distanceFromBottom < triggerDistance) {
        footerElement.style.display = "block"; /* Muestra el footer con la transición */
        footerElement.style.bottom = "0"; /* Aparece con transición */
    } else {
        footerElement.style.display = "none"; /* Oculta el footer con la transición */
    }
});