// Bloquear espacios en el input de contraseña
$(document).on('keydown', '#txtcontra', function(e) {
    if (e.key === ' ') {
        e.preventDefault();
    }
});
$(document).on('input', '#txtcontra', function() {
    this.value = this.value.replace(/\s+/g, '');
});
$(document).ready(function () {
    getUsuarios();
});

function getUsuarios() {
    var url = baseURL + 'usuarios/obtener_usuarios';
    table = $('#tblusuarios').DataTable({
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
        "createdRow": function (row, data, dataIndex) {
            if (data.estado && data.estado.trim().toUpperCase() === 'INACTIVO') {
                $(row).addClass('text-danger');
            }
        },
        "columns": [
            { "data": "nombre" },
            { "data": "correo" },
            { "data": "perfil" },
            {
                "data": "estado",
                "className": "text-center",
                "render": function (data) {
                    if (data === 'ACTIVO') {
                        return '<span class="text-success font-weight-bold">ACTIVO</span>';
                    } else if (data === 'INACTIVO') {
                        return '<span class="text-danger font-weight-bold">INACTIVO</span>';
                    }
                    return data;
                }
            },
            {
                "data": null,
                "orderable": false,
                "width": "12%",
                "className": "text-center",
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning" id="btnEditar" onclick="mostrarDatos('${row.idusuario}')" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>
                    `;
                }
            }
        ],
    });
}

function mostrarDatos(idusuario) {
    if (!idusuario) return;
    const url = baseURL + 'usuarios/obtener_usuario?cod=' + encodeURIComponent(idusuario);
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $('#txtid').val(response[0].idusuario);
            $('#txtnombre').val(response[0].nombre);
            $('#txtcorreo').val(response[0].correo);
            $('#txtperfil').val(response[0].perfil);
            $('#txtestado').val(response[0].estado);
            $('#txtcontra').closest('.form-group').hide();
            $('#modalDefaultLabel').text('Editar Usuario');
            $('#btnregistrar').addClass('d-none');
            $('#btneditar').removeClass('d-none');
            $('#mdlusuarios').modal('show');
        },
        error: function () {
            Swal.fire('Error', 'No se pudieron cargar los datos del usuario', 'error');
        }
    });
}

function abrirModal() {
    limpiar();
    $('#txtcontra').closest('.form-group').show();
    $('#modalDefaultLabel').text('Registrar nuevo Usuario');
    $('#btnregistrar').removeClass('d-none');
    $('#btneditar').addClass('d-none');
    $('#mdlusuarios').modal('show');
}

function limpiar() {
    $('#txtnombre').val('');
    $('#txtcontra').val('');
    $('#txtcorreo').val('');
    $('#txtperfil').val('EDITOR');
    $('#txtestado').val('ACTIVO');
}

function registrar() {
    if ($('#txtnombre').val()
       === '') {
        Swal.fire('Registro de Usuario', 'El nombre es obligatorio', 'warning');
        $('#txtnombre').focus();
        return;
    }
    var contra = $('#txtcontra').val();
    if (contra === '') {
        Swal.fire('Registro de Usuario', 'La contraseña es obligatoria', 'warning');
        $('#txtcontra').focus();
        return;
    }
    if (contra.length < 4) {
        Swal.fire('Registro de Usuario', 'La contraseña debe tener al menos 4 caracteres', 'warning');
        $('#txtcontra').focus();
        return;
    }
    var correo = $('#txtcorreo').val();
    if (correo === '') {
        Swal.fire('Registro de Usuario', 'El correo es obligatorio', 'warning');
        $('#txtcorreo').focus();
        return;
    }
    var correoRegex = /^[\w-.]+@[\w-]+\.[a-zA-Z]{2,}$/;
    if (!correoRegex.test(correo)) {
        Swal.fire('Registro de Usuario', 'Ingrese un correo electrónico válido', 'warning');
        $('#txtcorreo').focus();
        return;
    }
    var parametros = {
        nombre: $('#txtnombre').val(),
        contra: $('#txtcontra').val(),
        correo: $('#txtcorreo').val(),
        perfil: $('#txtperfil').val(),
        estado: $('#txtestado').val()
    };

    $.ajax({
        type: "POST",
        url: baseURL + 'usuarios/registrar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Registro de Usuario',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Registro de Usuario',
                    text: response.message,
                }).then(function () {
                    getUsuarios();
                    limpiar();
                    $('#mdlusuarios').modal('hide');
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al registrar el usuario', 'error');
        }
    });
}

function editar() {
    if ($('#txtnombre').val().trim() === '') {
        Swal.fire('Edición de Usuario', 'El nombre es obligatorio', 'warning');
        $('#txtnombre').focus();
        return;
    }
    var correo = $('#txtcorreo').val();
    if (correo === '') {
        Swal.fire('Registro de Usuario', 'El correo es obligatorio', 'warning');
        $('#txtcorreo').focus();
        return;
    }
    var correoRegex = /^[\w-.]+@[\w-]+\.[a-zA-Z]{2,}$/;
    if (!correoRegex.test(correo)) {
        Swal.fire('Registro de Usuario', 'Ingrese un correo electrónico válido', 'warning');
        $('#txtcorreo').focus();
        return;
    }
    var parametros = {
        idusuario: $('#txtid').val(),
        nombre: $('#txtnombre').val(),
        correo: $('#txtcorreo').val(),
        perfil: $('#txtperfil').val(),
        estado: $('#txtestado').val()
    };

    $.ajax({
        type: "POST",
        url: baseURL + 'usuarios/editar',
        data: parametros,
        success: function (response) {
            if (response.error) {
                Swal.fire({
                    icon: "error",
                    title: 'Edición de Usuario',
                    text: response.error
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Edición de Usuario',
                    text: response.message,
                }).then(function () {
                    getUsuarios();
                    $('#mdlusuarios').modal('hide');
                });
            }
        },
        error: function () {
            Swal.fire('Error', 'Ha ocurrido un error al editar el usuario', 'error');
        }
    });
}