document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.x-carousel-container');

    carousels.forEach(carousel => {
        const prevButton = carousel.querySelector('.carousel-prev');
        const nextButton = carousel.querySelector('.carousel-next');
        const slide = carousel.querySelector('.carousel-slide');

        prevButton.addEventListener('click', () => {
            slide.scrollBy({ left: -300, behavior: 'smooth' });
        });

        nextButton.addEventListener('click', () => {
            slide.scrollBy({ left: 300, behavior: 'smooth' });
        });
    });
});
