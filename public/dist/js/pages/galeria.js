FilePond.registerPlugin(FilePondPluginImagePreview);
let pond; // Declaración global


$(document).ready(function() {
    mostrarDatosX();
});


// Eliminamos la inicialización de FilePond para inputs estáticos

function guardarImagen() {
    const files = pond.getFiles();
    if (files.length === 0) {
        Swal.fire('¡Ups!', 'Selecciona una imagen primero', 'warning');
        return;
    }
    const formData = new FormData();
    formData.append('imagen', files[0].file);
    formData.append('iddetalle', 9);

    $.ajax({
        type: "POST",
        url: baseURL + 'galeria/actualizarFotoDetalle',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === 'ok') {
                Swal.fire('¡Éxito!', 'Imagen guardada correctamente', 'success');
            } else {
                Swal.fire('Error', 'Error al guardar la imagen', 'error');
            }
        },
        error: function () {
            Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
        }
    });
}


function mostrarDatosX() {
    var parametros = 'idarea=' + 2;
    const url = baseURL + 'galeria/obtener_detalles';
    $.ajax({
        type: "GET",
        url: url,
        data: parametros,
        success: function (response) {
            renderizarCards(response);
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos de la galería', 'error');
        }
    });
}

function renderizarCards(datos) {
    let html = '';
    datos.forEach(item => {
        // Si la url_foto no contiene 'public/', la agregamos
        let imgSrc = item.url_foto;
        if (!imgSrc.startsWith('/public/') && !imgSrc.startsWith('http')) {
            imgSrc = '/public/uploads/' + imgSrc.replace(/^uploads\//, '');
        }
        // Si la app está en subcarpeta, usar baseURL
        if (typeof baseURL !== 'undefined') {
            imgSrc = baseURL.replace(/\/$/, '') + imgSrc;
        }
        html += `
        <div class="col-12 col-sm-4">
            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">${item.titulo}</h3>
                </div>
                <div class="card-body text-center">
                    <input type="text" class="form-control mb-2 url-img-galeria" value="${imgSrc}" readonly style="font-size:12px;">
                    <input type="file" accept="image/*" class="form-control mb-2 input-img-galeria" data-iddetalle="${item.iddetalle}" style="font-size:12px;">
                    <img src="${imgSrc}" alt="${item.titulo}" class="img-fluid mb-2 img-preview-galeria" data-original="${imgSrc}" style="max-height:200px;object-fit:cover;">
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-success btn-sm me-2 btn-guardar-img" type="button">Guardar</button>
                        <button class="btn btn-secondary btn-sm btn-cancelar-img" type="button">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
    $('#contenedorCards').html(html);

    // Evento para previsualizar la imagen seleccionada
    $('.input-img-galeria').off('change').on('change', function() {
        const input = this;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(input).siblings('.img-preview-galeria').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    // Evento para cancelar y regresar la imagen principal
    $('.btn-cancelar-img').off('click').on('click', function() {
        const cardBody = $(this).closest('.card-body');
        const img = cardBody.find('.img-preview-galeria');
        const inputFile = cardBody.find('.input-img-galeria');
        img.attr('src', img.data('original'));
        inputFile.val('');
    });

}