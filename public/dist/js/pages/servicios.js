$(document).ready(function () {
    mostrarDatos();
});

function mostrarDatos() {
    const url = baseURL + 'servicios/obtener_areas';
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
            Swal.fire('Error', 'No se pudieron cargar los datos del servicio', 'error');
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
    const url = baseURL + 'servicios/obtener_detalles';
    $.ajax({
        type: "GET",
        url: url,
        data: parametros,
        success: function (response) {
            $('#dynamic-tabs').empty();
            $('#dynamic-tab-content').empty();
            response.forEach(function (item, idx) {
                let activeClass = idx === 0 ? 'active' : '';
                $('#dynamic-tabs').append(`
                  <a class="nav-item nav-link ${activeClass}" id="tab-${idx}-tab" data-toggle="tab" href="#tab-${idx}" role="tab" aria-controls="tab-${idx}" aria-selected="${activeClass ? 'true' : 'false'}" data-iddetalle="${item.iddetalle}">
                      ${item.titulo}
                  </a>
              `);
                $('#dynamic-tab-content').append(`
                  <div class="tab-pane fade ${activeClass ? 'show active' : ''}" id="tab-${idx}" role="tabpanel" aria-labelledby="tab-${idx}-tab">
                      <form id="form-detalle-${idx}" data-iddetalle="${item.iddetalle}">
                          <div class="form-row mt-3">
                              <div class="form-group col-md-7">
                                  <label for="titulo-${idx}"><strong>Título:</strong></label>
                                  <input type="text" class="form-control" id="titulo-${idx}" autocomplete="off" placeholder="Título del Servicio" value="${item.titulo}">
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="icono-${idx}"><strong>Icono:</strong></label>
                                  <div class="d-flex align-items-center">
                                      <input type="text" class="form-control mr-2" id="icono-${idx}" autocomplete="off" placeholder="Cambiar Icono" value="">
                                      <div id="icono-preview-${idx}" style="width: 32px; height: 32px; display: flex; align-items: center;"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="detalle-${idx}"><strong>Detalle:</strong></label>
                              <textarea class="form-control mb-3" id="detalle-${idx}" autocomplete="off" placeholder="Detalle del Servicio">${item.detalle}</textarea>
                          </div>
                          <button type="button" class="btn btn-primary btn-flat" onclick="editarDetalle(${idx})">
                              <i class="fas fa-save"></i> GUARDAR
                          </button>
                          <button type="button" class="btn btn-default btn-flat" onclick="limpiarDetalle(${idx})">
                              <i class="fas fa-eraser"></i> LIMPIAR
                          </button>
                          <button type="button" class="btn btn-danger btn-flat float-right" onclick="eliminarDetalle(${idx})">
                              <i class="fas fa-trash-alt"></i> ELIMINAR
                          </button>
                        </form>
                  </div>
              `);
                $(`#icono-preview-${idx}`).html(item.icono_svg);
                $(`#icono-${idx}`).data('original-svg', item.icono_svg);
                $(`#icono-${idx}`).on('input', function () {
                    const val = $(this).val();
                    if (val.trim() === '') {
                        $(`#icono-preview-${idx}`).html($(this).data('original-svg'));
                    } else {
                        try {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = val.trim();
                            const svg = tempDiv.querySelector('svg');
                            if (svg) {
                                $(`#icono-preview-${idx}`).html(val);
                            } else {
                                throw new Error();
                            }
                        } catch {
                            $(`#icono-preview-${idx}`).html('<span style="color:red;white-space:nowrap;">Icono SVG inválido</span>');
                        }
                    }
                });
            });
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los detalles', 'error');
        }
    });
}

function limpiarDetalle(idx) {
    $(`#titulo-${idx}`).val('');
    $(`#icono-${idx}`).val('');
    $(`#detalle-${idx}`).val('');
}

function abrirModal() {
    $('#mdldetalle').modal('show');
}

