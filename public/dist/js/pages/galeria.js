let iddetalleSeleccionado = null;

$(document).ready(function () {
    mostrarDatos();
});

function mostrarDatos() {
    const url = baseURL + 'galeria/obtener_areas';
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $('#txtid').val(response[0].idarea);
            $('#txttitulos').val(response[0].titulo);
            $('#txttituloresaltado').val(response[0].titulo_resaltado);
            $('#txtdetalles').val(response[0].detalle);
             mostrarDetalles();
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos de la galería', 'error');
        }
    });
}

function limpiar() {
    $('#txttitulos').val('');
    $('#txttituloresaltado').val('');
    $('#txtdetalles').val('');
}

function mostrarDetalles() {
    var parametros = 'idarea=' + $('#txtid').val();
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
        let imgSrc = baseURL + item.url_foto;
        html += `
            <div class="col-sm-3">
                <div class="card mb-3" id="card-${item.iddetalle}">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">${item.titulo}</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="iddetalle${item.iddetalle}" name="iddetalle${item.iddetalle}" value="${item.iddetalle}">
                        <div class="form-group">
                            <label for="fileimg${item.iddetalle}">Imagen</label>
                            <img src="${imgSrc}" alt="${item.detalle}" class="img-fluid object-contain" style="width:96%;height:238px;object-fit:contain;" data-original="${imgSrc}" id="img${item.iddetalle}">
                            <input type="file" class="d-none" id="fileimg${item.iddetalle}" accept="image/*">
                            <div class="col-sm-12">
                                <div class="row justify-content-between mb-2">
                                    <button type="button" class="btn btn-default btn-sm" id="btnimg${item.iddetalle}" onclick="document.getElementById('fileimg${item.iddetalle}').click();">
                                        <i class="fas fa-folder-open"></i> ARCHIVOS
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm" id="btngaleria${item.iddetalle}" onclick="abrirGaleria(${item.iddetalle})">
                                        <i class="fas fa-images"></i> GALERÍA
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" class="form-control mb-2" id="txturl${item.iddetalle}" value="${imgSrc}" readonly>
                            <input type="hidden" class="form-control mb-2" id="txtdetalle${item.iddetalle}" value="${item.detalle}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="txttitulo${item.iddetalle}">Título</label>
                            <input type="text" class="form-control" id="txttitulo${item.iddetalle}" name="txttitulo${item.iddetalle}" autocomplete="off" value="${item.titulo}" data-titulo="${item.titulo}">
                        </div>
                        <div class="col-sm-12">
                            <div class="row justify-content-between mt-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-flat mr-1" id="btnGuardar${item.iddetalle}" title="GUARDAR" onclick="editarDatos(${item.iddetalle})">
                                    <i class="fas fa-save"></i> GUARDAR
                                </button>
                                </div>
                                <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-flat" id="btnCancelar${item.iddetalle}" title="CANCELAR" onclick="cancelarEdicion(${item.iddetalle})">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-flat" id="btnEliminar${item.iddetalle}" title="ELIMINAR" onclick="eliminarDetalle(${item.iddetalle})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </div>
                            </div>
                        </div>
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

    $('#fileimg').off('change').on('change', function () {
    const input = this;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#img').attr('src', e.target.result).removeClass('d-none');
            $('#txturl').val(e.target.result);
            $('#txtdetalle').val(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    }
});
}

function cancelarEdicion(iddetalle) {
    const img = $(`#img${iddetalle}`);
    const originalSrc = img.attr('data-original');
    img.attr('src', originalSrc);
    $(`#txturl${iddetalle}`).val(originalSrc);
    const originalDetalle = img.attr('alt');
    $(`#txtdetalle${iddetalle}`).val(originalDetalle);
    const originalTitulo = $(`#txttitulo${iddetalle}`).attr('data-titulo');
    if (originalTitulo !== undefined) {
        $(`#txttitulo${iddetalle}`).val(originalTitulo);
    }
    Swal.fire('Cancelado', 'Los cambios han sido revertidos.', 'info');
}

function abrirGaleria(iddetalle = null) {
    if (iddetalle) {
        iddetalleSeleccionado = iddetalle;
        $('#mdlGaleriaLocal').attr('data-iddetalle', iddetalle);
    } else {
        iddetalleSeleccionado = null;
        $('#mdlGaleriaLocal').attr('data-iddetalle', 'nuevo');
    }
    $('#mdlGaleriaLocal').modal('show');
    getImagenesLocales();
}

