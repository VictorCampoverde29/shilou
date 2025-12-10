let iddetalleSeleccionado = null;

$(document).ready(function () {
    mostrarDatos();
});

function mostrarDatos() {
    const url = baseURL + 'head/obtener_areas';
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $('#txtid').val(response[0].idarea);
            $('#txttitulos').val(response[0].titulo);
            $('#txttituloresaltado').val(response[0].titulo_resaltado);
            $('#txtdetalles').val(response[0].detalle);
            $('#txtdireccion').val(response[0].direccion);
            $('#txttelefono').val(response[0].telefono);
            mostrarDetalles();
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos del head', 'error');
        }
    });
}

function mostrarDetalles() {
    var parametros = 'idarea=' + $('#txtid').val();
    const url = baseURL + 'galeria/obtener_detalles';
    $.ajax({
        type: "GET",
        url: url,
        data: parametros,
        success: function (response) {
            $('#txtidd').val(response[0].iddetalle);
            $('#txttitulosdet').val(response[0].titulo);
            $('#txtdetallesdet').val(response[0].detalle);
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos del head', 'error');
        }
    });
}

function limpiar() {
    $('#txttitulos').val('');
    $('#txtdetalles').val('');
    $('#txtdireccion').val('');
    $('#txttelefono').val('');
}

function editar() {
    if ($('#txttitulos').val() === '') {
        Swal.fire('Guardar Contacto', 'El título es obligatorio', 'warning');
        $('#txttitulos').focus();
        return;
    }
    if ($('#txtdetalles').val() === '') {
        Swal.fire('Guardar Contacto', 'El detalle es obligatorio', 'warning');
        $('#txtdetalles').focus();
        return;
    }
    if ($('#txttelefono').val() === '') {
        Swal.fire('Guardar Contacto', 'El teléfono es obligatorio', 'warning');
        $('#txttelefono').focus();
        return;
    }
    if ($('#txtdireccion').val() === '') {
        Swal.fire('Guardar Contacto', 'La dirección es obligatoria', 'warning');
        $('#txtdireccion').focus();
        return;
    }
    var parametros = {
        cod: $('#txtid').val(),
        titulo: $('#txttitulos').val(),
        titulo_resaltado: $('#txttituloresaltado').val(),
        detalle: $('#txtdetalles').val(),
        direccion: $('#txtdireccion').val(),
        telefono: $('#txttelefono').val()
    };
    $.ajax({
        type: "POST",
        url: baseURL + 'head/editar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Guardar Contacto',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardar Contacto',
                    text: response.message,
                }).then(function () {
                    mostrarDatos();
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el contacto', 'error');
        }
    });
}

function editarDetalle() {
    var parametros = {
        iddetalle: $('#txtidd').val(),
        titulo: $('#txttitulosdet').val(),
        detalle: $('#txtdetallesdet').val()
    };
    $.ajax({
        type: "POST",
        url: baseURL + 'head/editar_detalle',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Actualizar Detalle',
                    text: response.error
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizar Detalle',
                    text: response.message,
                }).then(function () {
                    mostrarDetalles();
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el detalle', 'error');
        }
    });
}

function limpiarDetalle() {
    $('#txtidd').val('');
    $('#txttitulosdet').val('');
    $('#txtdetallesdet').val('');
}