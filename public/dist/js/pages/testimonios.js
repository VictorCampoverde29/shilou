let iddetalleSeleccionado = null;

$(document).ready(function () {
    mostrarDatos();
});

function mostrarDatos() {
    const url = baseURL + 'testimonios/obtener_areas';
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
            Swal.fire('Error', 'No se pudieron cargar los datos del testimonio', 'error');
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
    const url = baseURL + 'testimonios/obtener_detalles';
    $.ajax({
        type: "GET",
        url: url,
        data: parametros,
        success: function (response) {
            renderizarCards(response);
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos del testimonio', 'error');
        }
    });
}

function renderizarCards(datos) {
    let html = '';
    datos.forEach(item => {
        const headerClass = item.estado === 'ACTIVO' ? 'bg-success' : 'bg-danger';
        html += `
            <div class="col-sm-12">
                <div class="card mb-3" id="card-${item.iddetalle}">
                    <div class="card-header ${headerClass} text-white">
                        <h5 class="card-title mb-0">${item.servicio}</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="iddetalle${item.iddetalle}" name="iddetalle${item.iddetalle}" value="${item.iddetalle}">
                        <div class="row">
                          <div class="col-sm-8">
                            <div class="form-group">
                                <label for="txtusuario${item.iddetalle}">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="txtusuario${item.iddetalle}" name="txtusuario${item.iddetalle}" autocomplete="off" value="${item.usuario}" data-usuario="${item.usuario}">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cmbestado${item.iddetalle}">Estado</label>
                                <select class="form-control" id="cmbestado${item.iddetalle}" name="cmbestado${item.iddetalle}" value="${item.estado}">
                                    <option value="ACTIVO" ${item.estado === 'ACTIVO' ? 'selected' : ''}>ACTIVO</option>
                                    <option value="INACTIVO" ${item.estado === 'INACTIVO' ? 'selected' : ''}>INACTIVO</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="txttestimonio${item.iddetalle}">Testimonio</label>
                            <textarea class="form-control" id="txttestimonio${item.iddetalle}" name="txttestimonio${item.iddetalle}" autocomplete="off" data-testimonio="${item.testimonio}">${item.comentario}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <div class="row justify-content-end">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-flat mr-1" id="btnGuardar${item.iddetalle}" title="GUARDAR" onclick="editarDatos(${item.iddetalle})">
                                    <i class="fas fa-save"></i> GUARDAR
                                </button>
                                </div>
                                <div class="form-group">
                                <button type="button" class="btn btn-danger btn-flat" id="btnEliminar${item.iddetalle}" title="ELIMINAR" onclick="eliminarDetalle(${item.iddetalle})">
                                    <i class="fas fa-trash"></i> ELIMINAR
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
}

function eliminarDetalle(iddetalle) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará el testimonio.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseURL + "testimonios/eliminar_detalle",
                data: { iddetalle: iddetalle },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Eliminado', response.message, 'success');
                        mostrarDetalles();
                    } else {
                        Swal.fire('Error', response.error || 'No se pudo eliminar el testimonio', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'No se pudo eliminar el testimonio', 'error');
                }
            });
        }
    });
}

function abrirModal() {
    $('#mdldetalle').modal('show');
    limpiarModal();
}

function editarDatos(iddetalle) {
    const usuario = $(`#txtusuario${iddetalle}`).val();
    const estado = $(`#cmbestado${iddetalle}`).val();
    const testimonio = $(`#txttestimonio${iddetalle}`).val();

    if (!usuario) {
        Swal.fire('Usuario requerido', 'El nombre de usuario es obligatorio.', 'warning');
        return;
    }
    if (!testimonio) {
        Swal.fire('Testimonio requerido', 'El testimonio es obligatorio.', 'warning');
        return;
    }
    $.ajax({
        type: "POST",
        url: baseURL + "testimonios/editar_detalle",
        data: {
            iddetalle: iddetalle,
            usuario: usuario,
            estado: estado,
            comentario: testimonio
        },
        success: function (response) {
            if (response.success) {
                Swal.fire('Actualizar Datos', response.message, 'success');
                mostrarDetalles();
            } else {
                Swal.fire('Actualizar Datos', response.error || 'No se pudo guardar el testimonio', 'warning');
            }
        },
        error: function () {
            Swal.fire('Error', 'No se pudo guardar el testimonio', 'error');
        }
    });
}

function registrarDetalle() {
    if ($('#txtcliente').val() === '') {
        Swal.fire('Agregar Testimonio', 'El nombre de usuario es obligatorio', 'warning');
        $('#txtcliente').focus();
        return;
    }
    if ($('#txtcomentario').val() === '') {
        Swal.fire('Agregar Testimonio', 'El testimonio es obligatorio', 'warning');
        $('#txtcomentario').focus();
        return;
    }
    var parametros = {
        idarea: $('#txtid').val(),
        usuario: $('#txtcliente').val(),
        comentario: $('#txtcomentario').val(),
        servicio: $('#cmbservicio').val(),
        estado: $('#cmbestado').val()
    };
    $.ajax({
        type: "POST",
        url: baseURL + 'testimonios/insertar_detalle',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Agregar Testimonio',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Agregar Testimonio',
                    text: response.message,
                }).then(function () {
                    mostrarDetalles();
                    $('#mdldetalle').modal('hide');
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al registrar el testimonio', 'error');
        }
    });
}

function limpiarModal() {
    $('#iddetalle').val('');
    $('#txtcliente').val('');
    $('#txtcomentario').val('');
    $('#cmbservicio').val($('#cmbservicio option:first').val());
    $('#cmbestado').val('INACTIVO');
}

function editar() {
    if ($('#txttitulos').val() === '') {
        Swal.fire('Guardar Testimonio', 'El título es obligatorio', 'warning');
        $('#txttitulos').focus();
        return;
    }
    if ($('#txttituloresaltado').val() === '') {
        Swal.fire('Guardar Testimonio', 'El título subrayado es obligatorio', 'warning');
        $('#txttituloresaltado').focus();
        return;
    }
    if ($('#txtdetalles').val() === '') {
        Swal.fire('Guardar Testimonio', 'El detalle es obligatorio', 'warning');
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
        url: baseURL + 'testimonios/editar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Guardar Testimonio',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardar Testimonio',
                    text: response.message,
                }).then(function () {
                    mostrarDatos();
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el testimonio', 'error');
        }
    });
}