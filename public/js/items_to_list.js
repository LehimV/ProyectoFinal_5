$(document).ready(function () {
    $(".item-button").click(function () {
        var itemId = $(this).data("item-id");
        var categoryId = $(this).data("category-id");

        // Verificar si el contenido ya está presente en el div correspondiente
        if (!$("#category_" + categoryId).find("#item_" + itemId).length) {
            $.ajax({
                url: "/items/" + itemId, // Ruta item ID
                type: "GET",
                success: function (response) {
                    // Crear el elemento del item con contador y botones
                    var itemName = response.name;
                    var itemHtml = `
              <div id="item_${itemId}" class="item-container m-2">
                <div class="item-name grid">${itemName}</div>
                <div class="counter flex-none rounded-xl bg-white w-4/12 ps-4">
                  <button class="btn-minus text-2xl font-bold text-[#F9A109]" data-item-id="${itemId}" data-category-id="${categoryId}">-</button>
                  <span class="item-quantity text-lg font-bold">1</span>
                  <button class="btn-plus text-2xl font-bold text-[#F9A109]" data-item-id="${itemId}" data-category-id="${categoryId}">+</button>
                  <button class="btn-delete" data-item-id="${itemId}" data-category-id="${categoryId}"><span class="material-symbols-outlined">
                    delete
                  </span></button>
                </div>
                
              </div>
            `;
                    $("#category_" + categoryId).append(itemHtml);
                },
                error: function () {
                    // Error al obtener los detalles del item
                    console.log("Error al obtener los detalles del item");
                },
            });
        }
    });

    // Evento de click para el botón de sumar
    $(document).on("click", ".btn-plus", function () {
        var itemId = $(this).data("item-id");
        var categoryId = $(this).data("category-id");
        var itemQuantity = parseInt(
            $("#item_" + itemId)
                .find(".item-quantity")
                .text()
        );
        itemQuantity++;
        $("#item_" + itemId)
            .find(".item-quantity")
            .text(itemQuantity);
    });

    // Evento de click para el botón de restar
    $(document).on("click", ".btn-minus", function () {
        var itemId = $(this).data("item-id");
        var categoryId = $(this).data("category-id");
        var itemQuantity = parseInt(
            $("#item_" + itemId)
                .find(".item-quantity")
                .text()
        );
        if (itemQuantity > 1) {
            itemQuantity--;
            $("#item_" + itemId)
                .find(".item-quantity")
                .text(itemQuantity);
        }
    });

    // Evento de click para el botón de eliminar
    $(document).on("click", ".btn-delete", function () {
        var itemId = $(this).data("item-id");
        var categoryId = $(this).data("category-id");
        $("#item_" + itemId).remove();
    });
});

/*
  <script>
    $(document).ready(function() {
      $('.item-button').click(function() {
        var itemId = $(this).data('item-id');
        var categoryId = $(this).data('category-id');

        // Condicion para no repetir
        if (!$('#category_' + categoryId).find('#item_' + itemId).length) {
          $.ajax({
            url: '/items/' + itemId, // Ruta ID
            type: 'GET',
            success: function(response) {
              // PAsa la info al RightPanel
              var itemName = response.name;
              var itemHtml = '<div id="item_' + itemId + '">' + itemName + '</div>';
              $('#category_' + categoryId).append(itemHtml);
            },
            error: function() {

              console.log('Error al obtener los detalles del item');
            }
          });
        }
      });
    });
  </script>
*/