function eliminarDetalle(iddetalle) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el detalle de la galería.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseURL + "galeria/eliminar_detalle",
                data: { iddetalle: iddetalle },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Eliminado', response.message, 'success');
                        mostrarDetalles();
                    } else {
                        Swal.fire('Error', response.error || 'No se pudo eliminar el detalle', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'No se pudo eliminar el detalle', 'error');
                }
            });
        }
    });
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
    const iddetalle = $('#mdlGaleriaLocal').attr('data-iddetalle');
    if (iddetalle === 'nuevo') {
        $('#img').attr('src', data.url).removeClass('d-none');
        $('#txturl').val(data.url);
        $('#txtdetalle').val(data.nombre);
        $('#mdlGaleriaLocal').modal('hide');
    } else if (iddetalleSeleccionado) {
        $(`#img${iddetalleSeleccionado}`).attr('src', data.url);
        $(`#txturl${iddetalleSeleccionado}`).val(data.url);
        $(`#txtdetalle${iddetalleSeleccionado}`).val(data.nombre);
        $('#mdlGaleriaLocal').modal('hide');
    }
}

function abrirModal() {
    $('#mdldetalle').modal('show');
    limpiarModal();
}

function editarDatos(iddetalle) {
    const imagen = $(`#txturl${iddetalle}`).val();
    const nombre = $(`#txtdetalle${iddetalle}`).val();
    const titulo = $(`#txttitulo${iddetalle}`).val();

    if (!imagen || imagen === baseURL) {
        Swal.fire('Imagen requerida', 'Debe seleccionar o cargar una imagen.', 'warning');
        return;
    }
    if (!nombre || nombre.trim() === '') {
        Swal.fire('Nombre requerido', 'Debe seleccionar o cargar una imagen válida.', 'warning');
        return;
    }
    if (!titulo || titulo.trim() === '') {
        Swal.fire('Título requerido', 'El título es obligatorio.', 'warning');
        return;
    }

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
            nombre: nombre,
            titulo: titulo
        },
        success: function (response) {
            if (response.success) {
                Swal.fire('Actualizar Datos', response.message, 'success');
                mostrarDetalles();
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
                        mostrarDetalles();
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

function registrarDetalle() {
    if ($('#txturl').val() === '') {
        Swal.fire('Agregar Galería', 'La imagen es obligatoria', 'warning');
        $('#txturl').focus();
        return;
    }
    if ($('#txtdetalle').val().trim() === '') {
        Swal.fire('Agregar Galería', 'El nombre de la imagen es obligatoria', 'warning');
        $('#txtdetalle').focus();
        return;
    }
    if ($('#txttitulo').val().trim() === '') {
        Swal.fire('Agregar Galería', 'El Título es obligatorio', 'warning');
        $('#txttitulo').focus();
        return;
    }
    const extensionesValidas = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
    const nombre = $('#txtdetalle').val();
    const extension = nombre.split('.').pop().toLowerCase();
    if (!extensionesValidas.includes(extension)) {
        Swal.fire('Extensión no permitida', 'Solo se permiten imágenes: ' + extensionesValidas.join(', '), 'warning');
        return;
    }
    if ($('#txttitulo').val() === '') {
        Swal.fire('Agregar Galería', 'El título es obligatorio', 'warning');
        $('#txttitulo').focus();
        return;
    }
    var parametros = {
        idarea: $('#txtid').val(),
        titulo: $('#txttitulo').val(),
        detalle: $('#txtdetalle').val(),
        url_foto: $('#txturl').val(),
        estado: 'ACTIVO'
    };
    $.ajax({
        type: "POST",
        url: baseURL + 'galeria/insertar_detalle',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Agregar Galería',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Agregar Galería',
                    text: response.message,
                }).then(function () {
                    mostrarDetalles();
                    $('#mdldetalle').modal('hide');
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al registrar la galería', 'error');
        }
    });
}

function limpiarModal() {
    $('#iddetalle').val('');
    $('#img').removeAttr('src').addClass('d-none');
    $('#txturl').val('');
    $('#txtdetalle').val('');
    $('#txttitulo').val('');
}

function editar() {
    if ($('#txttitulos').val().trim() === '') {
        Swal.fire('Guardar Galería', 'El título es obligatorio', 'warning');
        $('#txttitulos').focus();
        return;
    }
    if ($('#txttituloresaltado').val().trim() === '') {
        Swal.fire('Guardar Galería', 'El título subrayado es obligatorio', 'warning');
        $('#txttituloresaltado').focus();
        return;
    }
    if ($('#txtdetalles').val().trim() === '') {
        Swal.fire('Guardar Galería', 'El detalle es obligatorio', 'warning');
        $('#txtdetalles').focus();
        return;
    }
    var parametros = {
        cod: $('#txtid').val(),
        titulo: $('#txttitulos').val(),
        titulo_resaltado: $('#txttituloresaltado').val(),
        detalle: $('#txtdetalles').val()
    };
    $.ajax({
        type: "POST",
        url: baseURL + 'galeria/editar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Guardar Galería',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardar Galería',
                    text: response.message,
                }).then(function () {
                    mostrarDatos();
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar la galería', 'error');
        }
    });
}