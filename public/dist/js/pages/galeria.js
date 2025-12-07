let iddetalleSeleccionado = null;

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
            <div class="col-sm-3">
                <div class="card mb-3" id="card-${item.iddetalle}">
                    <div class="card-body">
                        <input type="hidden" id="iddetalle${item.iddetalle}" name="iddetalle${item.iddetalle}" value="${item.iddetalle}">
                        <div class="form-group mb-2 text-center">
                            <img src="${imgSrc}" alt="${item.detalle}" class="img-fluid mb-2" style="width:100%;height:200px;object-fit:cover;" data-original="${imgSrc}" id="img${item.iddetalle}">
                            <input type="file" class="d-none" id="fileimg${item.iddetalle}" accept="image/*">
                            <div class="row mb-2">
                                <div class="col-6 pr-1">
                                    <button type="button" class="btn btn-primary btn-block" id="btnimg${item.iddetalle}" onclick="document.getElementById('fileimg${item.iddetalle}').click();">
                                        Archivos
                                    </button>
                                </div>
                                <div class="col-6 pl-1">
                                    <button type="button" class="btn btn-secondary btn-block" id="btngaleria${item.iddetalle}" onclick="abrirGaleria(${item.iddetalle})">
                                        Galería
                                    </button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb-2" id="txturl${item.iddetalle}" value="${imgSrc}" readonly>
                            <input type="text" class="form-control mb-2" id="txtdetalle${item.iddetalle}" value="${item.detalle}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="txttitulo${item.iddetalle}">Título</label>
                            <input type="text" class="form-control" id="txttitulo${item.iddetalle}" name="txttitulo${item.iddetalle}" value="${item.titulo}">
                        </div>
                        <button type="button" class="btn btn-success btn-block mt-3" id="btnGuardar${item.iddetalle}" onclick="editarDatos(${item.iddetalle})">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    $('#contenedorCards').html(html);
    datos.forEach(item => {
        $(`#fileimg${item.iddetalle}`).off('change').on('change', function () {
            const input = this;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $(`#img${item.iddetalle}`).attr('src', e.target.result);
                    $(`#txturl${item.iddetalle}`).val(e.target.result);
                    $(`#txtdetalle${item.iddetalle}`).val(input.files[0].name);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
}

function abrirGaleria(iddetalle) {
    iddetalleSeleccionado = iddetalle; // Guardar el iddetalle del card activo
    $('#mdlGaleriaLocal').attr('data-iddetalle', iddetalle); // Asignar id al modal para referencia
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
                        <button class="btn btn-sm btn-danger" id="btnEliminar_${row.nombre}" onclick="eliminarImagenLocal('${row.nombre}')" title="ELIMINAR"><i class="fas fa-trash"></i></button>
                        <button class="btn btn-sm btn-primary" id="btnSeleccionar_${row.nombre}" onclick="seleccionarImagen({nombre: '${row.nombre}', url: '${row.url}'})" title="SELECCIONAR"><i class="fas fa-check"></i></button>
                    `;
                }
            }
        ],
    });
}

function seleccionarImagen(data) {
    // data: {nombre, url}
    if (!iddetalleSeleccionado) return;
    // Cambiar imagen, url y detalle en el card correspondiente
    $(`#img${iddetalleSeleccionado}`).attr('src', data.url);
    $(`#txturl${iddetalleSeleccionado}`).val(data.url);
    $(`#txtdetalle${iddetalleSeleccionado}`).val(data.nombre);
    $('#mdlGaleriaLocal').modal('hide');
}

function abrirModal() {
    $('#mdldetalle').modal('show');
}

function editarDatos(iddetalle) {
    const imagen = $(`#txturl${iddetalle}`).val();
    const nombre = $(`#txtdetalle${iddetalle}`).val();

    if (!imagen || imagen === baseURL) {
        Swal.fire('Imagen requerida', 'Debe seleccionar o cargar una imagen.', 'warning');
        return;
    }
    if (!nombre) {
        Swal.fire('Nombre requerido', 'Debe seleccionar o cargar una imagen válida.', 'warning');
        return;
    }

    // Validar extensión de imagen
    const extensionesValidas = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
    const extension = nombre.split('.').pop().toLowerCase();

    if (!extensionesValidas.includes(extension)) {
        Swal.fire('Extensión no permitida', 'Solo se permiten imágenes: ' + extensionesValidas.join(', '), 'warning');
        return;
    }

    $.ajax({
        type: "POST",
        url: baseURL + "galeria/editar_galeria",
        data: {
            iddetalle: iddetalle,
            imagen: imagen,
            nombre: nombre
        },
        success: function (response) {
            if (response.success) {
                Swal.fire('Actualizar Datos', response.message, 'success');
                mostrarDatosX(); // Recargar los cards
            } else {
                Swal.fire('Actualizar Datos', response.error || 'No se pudo guardar el detalle', 'warning');
            }
        },
        error: function () {
            Swal.fire('Error', 'No se pudo guardar el detalle', 'error');
        }
    });
}

function eliminarImagenLocal(nombre) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará la imagen de la galería.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseURL + "galeria/eliminar_imagen",
                data: { nombre: nombre },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Eliminado', response.message, 'success');
                        getImagenesLocales();
                        mostrarDatosX();
                    } else {
                        Swal.fire('Error', response.error || 'No se pudo eliminar la imagen', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'No se pudo eliminar la imagen', 'error');
                }
            });
        }
    });
}