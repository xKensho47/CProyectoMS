
function setupSearch(inputSelector, itemSelector) {
    // Ocultar los checkboxes al principio
    $(itemSelector).hide();

    $(inputSelector).on('input', function () {
        var valorBusqueda = $(this).val().toLowerCase();

        // Mostrar solo los elementos que coinciden con la búsqueda
        $(itemSelector).each(function () {
            var textoItem = $(this).find('.form-check-label').text().toLowerCase();
            if (textoItem.includes(valorBusqueda)) {
                $(this).show(); // Mostrar elemento
            } else {
                $(this).hide(); // Ocultar elemento
            }
        });

        // Si el valor de búsqueda está vacío, ocultar todos los elementos no seleccionados
        if (valorBusqueda === '') {
            $(itemSelector).each(function () {
                if (!$(this).find('.form-check-input').is(':checked')) {
                    $(this).hide();
                }
            });
        }
    });

    // Mantener visibles los ítems seleccionados
    $(itemSelector).find('.form-check-input').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).closest(itemSelector).show();
        } else {
            var valorBusqueda = $(inputSelector).val().toLowerCase();
            if (valorBusqueda === '') {
                $(this).closest(itemSelector).hide();
            }
        }
    });
}

$(document).ready(function () {
    // Inicializar la búsqueda para géneros
    setupSearch('#busquedaGenero', '.generoItem');

    // Inicializar la búsqueda para actores
    setupSearch('#busquedaActor', '.actorItem');

    // Inicializar la búsqueda para directores
    setupSearch('#busquedaDirector', '.directorItem');
});
