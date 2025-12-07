$(document).ready(function () {
    mostrarDatosX();
});


function mostrarDatosX() {
    var parametros = 'idarea=' + 2;
    const url = baseURL + 'galeria/obtener_detalles';
    $.ajax({
        type: "GET",
        url: url,
        data: parametros,
        success: function (response) {
            console.log('Datos de la galería:', response);
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
        let imgSrc = baseURL + item.url_foto;
        html += `
        <div class="col-12 col-sm-3">
            <div class="card card-row card-warning">
                <div class="card-header">
                    <h3 class="card-title">${item.titulo}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Imagen</label>
                            <img src="${imgSrc}" alt="${item.titulo}" class="img-fluid" data-original="${imgSrc}" style="max-height:200px;object-fit:cover;">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <input type="text" class="form-control form-control-sm" id="txtnombre" value="${item.detalle}" readonly placeholder="Nombre de la imagen">
                        </div>
                    </div>
                    <div class="row mb-2 justify-content-center">
                        <div class="col-12 d-flex justify-content-between">
                            <div>
                                <label for="txtimagen" class="form-label"></label>
                                <input type="file" accept="image/*" class="d-none" data-iddetalle="${item.iddetalle}" id="txtimagen">
                                <button type="button" class="btn btn-default btn-sm" data-iddetalle="${item.iddetalle}" title="Explorador de Archivos" onclick="abrirExplorador(this)">
                                    <i class="fas fa-folder-open"></i> ARCHIVOS
                                </button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-default btn-sm" onclick="abrirModalLocal(this)" title="Imágenes guardadas">
                                    <i class="fas fa-images"></i> GALERIA
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3 justify-content-center">
                        <div class="col-12">
                            <label for="txtdetalle" class="form-label">Título</label>
                            <input type="text" class="form-control" value="${item.titulo}" placeholder="Título de la imagen" id="txtdetalle">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <button class="btn btn-primary" type="button" onclick="guardarImagenGaleria(this)">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        
                            <button class="btn btn-secondary" type="button" onclick="cancelarImagenGaleria(this)">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
    $('#contenedorCards').html(html);

    $('input[type="file"]').off('change').on('change', function () {
        const input = this;
        if (input.files && input.files[0]) {
            const archivo = input.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const cardBody = $(input).closest('.card-body');
                const img = cardBody.find('img[data-original]');
                const inputNombre = cardBody.find('#txtnombre');
                if (!img.attr('data-original-init')) {
                    img.attr('data-original-init', img.attr('data-original'));
                }
                if (!inputNombre.attr('data-original-init')) {
                    inputNombre.attr('data-original-init', inputNombre.val());
                }
                img.attr('src', e.target.result);
                inputNombre.val(archivo.name);
            };
            reader.readAsDataURL(archivo);
        }
    });
}

function abrirExplorador(btn) {
    $(btn).closest('.card-body').find('input[type="file"]').trigger('click');
}

function guardarImagenGaleria(btn) {
    const cardBody = $(btn).closest('.card-body');
    const inputFile = cardBody.find('input[type="file"]')[0];
    const iddetalle = inputFile ? $(inputFile).data('iddetalle') : null;
    const file = inputFile && inputFile.files.length > 0 ? inputFile.files[0] : null;
    const nombre = cardBody.find('#txtnombre').val();
    const titulo = cardBody.find('#txtdetalle').val();
    const imgActual = cardBody.find('img[data-original]').attr('src');

    if (!iddetalle) {
        Swal.fire('Guardar Imagen', 'No se encontró el id del detalle', 'error');
        return;
    }
    var formData = new FormData();
    formData.append('iddetalle', iddetalle);
    formData.append('nombre', nombre);
    formData.append('titulo', titulo);
    if (file) {
        formData.append('imagen', file);
    } else {
        formData.append('imagen_actual', imgActual);
    }
    $.ajax({
        type: "POST",
        url: baseURL + 'galeria/actualizarFotoDetalle',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === 'ok') {
                Swal.fire('Guardar Imagen', 'Datos guardados correctamente', 'success');
                mostrarDatosX();
            } else {
                Swal.fire({
                    title: 'Guardar Imagen',
                    text: response.message || 'Error al guardar',
                    icon: 'warning',
                }).then(() => {
                    cancelarImagenGaleria(btn);
                });
            }
        },
        error: function () {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo conectar con el servidor',
                icon: 'error',
            }).then(() => {
                cancelarImagenGaleria(btn);
            });
        }
    });
}

function cancelarImagenGaleria(btn) {
    const cardBody = $(btn).closest('.card-body');
    const img = cardBody.find('img[data-original]');
    const inputFile = cardBody.find('input[type="file"]');
    const inputNombre = cardBody.find('#txtnombre');
    const originalImg = img.attr('data-original-init');
    if (originalImg) {
        img.attr('src', originalImg);
        img.attr('data-original', originalImg);
    }
    inputFile.val('');
    const originalNombre = inputNombre.attr('data-original-init');
    if (originalNombre) {
        inputNombre.val(originalNombre);
        inputNombre.attr('data-original', originalNombre);
    }
}

function abrirModalLocal(btn) {
    window._cardBodySeleccion = $(btn).closest('.card-body');
    $('#mdlGaleriaLocal').modal('show');
    getImagenesLocales();
}

function getImagenesLocales() {
    var url = baseURL + 'galeria/imagenes_locales';
    table = $('#tblgalerialocal').DataTable({
        "destroy": true,
        "language": Español,
        "lengthChange": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            'url': url,
            'method': 'GET',
            'dataSrc': function (json) {
                console.log(json);
                return json.data;
            }
        },
        "columns": [
            {
                "data": "url",
                "orderable": false,
                "width": "80px",
                "className": "text-center",
                "render": function (data, type, row) {
                    return `<img src="${data}" alt="${row.nombre}" style="max-width:120px;max-height:120px;object-fit:cover;">`;
                }
            },
            { "data": "nombre" },
            {
                "data": null,
                "orderable": false,
                "width": "12%",
                "className": "text-center",
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-danger" onclick="eliminarImagenLocal('${row.nombre}')" title="ELIMINAR"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-sm btn-primary" onclick="SeleccionarImagen({nombre: '${row.nombre}', url: '${row.url}'})" title="SELECCIONAR"><i class="fas fa-check"></i></button>
                    `;
                }
            }
        ],
    });
}

function SeleccionarImagen(data) {
    $('#mdlGaleriaLocal').modal('hide');
    var cardBody = window._cardBodySeleccion;
    delete window._cardBodySeleccion;
    if (!cardBody || !cardBody.length) {
        cardBody = $('.card-body:visible').first();
    }
    if (!cardBody.length) {
        return;
    }
    const img = cardBody.find('img[data-original]');
    const inputNombre = cardBody.find('#txtnombre');
    const inputFile = cardBody.find('input[type="file"]');
    if (!img.attr('data-original-init')) {
        img.attr('data-original-init', img.attr('data-original'));
    }
    if (!inputNombre.attr('data-original-init')) {
        inputNombre.attr('data-original-init', inputNombre.val());
    }
    img.attr('src', data.url);
    img.attr('data-original', data.url);
    // Mostrar en txtnombre el nombre del archivo sin extensión
    var nombreSinExt = data.nombre.replace(/\.[^/.]+$/, "");
    inputNombre.val(nombreSinExt);
    inputNombre.attr('data-original', nombreSinExt);
    inputFile.val('');
}

function abrirModal() {
    $('#mdldetalle').modal('show');
}