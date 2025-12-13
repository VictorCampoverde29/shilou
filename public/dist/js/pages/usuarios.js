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
        "columns": [
            { "data": "nombre" },
            { "data": "correo" },
            { "data": "perfil" },
            { "data": "estado" },
            {
                "data": null,
                "orderable": false,
                "width": "12%",
                "className": "text-center",
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning" id="btnEditar" onclick="seleccionarImagen({'${row.idusuarios}'})" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>
                    `;
                }
            }
        ],
    });
}