function registrarDetalle() {
    if ($('#txttitulosdet').val().trim() === '') {
        Swal.fire('Agregar Servicio', 'El título es obligatorio', 'error');
        $('#txttitulosdet').focus();
        return;
    }
    if ($('#txtdetallesdet').val().trim() === '') {
        Swal.fire('Agregar Servicio', 'El detalle es obligatorio', 'error');
        $('#txtdetallesdet').focus();
        return;
    }
    if ($('#txticonosvg').val().trim() === '') {
        Swal.fire('Agregar Servicio', 'El icono es obligatorio', 'error');
        $('#txticonosvg').focus();
        return;
    }
    var parametros = {
        idarea: $('#txtid').val(),
        titulo: $('#txttitulosdet').val(),
        detalle: $('#txtdetallesdet').val(),
        icono_svg: $('#txticonosvg').val(),
        estado: 'ACTIVO'
    };

    $.ajax({
        type: "POST",
        url: baseURL + 'servicios/insertar_detalle',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Agregar Servicio',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Agregar Servicio',
                    text: response.message,
                }).then(function () {
                    mostrarDetalles()
                    $('#mdldetalle').modal('hide');
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al registrar el servicio', 'error');
        }
    });
}

function editarDetalle(idx) {
    const iddetalle = $(`#form-detalle-${idx}`).data('iddetalle');
    const titulo = $(`#titulo-${idx}`).val();
    const detalle = $(`#detalle-${idx}`).val();
    const icono_svg = $(`#icono-preview-${idx}`).html();

    if (titulo || titulo.trim() === '') {
        Swal.fire('Agregar Servicio', 'El título es obligatorio', 'error');
        $(`#titulo-${idx}`).focus();
        return;
    }
    if (detalle || detalle.trim() === '') {
        Swal.fire('Agregar Servicio', 'El detalle es obligatorio', 'error');
        $(`#detalle-${idx}`).focus();
        return;
    }
    if (!icono_svg || icono_svg.trim() === '') {
        Swal.fire('Agregar Servicio', 'El icono es obligatorio', 'error');
        $(`#icono-${idx}`).focus();
        return;
    }

    var parametros = {
        iddetalle: iddetalle,
        titulo: titulo,
        detalle: detalle,
        icono_svg: icono_svg
    };

    $.ajax({
        type: "POST",
        url: baseURL + 'servicios/editar_detalle',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Guardar Detalle',
                    text: response.error
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardar Detalle',
                    text: response.message,
                }).then(function () {
                    mostrarDetalles();
                    setTimeout(function () {
                        $(`#tab-${idx}-tab`).tab('show');
                    }, 500);
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el detalle', 'error');
        }
    });
}

function eliminarDetalle(idx) {
    const iddetalle = $(`#form-detalle-${idx}`).data('iddetalle');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción eliminará el servicio.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseURL + 'servicios/eliminar_detalle',
                data: { iddetalle: iddetalle },
                success: function (response) {
                    if (response.error) {
                        Swal.fire('Error', response.error, 'error');
                    } else {
                        Swal.fire('Eliminado', response.message, 'success').then(function () {
                            mostrarDetalles();
                        });
                    }
                },
                error: function () {
                    Swal.fire('Error', 'No se pudo eliminar el detalle', 'error');
                }
            });
        }
    });
}

function editar() {
    if ($('#txttitulos').val().trim() === '') {
        Swal.fire('Guardar Servicio', 'El título es obligatorio', 'error');
        $('#txttitulos').focus();
        return;
    }
    if ($('#txttituloresaltado').val().trim() === '') {
        Swal.fire('Guardar Servicio', 'El título subrayado es obligatorio', 'error');
        $('#txttituloresaltado').focus();
        return;
    }
    if ($('#txtdetalles').val().trim() === '') {
        Swal.fire('Guardar Servicio', 'El detalle es obligatorio', 'error');
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
        url: baseURL + 'servicios/editar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Guardar Servicio',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardar Servicio',
                    text: response.message,
                }).then(function () {
                    mostrarDatos();
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el servicio', 'error');
        }
    });
}