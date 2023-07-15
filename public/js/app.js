$(document).ready(function () {
    // Obtener el enlace del menú de "items"
    $('a[href="' + itemsIndexUrl + '"]').addClass("active");

    // Manejar el evento de clic en el enlace de "items"
    itemsLink.click(function (event) {
        event.preventDefault();

        // Hacer una solicitud AJAX a la ruta de "items" y obtener la vista parcial
        $.ajax({
            url: itemsLink.attr("href"),
            method: "GET",
            success: function (response) {
                // Actualizar el contenido del elemento con el id "content"
                $("#content").html(response);
            },
            error: function () {
                console.error('Error al cargar la vista de "items".');
            },
        });
    });
});
