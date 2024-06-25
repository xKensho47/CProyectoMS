
const phrases = [
    "Hoy es un día genial para maratonear...",
    "Disfruta tu tiempo viendo tus películas favoritas...",
    "¡Es un buen momento para descubrir nuevas películas!",
    "Aprovecha y relájate en cineflow...",
    "Explora nuestras recomendaciones y disfruta...",
    "Haz que cada momento cuente con una buena película...",
    "Encuentra tu próxima película favorita hoy mismo...",
    "¡Cineflow te espera para una nueva aventura!"
];

function generatePhrase() {
    const randomIndex = Math.floor(Math.random() * phrases.length);
    const phrase = phrases[randomIndex];
    document.getElementById('dynamicPhrase').innerHTML = `<i>${phrase}</i>`;
}


window.onload = generatePhrase;

