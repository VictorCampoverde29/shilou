var Español={
  "sProcessing":     "⏳ Procesando...",
  "sLengthMenu":     "Ver  _MENU_ registros",
  "sZeroRecords":    "😕 No se encontraron resultados",
  "sEmptyTable":     "📭 Ningún dato disponible en esta tabla",
  "sInfo":           "📄 Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty":      "📄 Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sInfoPostFix":    "",
  "sSearch":         "🔍 Buscar:",
  "sUrl":            "",
  "sInfoThousands":  ",",
  "sLoadingRecords": "⏳ Cargando...",
  "oPaginate": {
      "sNext":     "➡️",
      "sPrevious": "⬅️"
  },
  "oAria": {
      "sSortAscending":  "⬆️: Activar para ordenar la columna de manera ascendente",
      "sSortDescending": "⬇️: Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
      "copy": "📋 Copiar",
      "colvis": "👁️ Visibilidad"
  }
}

function cambiarContrasena() {
    $('#mdlcambio').modal('show');
}

$('#cambioIcono').on('click', function() {
    const input = $('#txtpasswordc');
    const icon = $('#iconoPassword');
    if (input.attr('type') === 'password') {
      input.attr('type', 'text');
      icon.removeClass('fa-eye-slash').addClass('fa-eye');
    } else {
      input.attr('type', 'password');
      icon.removeClass('fa-eye').addClass('fa-eye-slash');
    }
});

function guardarCambio() {
    const password = $('#txtpasswordc').val();
    if (password === '') {
        Swal.fire('Cambio de Contraseña', 'La nueva contraseña es obligatoria', 'warning');
        $('#txtpasswordc').focus();
        return;
    }
    if (password.length < 4) {
        Swal.fire('Cambio de Contraseña', 'La contraseña debe tener al menos 4 caracteres', 'warning');
        $('#txtpasswordc').focus();
        return;
    }
    if (!/\d/.test(password)) {
        Swal.fire('Cambio de Contraseña', 'La contraseña debe contener al menos un número', 'warning');
        $('#txtpasswordc').focus();
        return;
    }
    var parametros = {
        np: $('#txtpasswordc').val()
    };
    console.log(parametros);
    $.ajax({
        type: "POST",
        url: baseURL + 'acceso/clave',
        data: parametros,
        success: function (response) {
          console.log(response);
            if (response.success === false) {
                Swal.fire({
                    icon: "error",
                    title: 'Cambio de Contraseña',
                    text: response.mensaje
                });
            }
            else {
                Swal.fire({
                    icon: 'success',
                    title: 'Cambio de Contraseña',
                    text: response.mensaje,
                }).then(function () {
                    $('#mdlcambio').modal('hide');
                    $('#txtpasswordc').val('');
                });
            }   
        }
    });
} 