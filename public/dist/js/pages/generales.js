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